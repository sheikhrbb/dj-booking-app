# AI Chatbot for DJ Booking App

## Overview

This implementation adds a professional AI chatbot to your DJ booking application that helps customers with booking inquiries, service information, availability checks, and more. The chatbot is built with Laravel backend and a modern React-like frontend interface.

## Features

### 🤖 **Intelligent Conversation Management**
- Session-based conversations with unique session IDs
- Context-aware responses based on conversation history
- Natural language processing for date recognition
- Intent classification for different types of inquiries

### 📅 **Booking & Availability Features**
- Check availability for specific dates (e.g., "15th August")
- Real-time booking status verification
- Service-specific availability information
- Date format recognition (multiple formats supported)

### 🎵 **Service Information**
- Detailed service descriptions
- Service-specific pricing inquiries
- Package information and features
- Quick service selection

### 💬 **Professional UI/UX**
- Modern, responsive chat interface
- Floating chat widget for all pages
- Typing indicators and animations
- Quick reply buttons
- Mobile-responsive design

### 🎨 **Theme Integration**
- Matches your existing project theme
- Uses your brand colors (#E47A2E primary)
- Consistent typography (Montserrat font)
- Professional gradients and shadows

## Technical Architecture

### Backend Components

#### 1. **Database Structure**
```sql
-- Chatbot Conversations
chatbot_conversations
- id (primary key)
- session_id (unique)
- user_id (nullable, for authenticated users)
- status (active/completed/abandoned)
- metadata (JSON for additional data)
- last_activity (timestamp)
- created_at, updated_at

-- Chatbot Messages
chatbot_messages
- id (primary key)
- conversation_id (foreign key)
- message_type (user/bot/system)
- content (text)
- metadata (JSON for intent, entities)
- processed_at (timestamp)
- created_at, updated_at
```

#### 2. **Models**
- `ChatbotConversation` - Manages conversation sessions
- `ChatbotMessage` - Stores individual messages
- Relationships with existing `User`, `Service`, and `Booking` models

#### 3. **Service Layer**
- `ChatbotService` - Core AI logic and response generation
- Intent recognition and classification
- Date parsing and availability checking
- Service information retrieval

#### 4. **Controller**
- `ChatbotController` - API endpoints for chat functionality
- Message processing and session management
- Conversation history retrieval

### Frontend Components

#### 1. **Full Chat Interface** (`/chat`)
- Complete chat experience
- Service cards and quick actions
- Welcome message with service overview
- Professional styling matching your theme

#### 2. **Floating Widget** (All Pages)
- Compact chat widget
- Toggle functionality
- Responsive design
- Integrated on all pages

## API Endpoints

### Chatbot Routes
```php
POST /chatbot/message          # Process user message
GET  /chatbot/history          # Get conversation history
GET  /chatbot/session          # Generate new session ID
GET  /chatbot/services         # Get available services
GET  /chatbot/availability     # Check date availability
GET  /chat                     # Full chat interface
```

## Installation & Setup

### 1. **Database Migration**
```bash
php artisan migrate
```
This creates the necessary tables for conversations and messages.

### 2. **Routes**
Routes are automatically added to `routes/web.php`:
```php
// Chatbot routes
Route::prefix('chatbot')->group(function () {
    Route::post('/message', [ChatbotController::class, 'processMessage']);
    Route::get('/history', [ChatbotController::class, 'getConversationHistory']);
    Route::get('/session', [ChatbotController::class, 'generateSessionId']);
    Route::get('/services', [ChatbotController::class, 'getServices']);
    Route::get('/availability', [ChatbotController::class, 'checkAvailability']);
});

// Chatbot page
Route::get('/chat', function () {
    return view('chatbot.index');
})->name('chatbot.index');
```

### 3. **Navigation Integration**
The chatbot is accessible via:
- Navigation menu: "AI Assistant" link
- Direct URL: `/chat`
- Floating widget on all pages

## Usage Examples

### Customer Interactions

#### 1. **Availability Check**
```
Customer: "Is 15th August available for booking?"
Bot: "Great news! August 15, 2024 is available for booking. We have the following services available: Floor DJ, Baraat Procession, Events, and others. Which service would you like to book for this date?"
```

#### 2. **Service Inquiry**
```
Customer: "Tell me about your Floor DJ service"
Bot: "Great choice! Our Floor DJ service includes: [service description]. Would you like to book this service for a specific date?"
```

#### 3. **Booking Request**
```
Customer: "I want to make a booking"
Bot: "I'd be happy to help you make a booking! To get started, I'll need some information. What date are you looking for?"
```

#### 4. **Pricing Inquiry**
```
Customer: "How much do you charge?"
Bot: "Our pricing varies based on the service and event details. Could you tell me which service you're interested in?"
```

## Customization Options

### 1. **Adding New Intents**
In `ChatbotService.php`, add new intents to the `$intents` array:
```php
'new_intent' => [
    'patterns' => ['keyword1', 'keyword2'],
    'responses' => [
        'Response 1',
        'Response 2',
        'Response 3'
    ]
]
```

### 2. **Modifying Availability Logic**
Update the `checkAvailability()` method in `ChatbotService.php`:
```php
private function checkAvailability($date)
{
    // Custom availability logic
    $existingBookings = Booking::whereDate('booking_date', $date->format('Y-m-d'))->count();
    $maxBookings = 3; // Configurable
    
    return [
        'available' => $existingBookings < $maxBookings,
        'existing_bookings' => $existingBookings,
        'max_bookings' => $maxBookings
    ];
}
```

### 3. **Styling Customization**
Modify the CSS variables in the chatbot views:
```css
:root {
    --primary: #E47A2E;      /* Your brand color */
    --secondary: #EDF5F7;    /* Secondary color */
    --dark: #121F38;         /* Dark text */
    --light: #FFFFFF;        /* Light background */
}
```

### 4. **Adding New Services**
The chatbot automatically detects services from your `Service` model. Add new services through your admin panel.

## Advanced Features

### 1. **Session Management**
- Unique session IDs for each conversation
- Persistent conversation history
- User authentication integration
- Session timeout handling

### 2. **Intent Recognition**
- Pattern-based intent classification
- Context-aware responses
- Fallback responses for unknown intents
- Metadata storage for conversation context

### 3. **Date Processing**
- Multiple date format support
- Natural language date parsing
- Future date validation
- Availability checking

### 4. **Response Generation**
- Dynamic response selection
- Context-aware replies
- Service-specific information
- Quick reply suggestions

## Security Features

### 1. **CSRF Protection**
- All AJAX requests include CSRF tokens
- Laravel's built-in CSRF protection

### 2. **Input Validation**
- Message length limits
- XSS protection
- SQL injection prevention

### 3. **Session Security**
- Unique session IDs
- Session timeout
- User authentication integration

## Performance Optimizations

### 1. **Database Indexing**
- Indexed on session_id and status
- Optimized queries for conversation history
- Efficient message retrieval

### 2. **Caching**
- Service information caching
- Availability data caching
- Session data optimization

### 3. **Frontend Optimization**
- Lazy loading of chat history
- Efficient DOM manipulation
- Responsive design for mobile

## Testing

### 1. **Manual Testing**
Test these scenarios:
- Date availability checks
- Service inquiries
- Booking requests
- Error handling
- Mobile responsiveness

### 2. **API Testing**
Use tools like Postman to test endpoints:
```
POST /chatbot/message
{
    "message": "Is 15th August available?",
    "session_id": "uuid-here"
}
```

## Troubleshooting

### Common Issues

#### 1. **CSRF Token Errors**
- Ensure `<meta name="csrf-token">` is in your layout
- Check that AJAX requests include the token

#### 2. **Session Issues**
- Verify session ID generation
- Check database connections
- Ensure proper error handling

#### 3. **Styling Issues**
- Check CSS variable definitions
- Verify font loading
- Test responsive breakpoints

## Future Enhancements

### 1. **AI Integration**
- Integrate with OpenAI GPT or similar
- Advanced natural language processing
- Machine learning for response improvement

### 2. **Advanced Features**
- Voice input/output
- Image sharing
- File uploads
- Payment integration

### 3. **Analytics**
- Conversation analytics
- User behavior tracking
- Performance metrics
- Conversion tracking

## Support

For issues or questions:
1. Check the Laravel logs: `storage/logs/laravel.log`
2. Verify database migrations ran successfully
3. Test API endpoints directly
4. Check browser console for JavaScript errors

## License

This chatbot implementation is part of your DJ booking application and follows the same licensing terms.

---

**Built with ❤️ for Mustak & Events** 