const countrySelect = document.getElementById("country-select");
const filterButton = document.getElementById("filter-button");

// ICAO prefixes by country
const icaoPrefixes = {
  Pakistan: "OP",
  India: "VI",
  "United States": "K",
  "United Kingdom": "EG",
  Canada: "C"
};

// Initialize Leaflet map
const map = L.map("map").setView([30, 70], 4); // Centered on South Asia
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution: "&copy; OpenStreetMap contributors"
}).addTo(map);

let markers = [];

filterButton.addEventListener("click", async () => {
  const selectedCountry = countrySelect.value;
  const icaoPrefix = icaoPrefixes[selectedCountry];

  if (!icaoPrefix) {
    alert("Please select a valid country.");
    return;
  }

  // Remove old markers
  markers.forEach(marker => map.removeLayer(marker));
  markers = [];

  try {
    const response = await fetch("https://opensky-network.org/api/states/all");
    const data = await response.json();
    const flights = data.states || [];

    const filteredFlights = flights.filter(f => f[2] && f[2].toLowerCase() === selectedCountry.toLowerCase());

    if (filteredFlights.length === 0) {
      alert(`No live flights found for ${selectedCountry}`);
      return;
    }

    filteredFlights.forEach(f => {
      const lat = f[6];
      const lon = f[5];
      const callsign = f[1] || "Unknown";

      if (lat && lon) {
        const marker = L.marker([lat, lon])
          .addTo(map)
          .bindPopup(`<strong>${callsign}</strong><br>${f[2] || "Unknown origin"}`);
        markers.push(marker);
      }
    });
  } catch (err) {
    console.error("OpenSky API error:", err);
    alert("Failed to load flights. Try again.");
  }
});
