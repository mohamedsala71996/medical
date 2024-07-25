<!DOCTYPE html>
<html>

<head>
    <title>Locations</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        #map {
            height: 750px;
            width: 100%;
        }
        .help {
            /* position: fixed; */
            /* top: 50%; */
            /* left: 50%; */
            /* transform: translate(-50%, -50%); */
            /* display: flex; */
            /* flex-direction: column; */
            /* align-items: center; */
        }

        .edit-input, .save-btn {
            display: none;
        }
        .pin-title {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgb(255, 255, 255);
            z-index: 1000;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

.pin-message {
    background-color: rgb(0, 81, 255);
    color: white;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
    margin-bottom: 10px;
}

.posts-link {
            display: inline-block;
            /* padding: 10px 15px;
            background-color: #007bff; */
            color: rgb(27, 104, 177);
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
            text-align: center;
        }
        body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>


</head>
@php
$mapGroup = \App\Models\MapGroup::where('admin_id', auth()->user()->id)->first();
$id = $mapGroup ? $mapGroup->id : 100;
$group_admin_ids=\App\Models\MapGroup::all()->pluck('admin_id');
$locations = \App\Models\Location::whereIn('user_id',$group_admin_ids)->get();
$pin_message = \App\Models\MapGroupChat::with('user')->where('group_id', $id )->first() ?? '';

@endphp
<body>
    {{-- <h1>User Locations</h1> --}}
    <a href="{{ url('posts') }}" class="posts-link">{{ __('Go to posts page') }}</a>
    <div id="map"></div>
    <div class="help">
        @if (!$pin_message)
        <form action="{{ route('pin_message',$id) }}" method="post">
            @csrf
        <input type="text" name="message" class="edit-input edim-input form-control mb-2" placeholder="Ask your question" required>
        <button class="save-btn btn btn-primary" type="submit" 
        {{-- href="{{ route('group_caht.index', ['id' => $id]) }}" --}}
             onclick="hideInput()">Ask</button>
    </form>
    <button class="help-p btn btn-secondary"  onclick="showInput()">HELP</button>
        @else
      <a class="btn btn-secondary" href="{{ url("group/$id") }}">{{ __('Go to') }} ({{ $pin_message->message }})</a>
        @endif
    </div>


    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([{{ auth()->user()->location->latitude }}, {{ auth()->user()->location->longitude }}], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Define custom icons
        var user = L.icon({
            iconUrl: '{{ asset('img/1.png') }}',
            iconSize: [52, 52],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var doctor = L.icon({
            iconUrl: '{{ asset('img/2.png') }}',
            iconSize: [52, 52],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        var sugar_intellectual = L.icon({
            iconUrl: '{{ asset('img/3.png') }}',
            iconSize: [52, 52],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        
        // Loop through each location and add a marker with the appropriate icon
        @foreach ($locations as $location)
            var type = "{{ $location->user->type }}";
            var icon = (type === '1') ? user : (type === '2') ? doctor : sugar_intellectual;
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
                    '3' => __('diabetes educator'),
                ]) !!};
                @php
                    $mapGroup = \App\Models\MapGroup::where('admin_id', $location->user->id)->first();
                    $id = $mapGroup ? $mapGroup->id : 100;
                    $pin_message=$mapGroup->messages()->first()->message;
                @endphp

                var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}], {
                        icon: icon
                    }).addTo(map)
                    .bindPopup(`
                        <a href="{{ route('group_caht.index', ['id' => $id]) }}"><div class='pin-message'>{{ $pin_message }}</div> </a>
                       <div class='text-center'>{{ $location->user->name }}</div>
                   <div class='text-center'> ${userType[{{ $location->user->type }}]}</div>
                    `, popupOptions)
                    .openPopup();
                // Add click event listener to redirect to the chat route
            
                marker.on('click', function() {
                    window.location.href = "{{ route('group_caht.index', ['id' => $id]) }}";
                });
            }
        @endforeach
    </script>

<script>
    function showInput() {
        document.querySelector('.edit-input').style.display = 'block';
        document.querySelector('.save-btn').style.display = 'block';
    }

    function hideInput() {
        document.querySelector('.edit-input').style.display = 'none';
        document.querySelector('.save-btn').style.display = 'none';
    }
</script>

</body>

</html>
