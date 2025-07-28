@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="section-title position-relative text-center mb-5">
        <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Book Service</h6>
        <h1 class="font-secondary display-4">Book: {{ $service->title }}</h1>
        <i class="fas fa-calendar-check text-dark"></i>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('services.index') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <form method="POST" action="{{ route('bookings.store', $service) }}" class="booking-form bg-white p-4 rounded shadow-sm">
                @csrf
                <div class="form-group">
                    <label for="booking_date" class="font-weight-bold">Booking Date:</label>
                    <input type="date" name="booking_date" id="booking_date" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('booking_date') }}" required>

                    @if($errors->has('booking_date'))
                        <small class="text-danger">{{ $errors->first('booking_date') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="booking_time" class="font-weight-bold">Booking Time:</label>
                    <input type="time" name="booking_time" id="booking_time" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('booking_time') }}" required>
                </div>
                <div class="form-group">
                    <label for="customer_name" class="font-weight-bold">Your Name:</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('customer_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="customer_email" class="font-weight-bold">Email:</label>
                    <input type="email" name="customer_email" id="customer_email" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('customer_email') }}" required>
                </div>
                <div class="form-group">
                    <label for="customer_phone" class="font-weight-bold">Phone:</label>
                    <input type="text" name="customer_phone" id="customer_phone" class="form-control bg-secondary border-0 py-4 px-3" value="{{ old('customer_phone') }}" required>
                    <small class="form-text text-dark">You can enter multiple numbers separated by commas. e.g., 90260XXXXX, 9984XXXXX</small>
                </div>

                <div class="form-group">
                    <label for="notes" class="font-weight-bold">Notes (optional):</label>
                    <textarea name="notes" id="notes" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Notes (optional)" rows="3">{{ old('notes') }}</textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success font-weight-bold px-5 py-2" data-loading="Processing Request...">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="submit-text">Book Now</span>
                    </button>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection


<!-- Thank You Modal -->
<div class="modal fade" id="thankYouModal" tabindex="-1" role="dialog" aria-labelledby="thankYouModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="thankYouModalLabel">Thank You!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Thank you for contacting us! We will get back to you soon.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


