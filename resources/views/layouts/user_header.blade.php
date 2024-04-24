<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/publicCSS.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css"></link>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

        <style>
            .error{
                color: red !important;
            }
            label.error{
                width: 100%;
            }
        </style>
        <title>@yield("title")</title>
    </head>
    <body>
        <!-- Navigation Menu -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-header">
            <div class="container-fluid">
                <a class="navbar-brand fs-2" href="{{route('blogUser.blog')}}"><img src="{{asset('images/hayhomWhite.png')}}" alt="Hayhom" style="width: 30px; height: 47px;"></a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto fs-3">
                        <li class="nav-item  px-4"><a class="nav-link text-white" href="{{route('blogUser.blog')}}">Home</a></li>
                        <li class="nav-item px-4"><a class="nav-link text-white" href="{{route('blogUser.contact_us')}}">Contact Us</a></li>
                        <li class="nav-item px-4"><a class="nav-link text-white" href="{{route('blogUser.about_us')}}">About Us</a></li>
                    </ul>
                </div>
                    <ul class="navbar-nav mr-auto fs-3">
                    @if (Auth::check())
                        <li class="nav-item"><a class="nav-link text-white" href="{{route('blogUser.logout')}}">Logout <i class="bi bi-door-closed-fill"></i></a></li>
                    @else
                        <li class="nav-item"><a class="nav-link text-white" href="{{route('blogUser.login')}}">login <i class="bi bi-door-open-fill"></i></a></li>
                    @endif
                        <li class="nav-item"><a class="nav-link text-white mx-3" href="{{route('blogUser.post_editor')}}">Admin</a></li>
                    </ul>
            </div>
        </nav>