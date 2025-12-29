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

// Leaflet map initialize
const map = L.map("map").setView([30, 70], 4);
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

  // Purane markers remove karna
  markers.forEach(marker => map.removeLayer(marker));
  markers = [];

  try {
    const response = await fetch("https://opensky-network.org/api/states/all");
    const data = await response.json();
    const flights = data.states || [];

    // ICAO prefix ke basis pe filter
    const filteredFlights = flights.filter(f => f[1] && f[1].startsWith(icaoPrefix));

    if (filteredFlights.length === 0) {
      alert(`No live flights found for ${selectedCountry}`);
      return;
    }

    // Markers add karna
    filteredFlights.forEach(f => {
      const lat = f[6];
      const lon = f[5];
      const callsign = f[1] || "Unknown";

      if (lat !== null && lon !== null) {
        const marker = L.marker([lat, lon])
          .addTo(map)
          .bindPopup(`<strong>${callsign}</strong><br>Origin: ${f[2] || "Unknown"}`);
        markers.push(marker);
      }
    });

    // Map ko auto zoom aur center karna
    if (markers.length > 0) {
      const group = L.featureGroup(markers);
      map.fitBounds(group.getBounds());
    }

  } catch (err) {
    console.error("OpenSky API error:", err);
    alert("Failed to load flights. Try again later.");
  }
});
