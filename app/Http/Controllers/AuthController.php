<?php

namespace App\Http\Controllers;

use App\Events\UserStatusEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class AuthController extends Controller
{
    public function login(){
        return inertia('Auth/Login');
    }

    public function login_User(Request $request){
        $credentials = $request->validate([
            'email'=>['required', 'email'],
            'password'=>['required']
        ]);

        if(Auth::attempt($credentials, $request->remember)){
            $user=User::where('email', '=', $request->email)->first();
          /*   dd($request->session());
            $request->session()->regenerate();
            $user->status = 'ligne';
            $user->save(); */
          //  Broadcast(new UserStatusEvent($user));
            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    } 

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
     
        return redirect('/');

    }

    public function register(){
        return inertia('Auth/Register');
    }

    public function store(Request $request){

        $user = User::create($request->validate([
            'name'=>"required",
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed'
        ]));
        Auth::login($user);
        return redirect()->intended()->with('success', 'account create');
    }

}
