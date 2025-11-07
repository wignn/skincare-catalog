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
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|min:8|max:50',
        ]);

        if(Auth::attempt($request->only('email', 'password'), $request->filled('remember'))){

            $request->session()->regenerate();

            if(Auth::user()->role == 'customer') {
                return redirect('/view/id_product');
            }
            return redirect('/admin');
        }
        return back()->withErrors(['failed' => 'Email atau kata sandi salah.'])->withInput();
    }



    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email|max:50',
            'password' => 'required|min:8|max:50',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'customer',
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect('/view/id_product');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function google_redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function google_callback(Request $request){
        $googleuser = Socialite::driver('google')->user();
        $user = User::whereEmail($googleuser->email)->first();
        if(!$user){
            $user = User::create([
                'name' => $googleuser->name,
                'email' => $googleuser->email,
                'role'     => 'customer',
            ]);
        }
        Auth::login($user);
        $request->session()->regenerate();
        if($user->role == 'admin')return redirect('/admin');
        return redirect('/view/id_product');
    }
}
