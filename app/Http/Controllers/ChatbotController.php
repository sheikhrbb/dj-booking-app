<?php

namespace App\Http\Controllers;

use App\Services\ChatbotService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    protected $chatbotService;

    public function __construct(ChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    public function processMessage(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'session_id' => 'required|string',
        ]);

        $message = $request->input('message');
        $sessionId = $request->input('session_id');
        $userId = auth()->id();

        try {
            $response = $this->chatbotService->processMessage($sessionId, $message, $userId);

            return response()->json([
                'success' => true,
                'data' => $response,
                'timestamp' => now()->toISOString(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your message.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getConversationHistory(Request $request): JsonResponse
    {
        $request->validate([
            'session_id' => 'required|string',
        ]);

        $sessionId = $request->input('session_id');
        $limit = $request->input('limit', 10);

        try {
            $history = $this->chatbotService->getConversationHistory($sessionId, $limit);

            return response()->json([
                'success' => true,
                'data' => $history,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching conversation history.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function generateSessionId(): JsonResponse
    {
        $sessionId = Str::uuid()->toString();

        return response()->json([
            'success' => true,
            'session_id' => $sessionId,
        ]);
    }

    public function getServices(): JsonResponse
    {
        try {
            $services = \App\Models\Service::all();

            return response()->json([
                'success' => true,
                'data' => $services,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching services.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function checkAvailability(Request $request): JsonResponse
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        try {
            $date = $request->input('date');
            $existingBookings = \App\Models\Booking::whereDate('booking_date', $date)->count();
            $maxBookings = 3; // This could be configurable

            return response()->json([
                'success' => true,
                'data' => [
                    'date' => $date,
                    'available' => $existingBookings < $maxBookings,
                    'existing_bookings' => $existingBookings,
                    'max_bookings' => $maxBookings,
                    'remaining_slots' => max(0, $maxBookings - $existingBookings),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while checking availability.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
