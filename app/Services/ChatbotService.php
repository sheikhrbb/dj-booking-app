<?php

namespace App\Services;

use App\Models\ChatbotConversation;
use App\Models\ChatbotMessage;
use App\Models\Service;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ChatbotService
{
    private $intents = [
        'booking_inquiry' => [
            'patterns' => ['book', 'booking', 'available', 'date', 'time', 'schedule'],
            'responses' => [
                'I can help you check availability and make a booking! What date are you looking for?',
                'Great! I can assist with your booking. What date would you like to check?',
                'Perfect! Let me help you with the booking process. What date are you interested in?'
            ]
        ],
        'service_inquiry' => [
            'patterns' => ['service', 'services', 'what do you offer', 'dj', 'music', 'floor', 'baraat', 'events'],
            'responses' => [
                'We offer several amazing services: Floor DJ, Baraat Procession, Events, and more! Which service interests you?',
                'Our services include Floor DJ, Baraat Procession, Events, and other special services. What would you like to know about?',
                'We have Floor DJ, Baraat Procession, Events, and other services. Which one would you like to learn more about?'
            ]
        ],
        'pricing_inquiry' => [
            'patterns' => ['price', 'cost', 'how much', 'rate', 'pricing'],
            'responses' => [
                'Our pricing varies based on the service and event details. Could you tell me which service you\'re interested in?',
                'I\'d be happy to provide pricing information! Which service are you looking for?',
                'Pricing depends on the service type and requirements. What service are you considering?'
            ]
        ],
        'greeting' => [
            'patterns' => ['hello', 'hi', 'hey', 'good morning', 'good afternoon', 'good evening'],
            'responses' => [
                'Hello! Welcome to Mustak & Events! How can I help you today?',
                'Hi there! I\'m your DJ booking assistant. What can I help you with?',
                'Welcome! I\'m here to help you with your DJ booking needs. What would you like to know?'
            ]
        ],
        'goodbye' => [
            'patterns' => ['bye', 'goodbye', 'thank you', 'thanks', 'end'],
            'responses' => [
                'Thank you for chatting with us! Feel free to return anytime for booking assistance.',
                'You\'re welcome! Have a great day and don\'t hesitate to come back for more help.',
                'Thanks for choosing Mustak & Events! We look forward to serving you!'
            ]
        ]
    ];

    public function processMessage($sessionId, $message, $userId = null)
    {
        // Get or create conversation
        $conversation = $this->getOrCreateConversation($sessionId, $userId);
        
        // Save user message
        $userMessage = $this->saveMessage($conversation->id, 'user', $message);
        
        // Process the message and generate response
        $response = $this->generateResponse($message, $conversation);
        
        // Save bot response
        $botMessage = $this->saveMessage($conversation->id, 'bot', $response['message'], $response['metadata']);
        
        // Update conversation activity
        $conversation->updateLastActivity();
        
        return [
            'message' => $response['message'],
            'metadata' => $response['metadata'],
            'conversation_id' => $conversation->id
        ];
    }

    private function getOrCreateConversation($sessionId, $userId = null)
    {
        $conversation = ChatbotConversation::where('session_id', $sessionId)
            ->where('status', 'active')
            ->first();

        if (!$conversation) {
            $conversation = ChatbotConversation::create([
                'session_id' => $sessionId,
                'user_id' => $userId,
                'status' => 'active',
                'last_activity' => now(),
            ]);
        }

        return $conversation;
    }

    private function saveMessage($conversationId, $type, $content, $metadata = null)
    {
        return ChatbotMessage::create([
            'conversation_id' => $conversationId,
            'message_type' => $type,
            'content' => $content,
            'metadata' => $metadata,
        ]);
    }

    private function generateResponse($message, $conversation)
    {
        $message = strtolower(trim($message));
        
        // Check for specific patterns
        if ($this->isDateInquiry($message)) {
            return $this->handleDateInquiry($message, $conversation);
        }
        
        if ($this->isServiceInquiry($message)) {
            return $this->handleServiceInquiry($message, $conversation);
        }
        
        if ($this->isBookingRequest($message)) {
            return $this->handleBookingRequest($message, $conversation);
        }
        
        // Check for general intents
        foreach ($this->intents as $intent => $data) {
            foreach ($data['patterns'] as $pattern) {
                if (Str::contains($message, $pattern)) {
                    $response = $data['responses'][array_rand($data['responses'])];
                    return [
                        'message' => $response,
                        'metadata' => ['intent' => $intent]
                    ];
                }
            }
        }
        
        // Default response
        return [
            'message' => 'I\'m here to help you with DJ bookings and services. You can ask me about availability, services, pricing, or make a booking. What would you like to know?',
            'metadata' => ['intent' => 'unknown']
        ];
    }

    private function isDateInquiry($message)
    {
        $datePatterns = [
            '/\b\d{1,2}\/\d{1,2}\/\d{4}\b/',
            '/\b\d{1,2}-\d{1,2}-\d{4}\b/',
            '/\b(january|february|march|april|may|june|july|august|september|october|november|december)\s+\d{1,2}\b/i',
            '/\b(jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)\s+\d{1,2}\b/i',
            '/\b\d{1,2}\s+(january|february|march|april|may|june|july|august|september|october|november|december)\b/i',
            '/\b\d{1,2}\s+(jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)\b/i',
        ];
        
        foreach ($datePatterns as $pattern) {
            if (preg_match($pattern, $message)) {
                return true;
            }
        }
        
        return false;
    }

    private function handleDateInquiry($message, $conversation)
    {
        // Extract date from message
        $date = $this->extractDate($message);
        
        if (!$date) {
            return [
                'message' => 'I couldn\'t understand the date format. Could you please specify the date in a format like "15th August" or "August 15"?',
                'metadata' => ['intent' => 'date_inquiry', 'error' => 'invalid_date_format']
            ];
        }
        
        // Check availability
        $availability = $this->checkAvailability($date);
        
        if ($availability['available']) {
            $response = "Great news! {$date->format('F j, Y')} is available for booking. ";
            $response .= "We have the following services available: Floor DJ, Baraat Procession, Events, and others. ";
            $response .= "Which service would you like to book for this date?";
            
            return [
                'message' => $response,
                'metadata' => [
                    'intent' => 'date_inquiry',
                    'date' => $date->format('Y-m-d'),
                    'available' => true,
                    'services' => Service::all()->pluck('title')->toArray()
                ]
            ];
        } else {
            $response = "I'm sorry, but {$date->format('F j, Y')} is not available for booking. ";
            $response .= "Would you like to check availability for a different date?";
            
            return [
                'message' => $response,
                'metadata' => [
                    'intent' => 'date_inquiry',
                    'date' => $date->format('Y-m-d'),
                    'available' => false
                ]
            ];
        }
    }

    private function extractDate($message)
    {
        // Simple date extraction - you might want to use a more sophisticated library
        $patterns = [
            '/\b(\d{1,2})\/(\d{1,2})\/(\d{4})\b/',
            '/\b(\d{1,2})-(\d{1,2})-(\d{4})\b/',
        ];
        
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $message, $matches)) {
                return Carbon::createFromDate($matches[3], $matches[2], $matches[1]);
            }
        }
        
        // Handle text dates like "15th August" or "August 15"
        $monthNames = [
            'january' => 1, 'jan' => 1,
            'february' => 2, 'feb' => 2,
            'march' => 3, 'mar' => 3,
            'april' => 4, 'apr' => 4,
            'may' => 5,
            'june' => 6, 'jun' => 6,
            'july' => 7, 'jul' => 7,
            'august' => 8, 'aug' => 8,
            'september' => 9, 'sep' => 9,
            'october' => 10, 'oct' => 10,
            'november' => 11, 'nov' => 11,
            'december' => 12, 'dec' => 12,
        ];
        
        $message = strtolower($message);
        
        foreach ($monthNames as $monthName => $monthNum) {
            if (Str::contains($message, $monthName)) {
                // Look for day number
                if (preg_match('/\b(\d{1,2})\b/', $message, $matches)) {
                    $day = (int)$matches[1];
                    $year = date('Y');
                    
                    // If the date is in the past, assume next year
                    if (Carbon::createFromDate($year, $monthNum, $day)->isPast()) {
                        $year++;
                    }
                    
                    return Carbon::createFromDate($year, $monthNum, $day);
                }
            }
        }
        
        return null;
    }

    private function checkAvailability($date)
    {
        // Check if there are any existing bookings for this date
        $existingBookings = Booking::whereDate('booking_date', $date->format('Y-m-d'))->count();
        
        // For demo purposes, let's assume we can handle up to 3 bookings per day
        // In a real application, you'd have more sophisticated availability logic
        return [
            'available' => $existingBookings < 3,
            'existing_bookings' => $existingBookings,
            'max_bookings' => 3
        ];
    }

    private function isServiceInquiry($message)
    {
        $serviceKeywords = ['floor', 'baraat', 'events', 'dj', 'music', 'service'];
        
        foreach ($serviceKeywords as $keyword) {
            if (Str::contains(strtolower($message), $keyword)) {
                return true;
            }
        }
        
        return false;
    }

    private function handleServiceInquiry($message, $conversation)
    {
        $services = Service::all();
        $message = strtolower($message);
        
        foreach ($services as $service) {
            if (Str::contains($message, strtolower($service->title))) {
                return [
                    'message' => "Great choice! Our {$service->title} service includes: {$service->description}. Would you like to book this service for a specific date?",
                    'metadata' => [
                        'intent' => 'service_inquiry',
                        'service_id' => $service->id,
                        'service_title' => $service->title
                    ]
                ];
            }
        }
        
        return [
            'message' => "We offer several services: Floor DJ, Baraat Procession, Events, and others. Which service would you like to learn more about?",
            'metadata' => ['intent' => 'service_inquiry']
        ];
    }

    private function isBookingRequest($message)
    {
        $bookingKeywords = ['book', 'booking', 'reserve', 'reservation', 'schedule'];
        
        foreach ($bookingKeywords as $keyword) {
            if (Str::contains(strtolower($message), $keyword)) {
                return true;
            }
        }
        
        return false;
    }

    private function handleBookingRequest($message, $conversation)
    {
        return [
            'message' => "I'd be happy to help you make a booking! To get started, I'll need some information. What date are you looking for?",
            'metadata' => ['intent' => 'booking_request']
        ];
    }

    public function getConversationHistory($sessionId, $limit = 10)
    {
        $conversation = ChatbotConversation::where('session_id', $sessionId)->first();
        
        if (!$conversation) {
            return [];
        }
        
        return $conversation->messages()
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->reverse()
            ->values();
    }
} 