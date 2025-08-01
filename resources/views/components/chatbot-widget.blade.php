<!-- Floating Chat Widget -->
<div id="chatbot-widget" class="chatbot-widget">
    <!-- Chat Toggle Button -->
    <div class="chatbot-toggle" id="chatbotToggle">
        <i class="fas fa-robot"></i>
        <span class="chatbot-toggle-text">AI Assistant</span>
    </div>
    
    <!-- Chat Window -->
    <div class="chatbot-window" id="chatbotWindow">
        <div class="chatbot-header">
            <div class="chatbot-header-content">
                <h5><i class="fas fa-robot me-2"></i>DJ Booking Assistant</h5>
                <p class="mb-0">Ask me about bookings, services, and availability</p>
            </div>
            <button class="chatbot-close" id="chatbotClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="chatbot-messages" id="chatbotMessages">
            <!-- Messages will be added here -->
        </div>
        
        <div class="chatbot-typing" id="chatbotTyping" style="display: none;">
            <div class="typing-indicator">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        
        <div class="chatbot-input">
            <div class="chatbot-input-group">
                <input type="text" id="chatbotInput" placeholder="Type your message..." maxlength="500">
                <button id="chatbotSend" class="chatbot-send-btn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.chatbot-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    font-family: 'Montserrat', sans-serif;
}

.chatbot-toggle {
    background: linear-gradient(135deg, #E47A2E 0%, #f39c12 100%);
    color: white;
    padding: 15px 20px;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(228, 122, 46, 0.3);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
}

.chatbot-toggle:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(228, 122, 46, 0.4);
}

.chatbot-toggle i {
    font-size: 20px;
}

.chatbot-toggle-text {
    font-size: 14px;
}

.chatbot-window {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 350px;
    height: 500px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    display: none;
    flex-direction: column;
    overflow: hidden;
}

.chatbot-window.active {
    display: flex;
}

