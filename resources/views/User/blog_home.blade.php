<?php
if(Auth::check()){
    $username = Auth::user()->username;
    $img = Auth::user()->img;
    $userId = Auth::id();
}
?>
@extends('layouts.user_layout')
@section("title","home")
@section("content")
        <!-- Main Body -->
        <div class="container-floid d-flex align-items-center justify-content-center bg-white-gray m-0" style="height: 83vh;">
            <div id="postPart" class="w-75 h-100  text-center shadow bg-gray-white" style="height: 100vh;">
                <div class="mt-2">
                    <!-- Old Posts -->
                    @foreach($posts as $post)
                    <div class="mb-4  bg-light border-thick">
                        <div class=" my-3 bg-light  text-start m-2">
                            <div class="  d-flex align-items-center">
                                <img src="{{asset('images/' . $post['img'])}}" class="rounded-circle" style="width: 70px; height: 70px;">
                                <div class="mx-2">
                                    <h2 class="mb-0">{{$post['username']}}</h2>
                                    <p>{{$post['date']}}</p>
                                </div>
                                <h2 class="mx-5">{{$post['title']}}</h1>
                            </div>
                            <div class="cke">
                                    {!! $post['post_text'] !!}
                            </div>
                        </div>
                        <div class="bg-moroon">
                            <hr class="text-light">
                            <p class="text-light">Comments</p>
                            <hr class="text-light">                            
                        </div>

                        <!-- Comments -->
                        @foreach ($comments as $comment )
                            @if ($comment['post_id']==$post['post_id'] && $comment['accepted'])
                            <div id="comment" class="mx-5 mb-4 bg-light text-start w-75">
                                <div class="  d-flex align-items-center px-5">
                                    <img src="{{asset('images/'  .  $comment['img'])}}" class="rounded-circle" style="width: 70px; height: 70px;">
                                    <div class="w-25">
                                        <h2 class="mb-0">{{$comment['username']}}</h2>
                                        <p>{{ $comment['date'] }}</p>
                                    </div>
                                    <p class="mx-5">{{$comment['comment_content']}}</p>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        <!-- add a Comment -->
                        @if(Auth::check())
                        <div id="comment" class="mx-5 mb-4 bg-light text-start w-75">
                            <div class="  d-flex align-items-center px-5">
                                <img src="{{asset('images/'  .  $img)}}" class="rounded-circle" style="width: 70px; height: 70px;">
                                <div class="">
                                    <h2 class="mb-0"></h2>
                                    <p></p>
                                </div>
                                <form method="post" action="{{route('User.addComment')}}" class=" w-75">
                                    @csrf
                                    <input type="hidden" id="user_id" name="user_id" value="{{ $userId }}">
                                    <input type="hidden" id="post_id" name="post_id" value="{{ $post['post_id'] }}">
                                    <textarea class="mx-5 mt-2 mb-0 w-100" name="comment_content" id="comment_content" rows="1" placeholder="write a comment" required></textarea>
                                    <button class="mx-5 border-0 mt-0 mb-2 bg-moroon text-white" type="submit">Send your comment</button>
                                </form>
                                @error('user_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                @enderror  
                                @error('post_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                @enderror  
                                @error('comment_content')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                @enderror  
                            </div>
                        </div>
                        @endif
                    </div>


                    @endforeach
                </div>

            </div>

        </div>
        <script src="{{ asset('js/registration.js') }}"></script>
@endsection