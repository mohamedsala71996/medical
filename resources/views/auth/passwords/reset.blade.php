<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Reset password</title>
    <link rel="stylesheet" href="{{ asset('newDesign_assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

    <script>
        // Example of using SweetAlert for success message
        // Uncomment this block if you want to show a success message after form submission
        /*
        $('#insert').click(function () {
            Swal.fire({
                title: "{{ __('Password') }}",
                text: "{{ __('Your account has been verified successfully') }}",
                icon: "success",
            });
        });
        */
    </script>
</head>

<body>
    <div class="container-fluid d-flex justify-content-center val">

        <form method="POST" action="{{ route('password.update') }}"
            class="row g-3 needs-validation justify-content-center align-items-center mb-5 mt-2">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="text-center d-flex flex-column gap-2">
                <h3 data-Lang="new_Password" class="pt-2 text-center">{{ __('login') }}</h3>
                <h6 style="color: #8B8B8B;" data-Lang="different_password">{{ __('different password') }}</h6>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-sm">
                <label for="email" class="form-label" data-Lang="email">{{ __('Email') }}</label>
                <div class="input-group border border-dark rounded overflow-hidden">
                    <input placeholder="{{ __('email') }}" type="email"
                        class="form-control border-0 @error('email') is-invalid @enderror" name="email"
                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus id="email">
                </div>
            </div>

            <div class="col-sm">
                <label for="password" class="form-label" data-Lang="password">{{ __('password') }}</label>
                <div class="input-group border border-dark rounded overflow-hidden">
                    <span class="input-group-text"><img id="Pass" src="{{ asset('newDesign_assets/img/pass.svg') }}"
                            alt=""></span>
                    <input placeholder="{{ __('password') }}" type="password" class="form-control border-0"
                        name="password" required autocomplete="new-password" id="password">
                </div>
            </div>

            <div class="col-sm">
                <label for="confirm" class="form-label" data-Lang="confirm_Password">{{ __('Confirm Password') }}</label>
                <div class="input-group border border-dark rounded overflow-hidden">
                    <span class="input-group-text"><img id="confirmImg"
                            src="{{ asset('newDesign_assets/img/pass.svg') }}" alt=""></span>
                    <input placeholder="{{ __('confirm Password') }}" type="password"
                        name="password_confirmation" autocomplete="new-password"
                        class="form-control border-0" id="confirm">
                </div>
            </div>

            <button id="insert" style="background-color: #4C3FD7; width: 97%; height: 42px;"
                class="mt-4 btn btn-primary customHover" type="submit"
                data-Lang="confirm_Password">{{ __('Save') }}</button>

        </form>
    </div>

    <script src="{{ asset('newDesign_assets/js/script.js') }}" type="module"></script>
    <script src="{{ asset('newDesign_assets/js/main.js') }}"></script>
    <!--sweetalret-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
