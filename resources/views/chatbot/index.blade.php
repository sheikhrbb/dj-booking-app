<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DJ Booking Assistant - Mustak & Events</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #E47A2E;
            --secondary: #EDF5F7;
            --dark: #121F38;
            --light: #FFFFFF;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, var(--secondary) 0%, #f8f9fa 100%);
            min-height: 100vh;
        }
        
        .chatbot-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .chatbot-header {
            background: linear-gradient(135deg, var(--primary) 0%, #f39c12 100%);
            color: white;
            padding: 30px;
            border-radius: 20px 20px 0 0;
            text-align: center;
            box-shadow: 0 4px 20px rgba(228, 122, 46, 0.3);
        }
        
        .chatbot-header h1 {
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 2.5rem;
        }
        
        .chatbot-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }
        
        .chatbot-body {
            background: white;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .chat-messages {
            height: 500px;
            overflow-y: auto;
            padding: 20px;
            background: #f8f9fa;
        }
        
        .message {
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
        }
        
        .message.user {
            justify-content: flex-end;
        }
        
        .message.bot {
            justify-content: flex-start;
        }
        
        .message-content {
            max-width: 70%;
            padding: 15px 20px;
            border-radius: 20px;
            position: relative;
            word-wrap: break-word;
        }
        
        .message.user .message-content {
            background: linear-gradient(135deg, var(--primary) 0%, #f39c12 100%);
            color: white;
            border-bottom-right-radius: 5px;
        }
        
        .message.bot .message-content {
            background: white;
            color: var(--dark);
            border: 2px solid #e9ecef;
            border-bottom-left-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .message-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            font-size: 18px;
        }
        
        .message.user .message-avatar {
            background: var(--primary);
            color: white;
        }
        
        .message.bot .message-avatar {
            background: var(--dark);
            color: white;
        }
        
        .chat-input-container {
            padding: 20px;
            background: white;
            border-top: 2px solid #e9ecef;
        }
        
        .chat-input-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .chat-input {
            flex: 1;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            padding: 15px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .chat-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(228, 122, 46, 0.1);
        }
        
        .send-button {
            background: linear-gradient(135deg, var(--primary) 0%, #f39c12 100%);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .send-button:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(228, 122, 46, 0.4);
        }
        
        .send-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        
        .typing-indicator {
            display: none;
            padding: 15px 20px;
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 20px;
            border-bottom-left-radius: 5px;
            margin-bottom: 20px;
            max-width: 70%;
        }
        
        .typing-dots {
            display: flex;
            gap: 5px;
        }
        
        .typing-dot {
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            animation: typing 1.4s infinite ease-in-out;
        }
        
        .typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .typing-dot:nth-child(2) { animation-delay: -0.16s; }
        
        @keyframes typing {
            0%, 80%, 100% {
                transform: scale(0.8);
                opacity: 0.5;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .quick-replies {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }
        
        .quick-reply {
            background: white;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        
        .quick-reply:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        .welcome-message {
            text-align: center;
            padding: 40px 20px;
            color: var(--dark);
        }
        
        .welcome-message h3 {
            color: var(--primary);
            margin-bottom: 15px;
        }
        
        .welcome-message p {
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .service-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .service-card {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .service-card:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(228, 122, 46, 0.2);
        }
        
        .service-card i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .service-card h5 {
            color: var(--dark);
            margin-bottom: 10px;
        }
        
        .service-card p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 0;
        }
        
        @media (max-width: 768px) {
            .chatbot-container {
                padding: 10px;
            }
            
            .chatbot-header h1 {
                font-size: 2rem;
            }
            
            .chat-messages {
                height: 400px;
            }
            
            .message-content {
                max-width: 85%;
            }
        }
    </style>
</head>
<body>
    <div class="chatbot-container">
        <div class="chatbot-header">
            <h1><i class="fas fa-music me-3"></i>DJ Booking Assistant</h1>
            <p>Your AI-powered booking assistant for Mustak & Events</p>
        </div>
        
        <div class="chatbot-body">
            <div class="chat-messages" id="chatMessages">
                <!-- Welcome message -->
                <div class="welcome-message">
                    <h3><i class="fas fa-robot text-primary"></i> Welcome!</h3>
                    <p>I'm your AI assistant here to help you with DJ bookings and services. You can ask me about:</p>
                    
                    <div class="service-cards">
                        <div class="service-card" onclick="sendQuickMessage('Check availability for 15th August')">
                            <i class="fas fa-calendar-check"></i>
                            <h5>Availability</h5>
                            <p>Check booking availability for specific dates</p>
                        </div>
                        <div class="service-card" onclick="sendQuickMessage('Tell me about your services')">
                            <i class="fas fa-list"></i>
                            <h5>Services</h5>
                            <p>Learn about our DJ services and packages</p>
                        </div>
                        <div class="service-card" onclick="sendQuickMessage('I want to make a booking')">
                            <i class="fas fa-bookmark"></i>
                            <h5>Bookings</h5>
                            <p>Make a new booking or check existing ones</p>
                        </div>
                        <div class="service-card" onclick="sendQuickMessage('What are your prices?')">
                            <i class="fas fa-dollar-sign"></i>
                            <h5>Pricing</h5>
                            <p>Get information about our rates and packages</p>
                        </div>
                    </div>
                </div>
                
                <!-- Messages will be added here -->
            </div>
            
            <!-- Typing indicator -->
            <div class="typing-indicator" id="typingIndicator">
                <div class="typing-dots">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            </div>
            
            <div class="chat-input-container">
                <div class="chat-input-group">
                    <input type="text" class="chat-input" id="messageInput" placeholder="Type your message here..." maxlength="1000">
                    <button class="send-button" id="sendButton" onclick="sendMessage()">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
                
                <div class="quick-replies" id="quickReplies">
                    <div class="quick-reply" onclick="sendQuickMessage('Hello')">Hello</div>
                    <div class="quick-reply" onclick="sendQuickMessage('What services do you offer?')">Services</div>
                    <div class="quick-reply" onclick="sendQuickMessage('Check availability')">Availability</div>
                    <div class="quick-reply" onclick="sendQuickMessage('How much do you charge?')">Pricing</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let sessionId = null;
        let isTyping = false;

        // Initialize chatbot
        document.addEventListener('DOMContentLoaded', function() {
            generateSessionId();
            setupEventListeners();
        });

        function setupEventListeners() {
            const messageInput = document.getElementById('messageInput');
            const sendButton = document.getElementById('sendButton');

            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            messageInput.addEventListener('input', function() {
                sendButton.disabled = !this.value.trim();
            });
        }

        async function generateSessionId() {
            try {
                const response = await fetch('/chatbot/session');
                const data = await response.json();
                
                if (data.success) {
                    sessionId = data.session_id;
                    console.log('Session ID generated:', sessionId);
                }
            } catch (error) {
                console.error('Error generating session ID:', error);
            }
        }

        async function sendMessage() {
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value.trim();
            
            if (!message || isTyping) return;

            // Clear input
            messageInput.value = '';
            document.getElementById('sendButton').disabled = true;

            // Add user message to chat
            addMessage(message, 'user');

            // Show typing indicator
            showTypingIndicator();

            try {
                const response = await fetch('/chatbot/message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        message: message,
                        session_id: sessionId
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Hide typing indicator
                    hideTypingIndicator();
                    
                    // Add bot response
                    addMessage(data.data.message, 'bot');
                    
                    // Update quick replies based on response
                    updateQuickReplies(data.data.metadata);
                } else {
                    hideTypingIndicator();
                    addMessage('Sorry, I encountered an error. Please try again.', 'bot');
                }
            } catch (error) {
                console.error('Error sending message:', error);
                hideTypingIndicator();
                addMessage('Sorry, I encountered an error. Please try again.', 'bot');
            }
        }

        function sendQuickMessage(message) {
            document.getElementById('messageInput').value = message;
            sendMessage();
        }

        function addMessage(content, type) {
            const chatMessages = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}`;
            
            const avatar = document.createElement('div');
            avatar.className = 'message-avatar';
            avatar.innerHTML = type === 'user' ? '<i class="fas fa-user"></i>' : '<i class="fas fa-robot"></i>';
            
            const messageContent = document.createElement('div');
            messageContent.className = 'message-content';
            messageContent.textContent = content;
            
            if (type === 'user') {
                messageDiv.appendChild(messageContent);
                messageDiv.appendChild(avatar);
            } else {
                messageDiv.appendChild(avatar);
                messageDiv.appendChild(messageContent);
            }
            
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function showTypingIndicator() {
            isTyping = true;
            const indicator = document.getElementById('typingIndicator');
            indicator.style.display = 'block';
            
            const chatMessages = document.getElementById('chatMessages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function hideTypingIndicator() {
            isTyping = false;
            document.getElementById('typingIndicator').style.display = 'none';
        }

        function updateQuickReplies(metadata) {
            const quickReplies = document.getElementById('quickReplies');
            
            // Clear existing quick replies
            quickReplies.innerHTML = '';
            
            // Add context-specific quick replies based on metadata
            if (metadata && metadata.intent) {
                switch (metadata.intent) {
                    case 'date_inquiry':
                        if (metadata.available) {
                            quickReplies.innerHTML = `
                                <div class="quick-reply" onclick="sendQuickMessage('I want to book Floor DJ service')">Book Floor DJ</div>
                                <div class="quick-reply" onclick="sendQuickMessage('I want to book Baraat service')">Book Baraat</div>
                                <div class="quick-reply" onclick="sendQuickMessage('I want to book Events service')">Book Events</div>
                                <div class="quick-reply" onclick="sendQuickMessage('Check another date')">Check Another Date</div>
                            `;
                        } else {
                            quickReplies.innerHTML = `
                                <div class="quick-reply" onclick="sendQuickMessage('Check availability for tomorrow')">Check Tomorrow</div>
                                <div class="quick-reply" onclick="sendQuickMessage('Check availability for next week')">Check Next Week</div>
                                <div class="quick-reply" onclick="sendQuickMessage('What services do you offer?')">Services</div>
                            `;
                        }
                        break;
                    case 'service_inquiry':
                        quickReplies.innerHTML = `
                            <div class="quick-reply" onclick="sendQuickMessage('Tell me about Floor DJ')">Floor DJ</div>
                            <div class="quick-reply" onclick="sendQuickMessage('Tell me about Baraat')">Baraat</div>
                            <div class="quick-reply" onclick="sendQuickMessage('Tell me about Events')">Events</div>
                            <div class="quick-reply" onclick="sendQuickMessage('Check availability')">Check Availability</div>
                        `;
                        break;
                    default:
                        quickReplies.innerHTML = `
                            <div class="quick-reply" onclick="sendQuickMessage('Hello')">Hello</div>
                            <div class="quick-reply" onclick="sendQuickMessage('What services do you offer?')">Services</div>
                            <div class="quick-reply" onclick="sendQuickMessage('Check availability')">Availability</div>
                            <div class="quick-reply" onclick="sendQuickMessage('How much do you charge?')">Pricing</div>
                        `;
                }
            }
        }
    </script>
</body>
</html> 