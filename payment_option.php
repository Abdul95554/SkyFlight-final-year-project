<?php
// Future database integration for storing bank accounts can be added here
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Musafir - Payment Options</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="payment_option.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Header -->
  <header class="bg-blue-900 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-6">
      <h1 class="text-3xl font-bold">Musafir</h1>
      <nav>
        <ul class="flex space-x-6">
          <li><a href="index.php" class="hover:underline">Home</a></li>
          <li><a href="ticket_booking.php" class="hover:underline">Ticket Booking</a></li>
          <li><a href="contactus.php" class="hover:underline">Contact Us</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto py-10 px-6">
    <h2 class="text-4xl font-bold text-center text-blue-900 mb-6">Payment Options</h2>

    <!-- Add Bank Account Section -->
    <section class="bg-white p-6 rounded-lg shadow-md mb-6">
      <h3 class="text-2xl font-semibold text-blue-900 mb-4">Add Bank Account</h3>
      <form id="add-bank-form" class="grid grid-cols-3 gap-4">
        <div>
          <label for="account-name" class="block text-lg font-medium">Account Name</label>
          <input type="text" id="account-name" class="w-full mt-2 p-3 border border-gray-300 rounded-md" required>
        </div>
        <div>
          <label for="account-number" class="block text-lg font-medium">Account Number</label>
          <input type="text" id="account-number" class="w-full mt-2 p-3 border border-gray-300 rounded-md" required>
        </div>
        <div>
          <label for="bank-name" class="block text-lg font-medium">Bank Name</label>
          <select id="bank-name" class="w-full mt-2 p-3 border border-gray-300 rounded-md" required>
            <option value="">Select a Bank</option>
            <option value="Allied Bank">Allied Bank</option>
            <option value="Bank Alfalah">Bank Alfalah</option>
            <option value="Habib Bank Limited (HBL)">Habib Bank Limited (HBL)</option>
            <option value="Meezan Bank">Meezan Bank</option>
            <option value="National Bank of Pakistan">National Bank of Pakistan</option>
            <option value="Standard Chartered Bank">Standard Chartered Bank</option>
            <option value="United Bank Limited (UBL)">United Bank Limited (UBL)</option>
            <option value="MCB Bank">MCB Bank</option>
            <option value="Faysal Bank">Faysal Bank</option>
            <option value="Askari Bank">Askari Bank</option>
            <option value="Bank Islami">Bank Islami</option>
            <option value="JS Bank">JS Bank</option>
          </select>
        </div>
        <button type="submit" class="col-span-3 bg-blue-900 text-white px-6 py-3 rounded-md hover:bg-blue-800 mt-4">
          Add Bank Account
        </button>
      </form>
    </section>

    <!-- Existing Bank Accounts Section -->
    <section class="bg-white p-6 rounded-lg shadow-md">
      <h3 class="text-2xl font-semibold text-blue-900 mb-4">Existing Bank Accounts</h3>
      <div id="bank-accounts" class="space-y-4">
        <p class="text-gray-600">No bank accounts added yet.</p>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white text-center py-4">
    <p>&copy; <?php echo date("Y"); ?> Musafir. All rights reserved.</p>
  </footer>

</body>
</html>
