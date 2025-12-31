const countrySelect = document.getElementById("country-select");
const filterButton = document.getElementById("filter-button");
const flightInfo = document.getElementById("flight-info");

// ICAO prefixes by country
const icaoPrefixes = {
  Pakistan: 'OP',
  India: 'VI',
  'United States': 'K',
  'United Kingdom': 'EG',
  Canada: 'C'
};

// Fetch and display flights
filterButton.addEventListener("click", async () => {
  const selectedCountry = countrySelect.value;
  const icaoPrefix = icaoPrefixes[selectedCountry];

  if (!icaoPrefix) {
    flightInfo.innerHTML = "<p class='text-red-600'>Please select a valid country.</p>";
    return;
  }

  flightInfo.innerHTML = "<p class='text-blue-600'>Loading live flights from OpenSky...</p>";

  try {
    const response = await fetch("https://opensky-network.org/api/states/all");
    const data = await response.json();
    const flights = data.states || [];

    // Filter by origin_country (ICAO code prefix)
    const filteredFlights = flights.filter(flight => flight[2] && flight[2].startsWith(icaoPrefix));

    if (filteredFlights.length === 0) {
      flightInfo.innerHTML = `<p class='text-yellow-600'>No live flights found for ${selectedCountry} at this time.</p>`;
      return;
    }

    // Build table
    flightInfo.innerHTML = `
      <table class="w-full border-collapse border border-gray-300 text-left mt-4">
        <thead>
          <tr class="bg-blue-900 text-white">
            <th class="p-2 border">Callsign</th>
            <th class="p-2 border">Origin Country</th>
            <th class="p-2 border">Latitude</th>
            <th class="p-2 border">Longitude</th>
            <th class="p-2 border">Altitude (m)</th>
            <th class="p-2 border">Velocity (m/s)</th>
          </tr>
        </thead>
        <tbody>
          ${filteredFlights.map(f => `
            <tr class="hover:bg-gray-100">
              <td class="p-2 border">${f[1] || 'N/A'}</td>
              <td class="p-2 border">${f[2] || 'N/A'}</td>
              <td class="p-2 border">${f[6] != null ? f[6].toFixed(2) : 'N/A'}</td>
              <td class="p-2 border">${f[5] != null ? f[5].toFixed(2) : 'N/A'}</td>
              <td class="p-2 border">${f[7] != null ? f[7].toFixed(0) : 'N/A'}</td>
              <td class="p-2 border">${f[9] != null ? f[9].toFixed(1) : 'N/A'}</td>
            </tr>
          `).join('')}
        </tbody>
      </table>
    `;
  } catch (err) {
    console.error("OpenSky fetch error:", err);
    flightInfo.innerHTML = "<p class='text-red-600'>Failed to load data. Try again later.</p>";
  }
});