.chatbot-header {
    background: linear-gradient(135deg, #E47A2E 0%, #f39c12 100%);
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chatbot-header-content h5 {
    margin: 0;
    font-weight: 600;
    font-size: 16px;
}

.chatbot-header-content p {
    margin: 5px 0 0 0;
    font-size: 12px;
    opacity: 0.9;
}

.chatbot-close {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
    padding: 5px;
    border-radius: 50%;
    transition: background 0.3s ease;
}

.chatbot-close:hover {
    background: rgba(255, 255, 255, 0.2);
}

.chatbot-messages {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background: #f8f9fa;
}

.chatbot-message {
    margin-bottom: 15px;
    display: flex;
    align-items: flex-start;
}

.chatbot-message.user {
    justify-content: flex-end;
}

.chatbot-message.bot {
    justify-content: flex-start;
}

.chatbot-message-content {
    max-width: 80%;
    padding: 12px 16px;
    border-radius: 18px;
    font-size: 14px;
    line-height: 1.4;
}

.chatbot-message.user .chatbot-message-content {
    background: linear-gradient(135deg, #E47A2E 0%, #f39c12 100%);
    color: white;
    border-bottom-right-radius: 5px;
}

.chatbot-message.bot .chatbot-message-content {
    background: white;
    color: #333;
    border: 1px solid #e9ecef;
    border-bottom-left-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.chatbot-typing {
    padding: 15px 20px;
    background: white;
    border-top: 1px solid #e9ecef;
}

.typing-indicator {
    display: flex;
    gap: 4px;
}

.typing-indicator span {
    width: 6px;
    height: 6px;
    background: #E47A2E;
    border-radius: 50%;
    animation: typing 1.4s infinite ease-in-out;
}

.typing-indicator span:nth-child(1) { animation-delay: -0.32s; }
.typing-indicator span:nth-child(2) { animation-delay: -0.16s; }

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

.chatbot-input {
    padding: 15px 20px;
    background: white;
    border-top: 1px solid #e9ecef;
}

.chatbot-input-group {
    display: flex;
    gap: 10px;
    align-items: center;
}

#chatbotInput {
    flex: 1;
    border: 2px solid #e9ecef;
    border-radius: 20px;
    padding: 10px 15px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.3s ease;
}

#chatbotInput:focus {
    border-color: #E47A2E;
}

.chatbot-send-btn {
    background: linear-gradient(135deg, #E47A2E 0%, #f39c12 100%);
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.chatbot-send-btn:hover {
    transform: scale(1.1);
}

.chatbot-send-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

@media (max-width: 768px) {
    .chatbot-widget {
        bottom: 10px;
        right: 10px;
    }
    
    .chatbot-window {
        width: 320px;
        height: 450px;
        bottom: 70px;
    }
    
    .chatbot-toggle-text {
        display: none;
    }
    
    .chatbot-toggle {
        padding: 15px;
    }
}
</style>

<script>
let chatbotSessionId = null;
let chatbotIsTyping = false;

// Initialize chatbot widget
document.addEventListener('DOMContentLoaded', function() {
    generateChatbotSession();
    setupChatbotEventListeners();
});

function setupChatbotEventListeners() {
    const toggle = document.getElementById('chatbotToggle');
    const close = document.getElementById('chatbotClose');
    const window = document.getElementById('chatbotWindow');
    const input = document.getElementById('chatbotInput');
    const send = document.getElementById('chatbotSend');

    toggle.addEventListener('click', function() {
        window.classList.toggle('active');
        if (window.classList.contains('active')) {
            input.focus();
        }
    });

    close.addEventListener('click', function() {
        window.classList.remove('active');
    });

    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendChatbotMessage();
        }
    });

    input.addEventListener('input', function() {
        send.disabled = !this.value.trim();
    });

    send.addEventListener('click', sendChatbotMessage);
}

async function generateChatbotSession() {
    try {
        const response = await fetch('/chatbot/session');
        const data = await response.json();
        
        if (data.success) {
            chatbotSessionId = data.session_id;
        }
    } catch (error) {
        console.error('Error generating chatbot session ID:', error);
    }
}

async function sendChatbotMessage() {
    const input = document.getElementById('chatbotInput');
    const message = input.value.trim();
    
    if (!message || chatbotIsTyping) return;

    input.value = '';
    document.getElementById('chatbotSend').disabled = true;

    addChatbotMessage(message, 'user');
    showChatbotTyping();

    try {
        const response = await fetch('/chatbot/message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                message: message,
                session_id: chatbotSessionId
            })
        });

        const data = await response.json();

        if (data.success) {
            hideChatbotTyping();
            addChatbotMessage(data.data.message, 'bot');
        } else {
            hideChatbotTyping();
            addChatbotMessage('Sorry, I encountered an error. Please try again.', 'bot');
        }
    } catch (error) {
        console.error('Error sending chatbot message:', error);
        hideChatbotTyping();
        addChatbotMessage('Sorry, I encountered an error. Please try again.', 'bot');
    }
}

function addChatbotMessage(content, type) {
    const messages = document.getElementById('chatbotMessages');
    const messageDiv = document.createElement('div');
    messageDiv.className = `chatbot-message ${type}`;
    
    const messageContent = document.createElement('div');
    messageContent.className = 'chatbot-message-content';
    messageContent.textContent = content;
    
    messageDiv.appendChild(messageContent);
    messages.appendChild(messageDiv);
    messages.scrollTop = messages.scrollHeight;
}

function showChatbotTyping() {
    chatbotIsTyping = true;
    document.getElementById('chatbotTyping').style.display = 'block';
    const messages = document.getElementById('chatbotMessages');
    messages.scrollTop = messages.scrollHeight;
}

function hideChatbotTyping() {
    chatbotIsTyping = false;
    document.getElementById('chatbotTyping').style.display = 'none';
}
</script> 