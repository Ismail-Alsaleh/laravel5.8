<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\CreateBlogUserRequest;
use App\Jobs\SendEmailJob;
use App\Models\BlogUser;
use App\Notifications\NewUserNotification;
use App\Services\BlogUserService;
use App\Traits\ImageTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\File;
use Illuminate\Validation\ValidationException;
use session;

class BlogUserController extends Controller
{
    use ImageTrait;

    public function __construct(
        BlogUserService $blogUserService
    ){
        $this->blogUserService = $blogUserService;
    }
    public function authenticate(Request $request){
        $cridentials = $request->only('username','password');
        $user = BlogUser::where('username', $request['username'])->first();
        if(Auth::guard('blogUser')->attempt($cridentials)){
 
            return redirect()->route('blogUser.blog');
        }else{
            return back()->withErrors(['error'=>'username or password are incorrect']);
        }
    }
    public function blogUserRegistration(CreateBlogUserRequest $request){
        $data = $request->all();
        if($request->img){
            $data['img'] = $this->verifyAndUpload($request,'img','images');
            // $path = $request->file('img')->store('temp');
            // $file = $request->file('img');
            // $fileName = $file->getClientOriginalName();
            // $fileName = strval($request->username) .  $fileName;
            // $file->move(public_path('images'), $fileName);
        }else{
            if($request->gender=='male'){
                $fileName = 'man.jpg';
            }else{
                $fileName = 'woman.jpg';
            }
            $data['img'] = $fileName;
        }
        // return response()->json( ['success' => $data['image']] );
        $user = $this->blogUserService->blogUserRegistration($data);
        // $user = new BlogUser([
        //     'username' => $request->input('username'),
        //     'gender'=> $request->input('gender'),
        //     'email'=> $request->input('email'),
        //     'password'=> $request->input('password'),
        //     'img' => $fileName
        // ]);
        // $user->save();
        // event(new UserRegistered($user));
        dispatch(new SendEmailJob($user));
        return response()->json( ['success' => 'Customer registered successfully!'] );
    }
    use AuthenticatesUsers;
    public function logout(Request $request): RedirectResponse{
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('blogUser.login');
    }
    // public function notif(){
    //     $blogUser = BlogUser::find(1);
    //     $user->notify(new NewUserNotification());
    // }

    public function showUsers(){
        $users = BlogUser::get();
        return view('blogUser.users_list',['users' => $users]);
    }
}
// some comment