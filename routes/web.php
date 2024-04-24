<?php

use App\Http\Controllers\BlogUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::name('blogUser.')->group(function(){

    Route::middleware('guest:blogUser')->group(function(){
        //login
        Route::post('/Blog/login', [BlogUserController::class, 'authenticate'])->name('login');
        Route::get('/Blog/login', function(){
            return view('blogUser.blog_login');
        })->name('login');
        //Blog Registration view
        Route::get('/Blog/Register',function(){
            return view('blogUser.blog_registration');
        })->name('blogRegister');
        //Blog registration
        Route::post('/Blog/blogUserRegistration', [BlogUserController::class, 'blogUserRegistration'])->name('blogUserRegistration');
        //about us
        Route::get('/Blog/aboutUs', function(){
            return view('blogUser.blog_about_us');
        })->name('about_us');
        //contact us

    });
    Route::middleware('auth:blogUser')->group(function(){
        Route::get('/Blog/notify', [BlogUserController::class, 'notif'])->name('notify');
        Route::get('/Blog/contactUs', function(){
            return view('blogUser.blog_contact_us');
        })->name('contact_us');
        //add post
        Route::post('/post_editor/addPost',[PostController::class, 'addPost'])->name('addPost');
        //delete posts
        Route::get('/post_editor/deletePost/{post_id}',[PostController::class, 'deletePost'])->name('deletePost');
        //add comment
        Route::post('/post_editor/addComment',[CommentController::class, 'addComment'])->name('addComment');
        //delete comment
        Route::get('/post_editor/deleteComment/{comment_id}',[CommentController::class, 'deleteComment'])->name('deleteComment');
        //accept comment
        Route::get('/post_editor/acceptComment/{comment_id}',[CommentController::class, 'acceptComment'])->name('acceptComment');
        //blog for users
        Route::get('/Blog/posts',function(){
            $posts = PostController::showPosts();
            $comments = CommentController::getComments();
            return view('blogUser.blog_home', ['comments' => $comments, 'posts' => $posts]);
        })->name('blog');
        //blog for admin
        Route::get('/Blog/post_editor',function(){
            $comments = CommentController::getComments();
            $posts = PostController::showPosts();
            return view('blogUser.post_editor', ['comments' => $comments, 'posts' => $posts]);
        })->name('post_editor');
        //logout
        Route::get('/Blog/logout', [BlogUserController::class, 'logout'])->name('logout');

        Route::get('Blog/show', [BlogUserController::class, 'showUsers'])->name('show');
        // Route::get('Blog/showUsers', function(){
        //     return view('blogUser.users_list');
        // })->name('showUsers');
    });
});

Route::name('User.')->group(function(){

    Route::middleware('guest:User')->group(function(){
        //login
        Route::post('/User/login', [UserController::class, 'authenticate'])->name('login');
        Route::get('/User/login', function(){
            return view('User.blog_login');
        })->name('login');
        //Blog Registration view
        Route::get('/User/Register',function(){
            return view('User.blog_registration');
        })->name('blogRegister');
        //Blog registration
        Route::post('/User/blogUserRegistration', [UserController::class, 'UserRegistration'])->name('blogUserRegistration');
        //about us
        Route::get('/User/aboutUs', function(){
            return view('User.blog_about_us');
        })->name('about_us');
        //contact us

    });
    Route::middleware('auth:User')->group(function(){
        Route::get('/User/notify', [UserController::class, 'notif'])->name('notify');
        Route::get('/User/contactUs', function(){
            return view('User.blog_contact_us');
        })->name('contact_us');
        //add post
        Route::post('/User_editor/addPost',[PostController::class, 'addPost'])->name('addPost');
        //delete posts
        Route::get('/User_editor/deletePost/{post_id}',[PostController::class, 'deletePost'])->name('deletePost');
        //add comment
        Route::post('/User_editor/addComment',[CommentController::class, 'addComment'])->name('addComment');
        //delete comment
        Route::get('/User_editor/deleteComment/{comment_id}',[CommentController::class, 'deleteComment'])->name('deleteComment');
        //accept comment
        Route::get('/User_editor/acceptComment/{comment_id}',[CommentController::class, 'acceptComment'])->name('acceptComment');
        //blog for users
        Route::get('/User/posts',function(){
            $posts = PostController::showPosts();
            $comments = CommentController::getComments();
            return view('User.blog_home', ['comments' => $comments, 'posts' => $posts]);
        })->name('blog');
        //blog for admin
        Route::get('/User/post_editor',function(){
            $comments = CommentController::getComments();
            $posts = PostController::showPosts();
            return view('User.post_editor', ['comments' => $comments, 'posts' => $posts]);
        })->name('post_editor');
        //logout
        Route::get('/User/logout', [UserController::class, 'logout'])->name('logout');

        Route::get('User/show', [UserController::class, 'showUsers'])->name('show');
        // Route::get('Blog/showUsers', function(){
        //     return view('User.users_list');
        // })->name('showUsers');
    });
});