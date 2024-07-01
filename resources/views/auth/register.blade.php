<!doctype html>
<html  >
    <head>
 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">    <title>Register</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('newDesign_assets/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('newDesign_assets/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('newDesign_assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('newDesign_assets/./css/main.css')}}">
    </head>
  <body>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000"> <!-- Set interval to 1 second -->
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
          </ol>
          <div class=" position-absolute z-3 p-1 mt-2 ">
            <div class="dropdown">
              <i class="fa-solid fa-globe dropbtn"></i>
              <div class="dropdown-content rounded">
                <a href="#" class="d-flex" > <i class="fa-solid fa-check chek-i"></i> Eng</a>
                <a href="#" class="d-flex"> <i class="fa-solid fa-check chek-i"></i> Ar</a>
               
              </div>
            </div>
          </div>
     
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{asset('newDesign_assets/img/main.png')}}" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
              <img src="{{asset('newDesign_assets/img/main2.png')}}" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
              <img src="{{asset('newDesign_assets/img/main3.png')}}" class="d-block w-100" alt="Slide 3">
            </div>
          </div>
        </div>
        
 
    <form action="{{route('register')}}" method="post" class="screen container-fluid   m-auto row g-3 needs-validation   justify-content-center  align-items-center   mb-5  ">
        @csrf
        <h3  class=" pt-2 text-center fw-bold "data-Lang="New_account">{{trans('main.Register')}}</h3>
        <div class="mb-3 row p-0 ">
            <label for="email" class="form-label" data-Lang="Email">{{trans('main.Email')}} </label>
            <input style="width: 95%;"  type="email" name="email" class=" m-auto form-control border border-dark rounded" id="email" placeholder="name@example.com">
          </div>
          <div class=" row   p-0     ">
            <div class="mb-3 col  ">
                <label for="firstName" class="form-label" data-Lang="First_Name" >{{trans('main.Name')}} </label>
                <input type="text" name="name" class="form-control border border-dark rounded" id="firstName" placeholder="First Name"/>
              </div>  
               {{-- <div class="mb-3   col-sm ">
                <label for="LastName" class="form-label" data-Lang="Last_Name">Last Name </label>
                <input type="text" class="form-control border border-dark rounded" id="LastName" placeholder="Last Name">
              </div> --}}
          </div>

          <div class=" row    p-0  ">
            <div class="input-group     col-sm ">
                <label for="exampleFormControlInput1" class="form-label  " data-Lang="password">{{trans('main.Password')}} </label>
                <div class="input-group  border border-dark rounded overflow-hidden      ">
                    <span class="input-group-text  " id="inputGroupPrepend"><img src="{{ asset('newDesign_assets/img/pass.svg') }}"  id="Pass" alt=""></span>
                    <input  placeholder="password" name="password"  type="password" class="form-control  border-0" id="password" aria-describedby="inputGroupPrepend" required>
                </div>
            </div> 
              
            <div class="input-group     col-sm ">
                <label for="exampleFormControlInput1" class="form-label" data-Lang="confirm_Password">confirm Password </label>
                <div class="input-group  border border-dark rounded overflow-hidden     ">
                    <span class="input-group-text  " id="inputGroupPrepend"><img id="confirmImg" src="{{ asset('newDesign_assets/img/pass.svg') }}" alt=""></span>
                    <input placeholder="confirm Password" type="password" name="password_confirmation" class="form-control  border-0 " id="confirm" aria-describedby="inputGroupPrepend" required>
                </div>
            </div> 
     
          </div>
                
        <div class="row mt-3 p-0">
            <div class="input-group     col-sm ">
                <label for="exampleFormControlInput1" class="form-label" data-Lang="type">Type </label>

                <select name="type" class="form-select col-sm border border-dark rounded overflow-hidden" aria-label="Default select example">
                    <option selected disabled>Choose</option>
                    <option value="1" data-Lang="user">مستخدم</option>
                    <option value="2" data-Lang="doctor" >طبيب</option>
                    <option value="3" data-Lang="Clinical nutritionist" >اخصائي تغذية علاجية</option>
                </select>  
                </div> 
                
                <div class="input-group     col-sm ">
                    <label for="exampleFormControlInput1" class="form-label" data-Lang="birthday">Date of birth </label>
                    <div class="input-group       ">
                        <input placeholder="birthday"  type="date" name="date_of_birth" class="form-control   border border-dark rounded overflow-hidden" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    </div>
                </div> 
        </div>
        <div class="mt-3 row p-0 ">
          <label for="phone_Number" class="form-label" data-Lang="phone_Number">Phone Number </label>
          <input style="width: 95%;"  type="text" name="phone" class=" m-auto form-control border border-dark rounded" id="phone_Number" >
        </div>
     
 
          <button style="width: 95%; height: 47px;background-color: #4C3FD7;" class="btn btn-primary customHover " type="submit" data-Lang="create_New_Account">create New Account</button>
          <div class="d-flex   gap-1  justify-content-center   m-auto p-3">
            <p data-Lang="you_have_an_account"> You have an account </p>
            <a href="{{ route('login') }}" class="text text-primary  text-decoration-underline"  data-Lang="login">login</a>
        </div>
        </div>
        </form>


        
        <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        {{-- <script src="{{asset('newDesign_assets/./js/script.js')}}" type="module"></script> --}}
        <script src="{{asset('newDesign_assets/./js/main.js')}}"></script>
            
     </body>
</html>