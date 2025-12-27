<?php
// Future AI integration or server handling could go here
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Musafir - AI Chatbot</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .hero {
      background: url("img/mainBG.jpg") no-repeat center center / cover;
      height: 100vh;
    }

    .text-shadow {
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
    }

    .header {
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .header.scrolled {
      background-color: rgba(27, 27, 27, 0.9);
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
      transform: translateY(-5px);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    body {
      background: url('img/mainBG.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    .chat-container {
      height: 70vh;
      overflow-y: auto;
      scroll-behavior: smooth;
    }

    .message {
      transition: opacity 0.3s ease-in-out;
    }

    .message.sent {
      justify-content: flex-end;
    }

    .message.received {
      justify-content: flex-start;
    }
  </style>
</head>
<body class="text-gray-800">

  <!-- Header -->
  <header id="header" class="header fixed top-0 left-0 w-full py-4 z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
      <h1 class="text-3xl font-bold text-white text-shadow">Musafir</h1>
      <nav>
        <ul class="flex space-x-6">
          <li><a href="services.php" class="text-white text-lg hover:text-blue-300">Services</a></li>
          <li><a href="ticket_booking.php" class="text-white text-lg hover:text-blue-300">Book Tickets</a></li>
          <li><a href="contactus.php" class="text-white text-lg hover:text-blue-300">Contact Us</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Chatbot Main Content -->
  <main class="container mx-auto py-24 px-4">
    <section class="bg-white bg-opacity-90 rounded-lg shadow-md p-6">
      <h2 class="text-2xl font-bold text-center text-blue-900 mb-4">Welcome to the Airline AI Chatbot</h2>
      <p class="text-gray-700 text-center mb-6">Ask me anything about your flight, booking, baggage, or airline services!</p>
      <div id="chat" class="chat-container bg-gray-100 rounded-lg p-4 mb-4 space-y-4 h-96 overflow-y-scroll"></div>
      <form id="chat-form" class="flex">
        <input type="text" id="user-input" class="flex-1 p-3 border border-gray-300 rounded-l-md focus:ring-blue-500 focus:border-blue-500" placeholder="Type your message...">
        <button type="submit" class="bg-blue-900 text-white px-6 py-3 rounded-r-md hover:bg-blue-800">Send</button>
      </form>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white text-center py-4">
    <p>&copy; <?php echo date("Y"); ?> Musafir. All rights reserved.</p>
  </footer>

  <!-- Scripts -->
  <script>
    // Header scroll effect
    const header = document.getElementById('header');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Simple chatbot demo logic (adjust if you use backend or real AI)
    const form = document.getElementById('chat-form');
    const input = document.getElementById('user-input');
    const chat = document.getElementById('chat');

    form.addEventListener('submit', e => {
      e.preventDefault();
      const message = input.value.trim();
      if (!message) return;

      const userMsg = document.createElement('div');
      userMsg.className = 'message sent flex justify-end';
      userMsg.innerHTML = `<div class="bg-blue-100 text-blue-900 px-4 py-2 rounded-lg max-w-xs">${message}</div>`;
      chat.appendChild(userMsg);

      // Simulate bot response
      const botMsg = document.createElement('div');
      botMsg.className = 'message received flex justify-start';
      botMsg.innerHTML = `<div class="bg-gray-200 text-gray-900 px-4 py-2 rounded-lg max-w-xs mt-2">Thank you for your question. We'll get back to you shortly.</div>`;
      setTimeout(() => {
        chat.appendChild(botMsg);
        chat.scrollTop = chat.scrollHeight;
      }, 600);

      input.value = '';
      chat.scrollTop = chat.scrollHeight;
    });
  </script>
</body>
</html>
