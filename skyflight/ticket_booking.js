document.addEventListener('DOMContentLoaded', () => {
  const seatMap = {
    "Economy": ["12A", "12B", "13A", "13B", "14A", "14B"],
    "Business": ["5A", "5B", "6A", "6B"],
    "First": ["1A", "1B", "2A"]
  };

  document.addEventListener("change", function (e) {
    if (e.target.classList.contains("travel-class")) {
      const selectedClass = e.target.value;
      const seatSelect = e.target.closest("div").querySelector(".seat-no");

      seatSelect.innerHTML = '<option value="">Select Seat</option>';
      if (seatMap[selectedClass]) {
        seatMap[selectedClass].forEach(seat => {
          const opt = document.createElement("option");
          opt.value = seat;
          opt.textContent = seat;
          seatSelect.appendChild(opt);
        });
      }
    }
  });

  const fromCountry = document.getElementById("from_country");
  const toCountry = document.getElementById("to_country");
  const fromCity = document.getElementById("from_city");
  const toCity = document.getElementById("to_city");
  const passengerCount = document.getElementById("passenger_count");
  const passengerInputs = document.getElementById("passenger_inputs");
  const pricingSection = document.getElementById("pricing_section");
  const distanceKm = document.getElementById("distance_km");
  const totalPrice = document.getElementById("total_price");
  const calculatedPrice = document.getElementById("calculated_price");
  const distanceInput = document.getElementById("distance_input");
  const amountGiven = document.getElementById("amount_given");
  const changeAmount = document.getElementById("change_amount");

  async function fetchJSON(url) {
    const res = await fetch(url);
    return res.json();
  }

  async function loadCountries(excludeId = null, restoreFromId = null, restoreToId = null) {
    const countries = await fetchJSON("get_countries.php");

    fromCountry.innerHTML = '<option value="">Select Country</option>';
    toCountry.innerHTML = '<option value="">Select Country</option>';

    countries.forEach(c => {
      const fromOption = new Option(c.name, c.id);
      fromCountry.add(fromOption);
      if (c.id != excludeId) {
        const toOption = new Option(c.name, c.id);
        toCountry.add(toOption);
      }
    });

    if (restoreFromId) fromCountry.value = restoreFromId;
    if (restoreToId) toCountry.value = restoreToId;
  }

  async function loadCities(countryId, selectBox, exclude = null) {
    const cities = await fetchJSON(`get_cities.php?country_id=${countryId}`);
    selectBox.innerHTML = '<option value="">Select City</option>';
    cities.forEach(city => {
      if (city.name !== exclude) {
        selectBox.innerHTML += `<option value="${city.id}">${city.name}</option>`;
      }
    });
  }

  function updateArrivalCities() {
    const excludeCity = fromCity.options[fromCity.selectedIndex]?.textContent;
    if (toCountry.value) {
      loadCities(toCountry.value, toCity, excludeCity);
    }
  }

  function generatePassengerInputs() {
    passengerInputs.innerHTML = "";
    const count = parseInt(passengerCount.value || "0");

    for (let i = 1; i <= count; i++) {
      passengerInputs.innerHTML += `
        <div class="grid grid-cols-4 gap-2 mb-2">
          <input type="text" name="passenger_names[]" placeholder="Passenger ${i} Name" class="p-2 border rounded name-field" required />
          <input type="text" name="passenger_cnic[]" placeholder="CNIC" class="p-2 border rounded cnic-field" required />

          <select name="travel_class[]" class="p-2 border rounded travel-class" required>
            <option value="">Select Class</option>
            <option value="Economy">Economy</option>
            <option value="Business">Business</option>
            <option value="First">First</option>
          </select>

          <select name="seat_no[]" class="p-2 border rounded seat-no" required>
            <option value="">Select Seat</option>
          </select>
        </div>
      `;
    }

    document.querySelectorAll(".name-field").forEach(input => {
      input.addEventListener("keypress", (e) => {
        if (!/^[a-zA-Z\\s]$/.test(e.key)) e.preventDefault();
      });
      input.addEventListener("input", checkAndShowPricing);
    });

    document.querySelectorAll(".cnic-field").forEach(input => {
      input.addEventListener("keypress", (e) => {
        if (!/[0-9]/.test(e.key)) e.preventDefault();
      });
      input.addEventListener("input", checkAndShowPricing);
    });
  }

  async function showPricing() {
    const from = fromCity.value;
    const to = toCity.value;
    if (!from || !to) return;

    const res = await fetch(`get_distance.php?from=${from}&to=${to}`);
    const data = await res.json();
    if (!data.distance_km) {
      alert("Could not calculate distance.");
      return;
    }

    const distance = data.distance_km;
    const rate = 25;
    const base = 3000;
    const count = parseInt(passengerCount.value || "1");
    const price = (distance * rate + base) * count;

    distanceKm.textContent = distance;
    totalPrice.textContent = price;
    calculatedPrice.value = price;
    distanceInput.value = distance;
    pricingSection.classList.remove("hidden");

    amountGiven.addEventListener("input", e => {
      const given = parseInt(e.target.value || "0");
      changeAmount.textContent = given > price ? given - price : 0;
    });
  }

  function checkAndShowPricing() {
    const from = fromCity.value;
    const to = toCity.value;
    const count = parseInt(passengerCount.value || "0");
    const names = document.querySelectorAll('[name="passenger_names[]"]');
    const cnics = document.querySelectorAll('[name="passenger_cnic[]"]');

    if (!from || !to || !count || names.length !== count || cnics.length !== count) return;

    for (let i = 0; i < count; i++) {
      if (!names[i].value || !cnics[i].value) return;
    }

    showPricing();
  }

  document.getElementById("booking-form").addEventListener("submit", (e) => {
    const names = document.querySelectorAll('[name="passenger_names[]"]');
    const cnics = document.querySelectorAll('[name="passenger_cnic[]"]');
    const price = parseInt(calculatedPrice.value || "0");
    const given = parseInt(amountGiven.value || "0");

    let valid = true;

    names.forEach(name => {
      if (!/^[a-zA-Z\\s]+$/.test(name.value)) {
        alert("Name must contain only letters.");
        valid = false;
      }
    });

    cnics.forEach(cnic => {
      if (!/^[0-9]{13}$/.test(cnic.value)) {
        alert("CNIC must be 13 digits.");
        valid = false;
      }
    });

    if (given < price) {
      alert("Amount given is less than total price! Please enter the full amount.");
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
    }
  });

  fromCountry.addEventListener("change", () => {
    const selectedFrom = fromCountry.value;
    const selectedTo = toCountry.value;
    loadCountries(selectedFrom, selectedFrom, selectedTo);
    loadCities(selectedFrom, fromCity);
    updateArrivalCities();
    checkAndShowPricing();
  });

  toCountry.addEventListener("change", () => {
    updateArrivalCities();
    checkAndShowPricing();
  });

  fromCity.addEventListener("change", () => {
    updateArrivalCities();
    checkAndShowPricing();
  });

  toCity.addEventListener("change", checkAndShowPricing);

  passengerCount.addEventListener("input", () => {
    generatePassengerInputs();
    checkAndShowPricing();
  });

  loadCountries();
});
