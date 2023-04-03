<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|max:30|min:6',
            'password' => 'required|max:30|min:6',
        ], [
            'username.required' => 'The username field is required.',
            'username.max' => 'The username may not be greater than 30 characters.',
            'username.min' => 'The username must be at least 6 characters.',
            'password.required' => 'The password field is required.',
            'password.max' => 'The password may not be greater than 30 characters.',
            'password.min' => 'The password must be at least 6 characters.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users|max:30|min:6',
            'password' => 'required|max:30|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
