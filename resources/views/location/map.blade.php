<!DOCTYPE html>
<html>

<head>
    <title>Find Help</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>Find Help</h1>
    {{-- <button id="delete-location">Delete My Location</button> --}}
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="/js/status.js"></script>
    <script>
        var map = L.map('map').setView([0, 0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var userMarker;

        //document.getElementById('delete-location').addEventListener('click', function() {
           // if (userMarker) {
                // Send the request to delete the user's location
              //  fetch('/delete-location', {
                     //   method: 'POST',
                     //   headers: {
                        //    'Content-Type': 'application/json',
                       //    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                      //          'content')
                     //   }
                   // }).then(response => response.json())
                   // .then(data => {
                    //    console.log('Location deleted:', data);
                   //     map.removeLayer(userMarker);
                   //     userMarker = null;
                  //  });
          //  } else {
            //    alert("No location to delete.");
           // }
       // });

        fetchLocations();
        setInterval(fetchLocations, 10000);
    </script>
</body>

</html>
