const chatForm = document.getElementById("chat-form");
const chatContainer = document.getElementById("chat");
const userInput = document.getElementById("user-input");

function addMessage(message, type) {
  const msg = document.createElement("div");
  msg.className = `message flex ${type === "sent" ? "justify-end" : "justify-start"}`;
  msg.innerHTML = `
    <div class="${type === "sent"
      ? "bg-blue-600 text-white"
      : "bg-gray-300 text-black"} px-4 py-2 rounded-lg max-w-md">
      ${message}
    </div>
  `;
  chatContainer.appendChild(msg);
  chatContainer.scrollTop = chatContainer.scrollHeight;
}

function getChatbotResponse(input) {
  input = input.toLowerCase();

  if (input.includes("hi") || input.includes("hello")) {
    return "Hello 👋 How can I help you today?";
  }
  if (input.includes("book") || input.includes("ticket")) {
    return "You can book tickets from the Book Tickets page ✈️";
  }
  if (input.includes("baggage") || input.includes("luggage")) {
    return "Each passenger can carry one hand bag and one checked bag.";
  }
  if (input.includes("status")) {
    return "Please provide your flight number to check flight status.";
  }
  if (input.includes("cancel")) {
    return "You can cancel your booking from Manage Booking section.";
  }

  return "Sorry 🤔 I can answer questions about flights, booking, baggage, or cancellation.";
}

chatForm.addEventListener("submit", function (e) {
  e.preventDefault();
  const message = userInput.value.trim();
  if (!message) return;

  addMessage(message, "sent");

  setTimeout(() => {
    const reply = getChatbotResponse(message);
    addMessage(reply, "received");
  }, 500);

  userInput.value = "";
});
