function fetchAndSaveLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            // Send the user's location to the server
            fetch("/save-location", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    latitude: lat,
                    longitude: lon,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log("Location saved:", data);
                    fetchLocations(); // Refresh the map markers if needed
                });
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function handleStatusChange(status) {
    fetch("/update-status", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ status: status }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("Status update response:", data);
            if (data.updateLocation) {
                fetchAndSaveLocation();
            } else if (status === "inactive") {
                if (typeof map !== "undefined") {
                    map.eachLayer((layer) => {
                        if (layer instanceof L.Marker) {
                            map.removeLayer(layer);
                        }
                    });
                }
            }
        });
}

// Define custom icons
var activeIcon = L.icon({
    iconUrl: '{{ asset("img/blue.png") }}',
    iconSize: [100, 80],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41],
});

var criticalIcon = L.icon({
    iconUrl: '{{ asset("img/red.png") }}',
    iconSize: [100, 80],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41],
});

function fetchLocations() {
    fetch("/get-locations")
        .then((response) => response.json())
        .then((locations) => {
            console.log("Fetched locations:", locations);
            locations.forEach((location) => {
                var markerColor = location.status === "active" ? "blue" : "red";
                L.marker([location.latitude, location.longitude], {
                    icon: L.divIcon({
                        className: "custom-icon",
                        html: `<div style="background-color: ${markerColor}; width: 10px; height: 10px; border-radius: 50%;"></div>`,
                    }),
                }).addTo(map);
            });
        });
}
