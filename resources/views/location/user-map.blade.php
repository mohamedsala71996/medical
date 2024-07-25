<!DOCTYPE html>
<html>

<head>
    <title>User Locations</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        #map {
            height: 650px;
            width: 100%;
        }

        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: left;
        }

        .rating>input {
            display: none;
        }

        .rating>label {
            position: relative;
            width: 1em;
            font-size: 3vw;
            color: #ccc;
            cursor: pointer;
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 1;
        }

        .rating>input:checked~label::before {
            color: #FFD700;
        }

        .rating>label:hover::before,
        .rating>label:hover~label::before {
            color: #FFD700;
        }

        .fa-star.checked {
            color: #FFD700;
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

<body>
    <div id="map"></div>

    <div class="text-center mt-3">
        <h4>{{__('Distance') }}: {{ round($distance, 2) }} {{ __('km') }}</h4>
    </div>

    <div class="rating-form text-center mt-3">
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($location->user->id != Auth::id() && !$userHasRated)
        <form action="{{ route('rate.user') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $location->user->id }}">
            <div class="rating">
                <input type="radio" name="rating" id="star5" value="5"><label for="star5"></label>
                <input type="radio" name="rating" id="star4" value="4"><label for="star4"></label>
                <input type="radio" name="rating" id="star3" value="3"><label for="star3"></label>
                <input type="radio" name="rating" id="star2" value="2"><label for="star2"></label>
                <input type="radio" name="rating" id="star1" value="1"><label for="star1"></label>
            </div>
            <br><br><br><br>
            <button type="submit" class="btn btn-primary text-center">{{ __('Submit') }}</button>
        </form>
        @endif
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var userLocation = [{{ $location->latitude }}, {{ $location->longitude }}];
        var authLocation = [{{ $authLocation->latitude }}, {{ $authLocation->longitude }}];

        var map = L.map('map').setView(authLocation, 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

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

        var auth_user = L.icon({
            iconUrl: '{{ asset('img/4.png') }}',
            iconSize: [52, 52],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Add marker for authenticated user
        L.marker(authLocation, { icon: auth_user })
            .addTo(map)
            .bindPopup('{{ Auth::user()->name }}')
            .openPopup();

        @foreach ($locations as $location)
            var type = "{{ $location->user->type }}";
            var icon = (type === '1') ? user : (type === '2') ? doctor : sugar_intellectual;
            if (icon) {
                var popupOptions = {
                    maxWidth: 200,
                    closeButton: true,
                    autoClose: false,
                    closeOnClick: false,
                    className: 'custom-popup',
                };
                var userType = {!! json_encode([
                    '1' => __('Normal user'),
                    '2' => __('Doctor'),
                    '3' => __('diabetes educator'),
                ]) !!};

                var averageRating = {{ round($averageRating, 2) }};
                var countRating = {{ $countRating }};
                var stars = '';
                for (var i = 1; i <= 5; i++) {
                    stars += '<span class="fa fa-star' + (i <= averageRating ? ' checked' : '') + '"></span>';
                }

                var popupContent = `
                    {{ $location->user->name }}<br>
                    <div class='text-center'> ${userType[{{ $location->user->type }}]}</div>
                `;
                if ({{ $location->user->id }} != {{ Auth::id() }}) {
                    popupContent += `<div class='text-center'>${stars} (${countRating})</div>`;
                }

                L.marker([{{ $location->latitude }}, {{ $location->longitude }}], {
                    icon: ({{ $location->user->id }} == {{ Auth::id() }}) ? auth_user : icon
                }).addTo(map)
                .bindPopup(popupContent, popupOptions)
                .openPopup();
            }
        @endforeach

        // Add polyline between authenticated user and selected user location
        L.polyline([authLocation, userLocation], { color: 'blue' }).addTo(map);
    </script>
</body>

</html>
