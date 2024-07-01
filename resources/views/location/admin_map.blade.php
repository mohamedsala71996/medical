<!DOCTYPE html>
<html>

<head>
    <title>User Locations</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 800px;
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>User Locations</h1>
    <div id="map"></div>


    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([0, 0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Define custom icons
        var activeIcon = L.icon({
            iconUrl: '{{ asset('img/active.png') }}',
            iconSize: [52, 52],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var criticalIcon = L.icon({
            iconUrl: '{{ asset('img/critical.png') }}',
            iconSize: [52, 52],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });


        // Loop through each location and add a marker with the appropriate icon
        @foreach ($locations as $location)
            var status = "{{ $location->status }}";
            var icon = (status === 'active') ? activeIcon : (status === 'critical') ? criticalIcon : null;
            if (icon) {
                var popupOptions = {
                    maxWidth: 200, // Maximum width of the popup
                    closeButton: true, // Show close button
                    autoClose: false, // Prevent popup from auto-closing when another popup is opened
                    closeOnClick: false, // Prevent popup from closing when the map is clicked
                    className: 'custom-popup', // Custom CSS class for the popup
                };
                var userType = {!! json_encode([
                    '1' => __('Normal user'),
                    '2' => __('Doctor'),
                    '3' => __('Clinical nutrition specialist'),
                ]) !!};

                var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}], {
                        icon: icon
                    }).addTo(map)
                    .bindPopup(`
                        {{ __('User Name') }}: {{ $location->user->name }}<br>
                        {{ __('User Status') }}: {{ $location->status == 'active' ? __('active') : __('critical*') }}<br>
                        {{ __('User Type') }}: ${userType[{{ $location->user->type }}]}
                    `, popupOptions)
                    .openPopup();
                // Add click event listener to redirect to the chat route
                @php
                    $mapGroup = \App\Models\MapGroup::where('admin_id', $location->user->id)->first();
                    $id = $mapGroup ? $mapGroup->id : 100;
                @endphp

                marker.on('click', function() {
                    window.location.href = "{{ route('group_caht.index', ['id' => $id]) }}";
                });
            }
        @endforeach
    </script>
</body>

</html>
