<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\NewBookingNotification;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(Service $service)
    {
        return view('bookings.create', compact('service'));
    }


    public function store(Request $request, Service $service)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);
    
        // Count how many bookings already exist for this service on the selected date
        $existingBookingsCount = DB::table('bookings')
            ->where('service_id', $service->id)
            ->whereDate('booking_date', $request->booking_date)
            ->count();
    
        // Limit check
        if ($existingBookingsCount >= 3) {
            return back()->withInput()->withErrors([
                'booking_date' => 'Sorry, this service is not available on your selected date. Please choose another date.',
            ]);
        }
    
        // Process customer phone (comma-separated string)
        $cleanPhones = implode(',', array_map('trim', explode(',', $request->customer_phone)));
    
        $booking = Booking::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'service_id' => $service->id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $cleanPhones,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);
    
        // Send emails
        Mail::to($booking->customer_email)->send(new BookingConfirmation($booking));
        Mail::to('ahmedabdullah62433@gmail.com')->send(new NewBookingNotification($booking));
    
        return back()->with('booking_success', true);
    }

    public function myBookings_old()//where('user_id', auth()->id())->
    {
        $bookings = Booking::with('service')->latest()->get();
        return view('bookings.my', compact('bookings'));
    }

    public function myBookings(Request $request)
    {
        $query = Booking::with('service')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%$search%")
                  ->orWhere('customer_phone', 'like', "%$search%")
                  ->orWhereHas('service', function ($q2) use ($search) {
                      $q2->where('title', 'like', "%$search%");
                  });
            });
        }        

        if ($request->filled('date')) {
            $query->whereDate('booking_date', $request->date);
        }

        $bookings = $query->get();

        return view('bookings.my', compact('bookings'));
    }


    public function index()
    {
        $bookings = Booking::with('user', 'service')->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled']);
        $booking->status = $request->status;
        $booking->save();
    
        return response()->json(['success' => 'Booking status updated.']);
    }
    
}
