document.addEventListener('DOMContentLoaded', () => {
    const addBankForm = document.getElementById('add-bank-form');
    const accountNameInput = document.getElementById('account-name');
    const accountNumberInput = document.getElementById('account-number');
    const bankNameInput = document.getElementById('bank-name');
    const bankAccountsContainer = document.getElementById('bank-accounts');
  
    // Load bank accounts from localStorage
    const loadBankAccounts = () => {
      const bankAccounts = JSON.parse(localStorage.getItem('bankAccounts')) || [];
      bankAccountsContainer.innerHTML = '';
      if (bankAccounts.length === 0) {
        bankAccountsContainer.innerHTML = '<p class="text-gray-600">No bank accounts added yet.</p>';
      } else {
        bankAccounts.forEach((account, index) => {
          const accountElement = document.createElement('div');
          accountElement.className = 'flex justify-between items-center p-4 border border-gray-300 rounded-md';
          accountElement.innerHTML = `
            <div>
              <p class="font-medium">Name: ${account.name}</p>
              <p class="text-sm text-gray-600">Number: ${account.number}</p>
              <p class="text-sm text-gray-600">Bank: ${account.bank}</p>
            </div>
            <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600" data-index="${index}">
              Remove
            </button>
          `;
          bankAccountsContainer.appendChild(accountElement);
        });
      }
    };
  
    // Save bank accounts to localStorage
    const saveBankAccounts = (accounts) => {
      localStorage.setItem('bankAccounts', JSON.stringify(accounts));
    };
  
    // Add new bank account
    addBankForm.addEventListener('submit', (event) => {
      event.preventDefault();
  
      const accountName = accountNameInput.value.trim();
      const accountNumber = accountNumberInput.value.trim();
      const bankName = bankNameInput.value.trim();
  
      if (!accountName || !accountNumber || !bankName) {
        alert('Please provide all details (Account Name, Number, and Bank Name).');
        return;
      }
  
      const bankAccounts = JSON.parse(localStorage.getItem('bankAccounts')) || [];
      bankAccounts.push({ name: accountName, number: accountNumber, bank: bankName });
      saveBankAccounts(bankAccounts);
  
      accountNameInput.value = '';
      accountNumberInput.value = '';
      bankNameInput.value = '';
      loadBankAccounts();
    });
  
    // Remove a bank account
    bankAccountsContainer.addEventListener('click', (event) => {
      if (event.target.tagName === 'BUTTON') {
        const index = event.target.getAttribute('data-index');
        const bankAccounts = JSON.parse(localStorage.getItem('bankAccounts')) || [];
        bankAccounts.splice(index, 1);
        saveBankAccounts(bankAccounts);
        loadBankAccounts();
      }
    });
  
    // Initialize page by loading existing bank accounts
    loadBankAccounts();
  });
  