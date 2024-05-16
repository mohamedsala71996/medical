{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!doctype html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Reset password</title>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>

    <div class="card-body">
        <div class="container-fluid d-flex justify-content-center  val   ">
            <form method="POST" action="{{ route('password.email') }}" id="passwordResetRequestForm"
                class="row g-3 needs-validation   justify-content-center  align-items-center   mb-5 mt-2 ">
                @csrf
                <div
                    class=" container     d-flex flex-column  justify-content-center align-items-center   my-3 text-center">
                    <h2 class="text-center" data-Lang="forgot_Password"> Forgot Password</h2>
                    <p style="color: #8B8B8B;" data-Lang="Enter_your_email" class=" m-auto w-75">Enter your email</p>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="mb-3 row p-0 ">
                    <label for="email" class="form-label" data-Lang="Email">Email </label>
                    <input type="email"
                        class=" m-auto form-control   border-dark form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        id="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class=" text-center m-auto ">
                    <span id="emailError" class="error-message"></span>
                </div>
                <button {{-- onclick="sendOTP()"  --}} style="background-color: #4C3FD7; height: 42px;"
                    class="btn btn-primary  customHover " type="submit" data-Lang="send">send</button>
                {{-- <a href="forgotgass-te.html" class="text-decoration-none text-info">try with your phone number</a> --}}
            </form>
        </div>

        <script>
            // function sendOTP() {
            //     let emailInput = document.getElementById("email");
            //     let email = emailInput.value.trim();
            //     let emailError = document.getElementById("emailError");
            //     emailError.textContent = "";

            //     if (!email) {
            //         emailError.textContent = "Please enter your email address.";
            //         return;
            //     }
            //     if (!validateEmail(email)) {
            //         emailError.textContent = "Please enter a valid email address.";
            //         return;
            //     }
            //     window.location.href = "verfication.html?email=" + email;
            // }

            // function validateEmail(email) {
            //     let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            //     return emailRegex.test(email);
            // }
        </script>
        <script src="{{ asset('newDesign_assets/./js/script.js') }}" type="module"></script>
        <script src="{{ asset('newDesign_assets/./js/main.js') }}"></script>

</body>

</html>
