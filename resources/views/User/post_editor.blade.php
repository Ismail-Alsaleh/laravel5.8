<?php
if(Auth::check()){
    $username = Auth::user()->username;
    $img = Auth::user()->img;
    $userId = Auth::id();
    $admin = Auth::user()->is_admin;
}
?>
@extends('layouts.user_layout')
@section("title","Admin")
@section('content')
        <!-- Main Body -->
        <div class="container-floid d-flex align-items-center justify-content-center bg-white-gray m-0"  style="height: 83vh;">
            @if(!$admin)
                <div class="d-flex align-items-center justify-content-center w-75 h-100 text-danger bg-white-gray text-center shadow">
                    <h1>You Do not Have Access</h1>
                </div>                
            @else
            <div id="postPart" class="w-75 h-100 bg-gray-white text-center shadow" style="height: 100vh;">
                <div class="mb-2 bg-moroon">
                    <h1 class="m-0 display-6 mt-4 text-white" >Add Post</h1>
                </div>
                <div class="px-2">
                    <!-- Making Posts -->
                    <form method="post" action="{{route('User.addPost')}}" class="text-start">
                        @csrf
                        <input type="text" id="title" name="title" placeholder="Title" class="w-100 border-0" required>
                        <textarea id="editor" name="editor"></textarea>

                        <input type="hidden" id="" name="user_id" value="{{ $userId }}">
                        <input type="hidden" id="post_text" name="post_text" required>
                        <button type="submit" class="border-0 mb-2 bg-moroon text-white">Add New Post</button>
                    </form>
                    @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror  
                    @error('post_text')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror  
                    @error('user_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror  
                    <!-- Old Posts -->
                    </div>
                    <div>
                    <div class="mb-2 bg-moroon">
                        <h1 class="mb-0 mt-0 display-6 mt-4 bg-moroon text-white" >Post's Section</h1>
                    </div>
                    @foreach($posts as $post)

                    <div class="mb-4  bg-light border-thick">
                     
                        <div class=" my-3 bg-light  text-start mx-2">
                            <div class="  d-flex align-items-center">
                                <img src="{{ asset('images/' . $post['img']) }}" class="rounded-circle" style="width: 70px; height: 70px;">
                                <div class="mx-2">
                                    <h2 class="mb-0">{{$post['username']}}</h2>
                                    <p>{{$post['date']}}</p>
                                </div>
                                <h2 class="mx-5">{{$post['title']}}</h1>
                            </div>
                            <div class="cke">
                                    {!! $post['post_text'] !!}
                            </div>
                            <a class="text-decoration-none bg-moroon text-white px-2 fs-5" href="{{route('User.deletePost',['post_id'=>$post->post_id])}}">Delete the post</a>    
                        </div>
                        <div class="bg-moroon">
                            <hr class="text-light">
                            <p class="text-light fs-4">Comments</p>
                            <hr class="text-light">                            
                        </div>
                        <!-- Comments -->
                        @foreach ($comments as $comment )
                            @if ($comment['post_id']==$post['post_id'])
                            <div id="comment" class="mx-5 mb-4 bg-light text-start w-75">
                                <div class="  d-flex align-items-center px-5">
                                    <img src="{{asset('images/'  .  $comment['img'])}}" class="rounded-circle" style="width: 70px; height: 70px;">
                                    <div class="w-25">
                                        <h2 class="mb-0">{{$comment['username']}}</h2>
                                        <p>{{ $comment['date'] }}</p>
                                    </div>
                                    <p class="mx-5">{{$comment['comment_content']}}</p>
                                </div>
                                @if (!$comment['accepted'])
                                    <a class="mx-5 text-decoration-none bg-moroon text-white px-2 fs-5" href="{{route('User.acceptComment', ['comment_id' => $comment->comment_id])}}">Accept</a>
                                    <a class="text-decoration-none bg-moroon text-white px-3 fs-5" href="{{route('User.deleteComment', ['comment_id' => $comment->comment_id])}}">Reject</a>                             
                                @endif

                            </div>
                            <hr class="text-moroon">
                            @endif
                        @endforeach
                        <!-- add a Comment -->
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
                    </div>

                
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        @if($admin)
        <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
        <script>
            var err=document.getElementById('editor');
            
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
            document.querySelector('form').addEventListener('submit', function() {
                var editorData = CKEDITOR.instances.editor.getData();
                document.getElementById('post_text').value = editorData;
            });
        </script>
        <!-- <script type="text/javascript">
            CKEDITOR.replace( 'editor' );
        </script> -->
        @endif
@endsection