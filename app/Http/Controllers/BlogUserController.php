<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBlogUserRequest;
use App\Models\BlogUser;
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
 
            return redirect()->route('blogUser.blog');
        }else{
            return back()->withErrors(['error'=>'username or password are incorrect']);
        }
    }
    public function blogUserRegistration(CreateBlogUserRequest $request){
        // try{
        // $this->validate($request,[       
        //         'username' => 'required|unique:blog_users',
        //         'gender' => 'required',
        //         'email' => 'required|email|unique:blog_users',
        //         'password' => 'required|min:8']);
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
        return response()->json( ['success' => 'Customer registered successfully!'] );
        // }catch(ValidationException $e){
        //     return response()->json(['error' => $e->validator->errors(), 'message'=>"Validation Failed"]);
        // }
    }
    use AuthenticatesUsers;
    public function logout(Request $request): RedirectResponse{
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('blogUser.login');
    }
}
