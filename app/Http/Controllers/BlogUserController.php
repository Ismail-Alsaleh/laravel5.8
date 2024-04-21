<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\CreateBlogUserRequest;
use App\Jobs\SendEmailJob;
use App\Models\BlogUser;
use App\Notifications\NewUserNotification;
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
    public function authenticate(Request $request){
        $cridentials = $request->only('username','password');
        $user = BlogUser::where('username', $request['username'])->first();
        if(Auth::guard('blogUser')->attempt($cridentials)){
            $user = Auth::user();
            return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ]
                ]);
    
            // return redirect()->route('blogUser.blog');
            
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
            // return back()->withErrors(['error'=>'username or password are incorrect']);
        }
    }
    public function blogUserRegistration(CreateBlogUserRequest $request){
        if($request->image){
            $path = $request->file('image')->store('temp');
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $fileName = strval($request->username) .  $fileName;
            $file->move(public_path('images'), $fileName);
        }else{
            if($request->gender=='male'){
                $fileName = 'man.jpg';
            }else{
                $fileName = 'woman.jpg';
            }
        }
        $user = new BlogUser([
            'username' => $request->input('username'),
            'gender'=> $request->input('gender'),
            'email'=> $request->input('email'),
            'password'=> $request->input('password'),
            'img' => $fileName
        ]);
        $user->save();
        // event(new UserRegistered($user));
        dispatch(new SendEmailJob($user));
        // return response()->json( ['success' => 'Customer registered successfully!'] );
        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
    use AuthenticatesUsers;
    public function logout(Request $request): RedirectResponse{
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // return redirect()->route('blogUser.login');
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
    public function notif(){
        $blogUser = BlogUser::find(1);
        $user->notify(new NewUserNotification());
    }
}
// some comment