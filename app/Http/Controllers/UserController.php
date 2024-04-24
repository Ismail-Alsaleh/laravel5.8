<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function authenticate(Request $request){
        $cridentials = $request->only('username','password');
        $user = BlogUser::where('username', $request['username'])->first();
        if(Auth::guard('blogUser')->attempt($cridentials)){
 
            return redirect()->route('blogUser.blog');
        }else{
            return back()->withErrors(['error'=>'username or password are incorrect']);
        }
    }
    public function blogUserRegistration(Request $request){
        $data = $request->all();
        // return response()->json( ['success' => $data['image']] );
        $user = new BlogUser([
            'name' => $request->input('username'),
            'email'=> $request->input('email'),
            'password'=> $request->input('password'),
        ]);
        $user->save();
        // event(new UserRegistered($user));
        // dispatch(new SendEmailJob($user));
        return response()->json( ['success' => 'Customer registered successfully!'] );
    }
    use AuthenticatesUsers;
    public function logout(Request $request): RedirectResponse{
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('User.login');
    }
    // public function notif(){
    //     $blogUser = BlogUser::find(1);
    //     $user->notify(new NewUserNotification());
    // }

    public function showUsers(){
        $users = BlogUser::get();
        return view('User.users_list',['users' => $users]);
    }
}
