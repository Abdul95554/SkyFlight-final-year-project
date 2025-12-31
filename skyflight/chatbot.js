// Chatbot Responses
const chatbotResponses = {
    default: "I'm sorry, I didn't understand that. Please ask something about flights, bookings, or airline services.",
    greetings: "Hello! How can I assist you today?",
    booking: "You can book tickets on our website or mobile app. Let me know if you need help with it.",
    baggage: "Our baggage policy allows 1 carry-on bag and 1 checked bag. Additional baggage fees may apply.",
    flightStatus: "To check your flight status, visit our flight status page or provide your flight number here.",
    cancel: "You can cancel your flight on our website under 'Manage My Booking'. Cancellation fees may apply.",
  };
  
  // Chat Functionality
  const chatForm = document.getElementById("chat-form");
  const chatContainer = document.getElementById("chat");
  const userInput = document.getElementById("user-input");
  
  function addMessage(message, type = "received") {
    const messageEl = document.createElement("div");
    messageEl.className = `message flex items-start space-x-2 ${type}`;
    messageEl.innerHTML = `
      <div class="bg-${type === "sent" ? "blue-800" : "gray-300"} text-${type === "sent" ? "white" : "black"} p-3 rounded-lg max-w-md">
        ${message}
      </div>
    `;
    chatContainer.appendChild(messageEl);
    chatContainer.scrollTop = chatContainer.scrollHeight;
  }
  
  function getChatbotResponse(input) {
    input = input.toLowerCase();
    if (input.includes("hello") || input.includes("hi")) {
      return chatbotResponses.greetings;
    } else if (input.includes("book") || input.includes("ticket")) {
      return chatbotResponses.booking;
    } else if (input.includes("baggage") || input.includes("luggage")) {
      return chatbotResponses.baggage;
    } else if (input.includes("flight status") || input.includes("status")) {
      return chatbotResponses.flightStatus;
    } else if (input.includes("cancel") || input.includes("cancellation")) {
      return chatbotResponses.cancel;
    } else {
      return chatbotResponses.default;
    }
  }
  
  chatForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const userMessage = userInput.value.trim();
    if (userMessage) {
      addMessage(userMessage, "sent");
      const chatbotMessage = getChatbotResponse(userMessage);
      setTimeout(() => addMessage(chatbotMessage, "received"), 500);
      userInput.value = "";
    }
  });
  