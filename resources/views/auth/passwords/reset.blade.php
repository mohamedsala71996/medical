{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
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
  <link rel="stylesheet" href="{{asset('newDesign_assets/./css/main.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
  <script src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body>
  <div class="container-fluid d-flex justify-content-center  val   ">


    <form method="POST" action="{{ route('password.update') }}" class="row g-3 needs-validation   justify-content-center  align-items-center   mb-5 mt-2 ">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

      <div class="text-center d-flex flex-column  gap-2  ">
        <h3 data-Lang="new_Password" class=" pt-2   text-center  ">login</h3>
        <h6 style="color: #8B8B8B;" data-Lang="different_password">different password</h6>
      </div> 
      <div class="">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="input-group     col-sm ">
          <label for="exampleFormControlInput1" class="form-label  " data-Lang="email">Email </label>
          <div class="input-group  border border-dark rounded overflow-hidden      ">
            <input placeholder="email" type="email" class=" form-control border-0" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus id="email"
              aria-describedby="inputGroupPrepend" required>
          </div>
        </div>
      </div>
      <div class="">

        <div class="input-group     col-sm ">
          <label for="exampleFormControlInput1" class="form-label  " data-Lang="password">password </label>
          <div class="input-group  border border-dark rounded overflow-hidden      ">
            <span class="input-group-text  " id="inputGroupPrepend"><img id="Pass" src="{{ asset('newDesign_assets/img/pass.svg') }}"
                alt=""></span>
            <input placeholder="password" type="password" class=" form-control border-0" name="password" required autocomplete="new-password"  id="password"
              aria-describedby="inputGroupPrepend" required>
          </div>
        </div>
      </div>
      <div class="">


        <div class="input-group     col-sm ">
          <label for="exampleFormControlInput1" class="form-label" data-Lang="confirm_Password">confirm Password
          </label>
          <div class="input-group  border border-dark rounded overflow-hidden     ">
            <span class="input-group-text  " id="inputGroupPrepend"><img id="confirmImg" src="{{ asset('newDesign_assets/img/pass.svg') }}"
                alt=""></span>
            <input placeholder="confirm Password" type="password" name="password_confirmation" autocomplete="new-password" class="form-control  border-0 " id="confirm"
              aria-describedby="inputGroupPrepend" required>
          </div>
        </div>
      </div>
      <button id="insert" style="background-color: #4C3FD7;width: 97%; height: 42px;"
        class="mt-4 btn btn-primary customHover" type="submit" data-Lang="confirm_Password">Save</button>

  </div>
  </form>
  </div>

       <script src="{{asset('newDesign_assets/./js/script.js')}}" type="module"></script>
       <script src="{{asset('newDesign_assets/./js/main.js')}}"></script>
       <!--sweetalret-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // $('#insert').click(function () {
    //   Swal.fire({
    //     title: "verified !",
    //     text: "Your account has been verified successfully",
    //     icon: "success",
      
    //   });
    // });
  </script>
  
  <!--sweetalret-->
</body>

</html>