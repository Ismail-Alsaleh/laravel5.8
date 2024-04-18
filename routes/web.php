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
        //delete post
        Route::get('/post_editor/deletePost/{post_id}',[PostController::class, 'deletePost'])->name('deletePost');
        //add comment
        Route::post('/post_editor/addComment',[CommentController::class, 'addComment'])->name('addComment');
        //delete comment
        Route::get('/post_editor/deleteComment/{comment_id}',[CommentController::class, 'deleteComment'])->name('deleteComment');
        //accept comment
        Route::get('/post_editor/acceptComment/{comment_id}',[CommentController::class, 'acceptComment'])->name('acceptComment');
        //blog for users
        Route::get('/Blog/posts',function(){
            $comments = CommentController::getComments();
            $posts = PostController::getPosts();
            return view('blogUser.blog_home', ['comments' => $comments, 'posts' => $posts]);
        })->name('blog');
        //blog for admin
        Route::get('/Blog/post_editor',function(){
            $comments = CommentController::getComments();
            $posts = PostController::getPosts();
            return view('blogUser.post_editor', ['comments' => $comments, 'posts' => $posts]);
        })->name('post_editor');
        //logout
        Route::get('/Blog/logout', [BlogUserController::class, 'logout'])->name('logout');
    });
});