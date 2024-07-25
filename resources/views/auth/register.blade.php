<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>{{ __('Register') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('newDesign_assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('newDesign_assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('newDesign_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('newDesign_assets/css/main.css') }}">
</head>
<body>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="position-absolute z-3 p-1 mt-2">
            <div class="dropdown">
                <i class="fa-solid fa-globe dropbtn"></i>
                <div class="dropdown-content rounded">
                    <a href="{{ route('localeChange', 'en') }}" class="d-flex">
                        <img src="{{ asset('img/england.png') }}" style="width: 30px; background-color:darkgoldenrod; border-radius: 5px; border: .2px solid white;" title="English">
                    </a>
                    <a href="{{ route('localeChange', 'ar') }}" class="d-flex">
                        <img class="al" src="{{ asset('img/eg.png') }}" style="width: 30px; background-color:darkgoldenrod; border-radius: 5px; border: .2px solid white;" title="عربي">
                    </a>
                </div>
            </div>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('newDesign_assets/img/main.png') }}" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('newDesign_assets/img/main2.png') }}" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('newDesign_assets/img/main3.png') }}" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
    </div>

    <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" class="screen container-fluid m-auto row g-3 needs-validation justify-content-center align-items-center mb-5">
        @csrf
        <h3 class="pt-2 text-center fw-bold">{{ __('Register') }}</h3>
        <div class="mb-3 row p-0">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input style="width: 95%;" type="email" name="email" class="m-auto form-control border border-dark rounded" id="email" placeholder="name@example.com">
        </div>
        <div class="row p-0">
            <div class="mb-3 col">
                <label for="firstName" class="form-label">{{ __('Name') }}</label>
                <input type="text" name="name" class="form-control border border-dark rounded" id="firstName" placeholder="{{ __('Name') }}">
            </div>
        </div>
        <div class="row p-0">
            <div class="input-group col-sm">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <div class="input-group border border-dark rounded overflow-hidden">
                    <span class="input-group-text" id="inputGroupPrepend">
                        <img src="{{ asset('newDesign_assets/img/pass.svg') }}" id="Pass" alt="">
                    </span>
                    <input placeholder="{{ __('Password') }}" name="password" type="password" class="form-control border-0" id="password" aria-describedby="inputGroupPrepend" required>
                </div>
            </div>
            <div class="input-group col-sm">
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <div class="input-group border border-dark rounded overflow-hidden">
                    <span class="input-group-text" id="inputGroupPrepend">
                        <img id="confirmImg" src="{{ asset('newDesign_assets/img/pass.svg') }}" alt="">
                    </span>
                    <input placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" class="form-control border-0" id="password_confirmation" aria-describedby="inputGroupPrepend" required>
                </div>
            </div>
        </div>
        <div class="row mt-3 p-0">
            <div class="input-group col-sm">
                <label for="type" class="form-label">{{ __('Type') }}</label>
                <select name="type" id="type" class="form-select col-sm border border-dark rounded overflow-hidden" aria-label="Default select example">
                    <option selected disabled>{{ __('Choose') }}</option>
                    <option value="1">{{ __('User') }}</option>
                    <option value="2">{{ __('Doctor') }}</option>
                    <option value="3">{{ __('diabetes educator') }}</option>
                </select>
            </div>
            <div class="input-group col-sm">
                <label for="date_of_birth" class="form-label">{{ __('Date of Birth') }}</label>
                <div class="input-group">
                    <input placeholder="{{ __('Date of Birth') }}" type="date" name="date_of_birth" class="form-control border border-dark rounded overflow-hidden" id="date_of_birth" aria-describedby="inputGroupPrepend" required>
                </div>
            </div>
        </div>
        <div class="row mt-3 p-0 d-none" id="file-inputs">
            <div class="mb-3 col">
                <label for="face_id_card" class="form-label">{{ __('Face ID Card') }}</label>
                <input type="file" name="face_id_card" class="form-control border border-dark rounded d-block" id="face_id_card">
            </div>
            <div class="mb-3 col">
                <label for="back_id_card" class="form-label">{{ __('Back ID Card') }}</label>
                <input type="file" name="back_id_card" class="form-control border border-dark rounded d-block"  id="back_id_card">
            </div>
        </div>
        
        <div class="mt-3 row p-0">
            <label for="phone_Number" class="form-label">{{ __('Phone Number') }}</label>
            <input style="width: 95%;" type="text" name="phone" class="m-auto form-control border border-dark rounded" id="phone_Number">
        </div>
        <input type="hidden" name="latitude" value="{{ old('latitude') }}" id="latitude">
        <input type="hidden" name="longitude" value="{{ old('longitude') }}" id="longitude">
        <div id="map" style="height: 500px;width: 100%;"></div>

        <button style="width: 95%; height: 47px; background-color: #4C3FD7;" class="btn btn-primary customHover" type="submit">{{ __('Create New Account') }}</button>
        <div class="d-flex gap-1 justify-content-center m-auto p-3">
            <p>{{ __('You have an account') }}</p>
            <a href="{{ route('login') }}" class="text-primary text-decoration-underline">{{ __('Login') }}</a>
        </div>
    </form>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('newDesign_assets/js/main.js') }}"></script>
    <script>
        document.getElementById('type').addEventListener('change', function() {
            var fileInputs = document.getElementById('file-inputs');
            if (this.value == '2' || this.value == '3') {
                fileInputs.classList.remove('d-none');
            } else {
                fileInputs.classList.add('d-none');
            }
        });
    </script>

<script>
    $("#pac-input").focusin(function() {
        $(this).val('');
    });
  
    $('#latitude').val('');
    $('#longitude').val('');
  
    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 24.740691, lng: 46.6528521},
            zoom: 13,
            mapTypeId: 'roadmap'
        });
  
        var marker = new google.maps.Marker({
            position: {lat: 24.740691, lng: 46.6528521},
            map: map,
            title: 'Drag me!',
            draggable: true
        });
  
        google.maps.event.addListener(marker, 'dragend', function(event) {
            document.getElementById("latitude").value = this.getPosition().lat();
            document.getElementById("longitude").value = this.getPosition().lng();
        });
  
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(pos);
                marker.setPosition(pos);
                document.getElementById("latitude").value = pos.lat;
                document.getElementById("longitude").value = pos.lng;
            }, function() {
                handleLocationError(true, map.getCenter());
            });
        } else {
            handleLocationError(false, map.getCenter());
        }
    }
  
    function handleLocationError(browserHasGeolocation, pos) {
        var content = browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.';
        var options = {
            map: map,
            position: pos,
            content: content
        };
        var infowindow = new google.maps.InfoWindow(options);
        infowindow.open(map);
        map.setCenter(pos);
    }
  
    document.getElementById('add-phone-number').addEventListener('click', function() {
        var phoneNumbersDiv = document.getElementById('phone-numbers');
        var index = phoneNumbersDiv.children.length;
        var div = document.createElement('div');
        div.className = 'form-group mb-4';
        div.innerHTML = `
            <select class="form-control" name="phone_numbers[${index}][title]" required>
                        <option value="whatsapp">Whatsapp</option>
                        <option value="mobile">Mobile</option>
                        <option value="landline">Landline</option>
                        <option value="telegram">Telegram</option>
            </select>
            <input type="text" class="form-control" name="phone_numbers[${index}][phone_number]" placeholder="Phone Number" required>
        `;
        phoneNumbersDiv.appendChild(div);
    });
  
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDc4op2z5AnCNM5hgYKl5M4mDsV_rILD4Y&libraries=places&callback=initAutocomplete&language=ar&region=EG" async defer></script>

  
</body>
</html>
