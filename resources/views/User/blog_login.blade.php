@extends('layouts.user_layout')
@section("title","Admin")
@section('content')
        <!-- Main Body -->
        <div class="container-floid d-flex align-items-center justify-content-center bg-custom1 m-0" style="height: 83vh;">
            <div id="registerPart" class="w-50 bg-custom6 text-center shadow align-items-center" style="height: 55%">
                <div class="bg-custom-yellow pt-3 m-0"></div>
                <div class="mb-2">
                    <h1 class="mb-0 mt-0 display-6 mt-4" >Login</h1>
                    <hr class="text-white">
                </div>
                <form method="POST" action="{{route('User.login')}}" class="mb-4 text-start mx-5" id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <div class="">
                            <label for="username1" class="">Username</label>
                        </div>
                        <input type="text" class="py-2 w-100 border-0" id="username1" name="username" placeholder="username" required>
                    </div>
                    <div class="mb-2">
                        <div class="">
                            <label for="password1">Password</label>
                        </div>
                        <input type="password" class="py-2 w-100 border-0"  id="password1" name="password" placeholder="Enter Password" required>
                    </div>
                    <button id="loginButton" class="w-100 border-0 bg-custom5 fs-3 p-2 mt-3 text-white">Login</button>
                </form>
                <a data-target="#myModal" data-toggle="modal" href="#myModal" class="fs-5 text-decoration-none text-moroon fs-3">Register</a>  
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>{{$errors}}</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" >
        <div class="modal-dialog" role="document">
        <div class="modal-content bg-registration">
            <div class="modal-header">
                <h5 class="modal-title text-center">Registration Form</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body" id="myModalBody">
                <div id="">
                    <form method="POST" action="{{route('User.blogUserRegistration')}}" enctype="multipart/form-data" class="mb-4 text-start mx-5" id="registrationForm">
                        @csrf
                        <div class="mb-3">
                            <div class="name-group">
                                <label for="username" class="">username:</label>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            </div>
                            <span class="username text-danger"></span>
                        </div>
                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-2">
                            <div class="">
                                <label for="gender">Gender :</label>
                            </div>
                            <input type="radio"  id="male" name="gender" value="male" checked>
                            <label class="" for="male">Male</label>
                            
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>
                        </div>
                        @error('gender')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-2">
                            <div class="email-group">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <span class="email text-danger"></span>
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-2">
                            <div class="passowrd-group">
                                <label for="password">Password</label>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <label for="repassword">Re-type Password</label>
                            </div>
                            <div class="input-group mb-3 ">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Re-type Password">
                            </div>
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mt-1">
                            <label for="img">Add Image</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-image"></i></span>
                                <input type="file" class="form-control" id="img" name="img" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="registrationButton" type="submit" class="w-100 border-0 p-2 mt-3 text-white btn bg-registration-btn">Register</button>
                </form>
            </div>
        </div>
        </div>
        </div>
@push('js-file')
<script src="{{asset('js/blogRegistration.js')}}"></script>
@endpush

@endsection