<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email' => 'required|varchar|exists:users,email|max:50',
            'password' => 'required|varchar|min:8|max:50',
        ]);
        if(Auth::attempt($request->only('email', 'password'), $request->remember)){
            return redirect('/dashboard');
        }

        return back()->with('failed', 'Email atau kata sandi salah.');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email|max:50',
            'password' => 'required|min:8|max:50',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::create($request->all());

        Auth::login($user);
        return redirect('/dashboard');
    }

    public function google_redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function google_callback(){
        $googleuser = Socialite::driver('google')->user();
        $user = User::whereEmail($googleuser->email)->first();
        if(!$user){
            $user = User::create([
                'name' => $googleuser->name,
                'email' => $googleuser->email,
            ]);
        }
        Auth::login($user);
        if($user->role == 'customer')return redirect('/dashboard');
        return redirect('/admin/dashboard');
    }
}
