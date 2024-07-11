<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>{{ __('Login') }}</title>
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
                        <img src="{{ asset('img/england.png') }}"
                            style="width: 30px; background-color:darkgoldenrod; border-radius: 5px; border: .2px solid white;"
                            title="English">
                    </a>
                    <a href="{{ route('localeChange', 'ar') }}" class="d-flex">
                        <img class="al" src="{{ asset('img/eg.png') }}"
                            style="width: 30px; background-color:darkgoldenrod; border-radius: 5px; border: .2px solid white;"
                            title="عربي">
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

    <div class="container-fluid d-flex justify-content-center val">
        <form action="{{ route('login') }}" method="post"
            class="row g-3 needs-validation justify-content-center align-items-center mb-5">
            @csrf
            <h3 class="pt-2 text-center fw-bold">{{ __('login') }}</h3>
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <label for="validationCustomUsername" class="form-label">{{ __('Email') }}</label>
                <div class="input-group custom-div border border-dark rounded overflow-hidden">
                    <input type="text" class="form-control border-0" name="email" id="loginPassword"
                        aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">{{ __('Please insert email.') }}</div>
                </div>
            </div>
            <div class="mb-3">
                <label for="validationCustomUsername" class="form-label">{{ __('password') }}</label>
                <div class="input-group custom-div border border-dark rounded overflow-hidden">
                    <span class="input-group-text"><img src="{{ asset('newDesign_assets/img/pass.svg') }}"
                            id="Pass" alt=""></span>
                    <input placeholder="{{ __('password') }}" name="password" type="password"
                        class="form-control border-0" id="password" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">{{ __('Please insert password.') }}</div>
                </div>
            </div>
            <a href="{{ route('forgetPasswordEmail') }}">{{ __('Forgot password') }}</a>
            <button style="height: 42px;background-color: #4C3FD7;" class="btn btn-primary customHover"
                type="submit">{{ __('login') }}</button>
            <div class="d-flex gap-1 justify-content-center m-auto p-3">
                <p>{{ __('Don\'t have an account') }}</p>
                <a href="{{ route('register') }}"
                    class="text-primary text-decoration-underline">{{ __('Create new account') }}</a>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('newDesign_assets/js/main.js') }}"></script>
    <script>
        $('#chooseFile').bind('change', function() {
            var filename = $("#chooseFile").val();
            if (/^\s*$/.test(filename)) {
                $(".file-upload").removeClass('active');
                $("#noFile").text("{{ __('No file chosen...') }}");
            } else {
                $(".file-upload").addClass('active');
                $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
            }
        });
    </script>
    <script src="{{ asset('newDesign_assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
