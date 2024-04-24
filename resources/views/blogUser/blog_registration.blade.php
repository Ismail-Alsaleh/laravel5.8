@extends('layouts.layout')
@section("title","Admin")
@section('content')
        <!-- Main Body -->
        <div class="container-floid d-flex align-items-center justify-content-center bg-custom1 m-0" style="height: 83vh;">
            <div id="registerPart" class="w-50 h-75 bg-custom6 text-center shadow ">
                <div class="bg-custom-yellow pt-3 m-0"></div>
                <div class="mb-2">
                    <h1 class="mb-0 mt-0 display-6 mt-4" >Registration Form</h1>
                    <hr class="text-white">
                    @if($errors->has('error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('error') }}
                        </div>
                    @endif

                </div>
                <!-- registration form -->
                <form method="POST" action="{{route('blogUser.blogUserRegistration')}}" enctype="multipart/form-data" class="mb-4 text-start mx-5" id="registrationForm">
                    @csrf
                    <div class="mb-3">
                        <div class="name-group">
                            <label for="username" class="">username:</label>
                        </div>
                        <input type="text" class="py-2 w-100 border-0" id="username" name="username" placeholder="Username">
                    </div>
                    <span class="username text-danger"></span>
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
                        <input type="email" class="py-2 w-100 border-0" id="email" name="email" placeholder="Enter Email">
                        <span class="email text-danger"></span>
                    </div>
                    
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-2">
                        <div class="passowrd-group">
                            <label for="password">Password</label>
                        </div>
                        <input type="password" class="py-2 w-100 border-0"  id="password" name="password" placeholder="Enter Password">
                    </div>
                    <div class="">
                        <div class="">
                            <label for="repassword">Re-type Password</label>
                        </div>
                        <input type="password" class="py-2 w-100 border-0"  id="repassword" name="repassword" placeholder="Re-type Password">
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mt-1">
                        <label for="img">Add Image</label>
                        <input type="file" class="" id="img" name="img" accept=".jpg,.jpeg,.png">
                    </div>
                    <button id="loginButton" type="submit" class="w-100 border-0 p-2 mt-3 text-white btn btn-primary">Register</button>
                </form>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-bs-dismiss="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Error</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="myModalBody">
                <div id="ErrorContainer">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
@endsection

@push('js-file')
<script src="{{asset('js/blogRegistration.js')}}"></script>
@endpush