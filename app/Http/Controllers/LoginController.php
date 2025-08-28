<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Show the login page.
     */
    public function page()
    {
        return view('pages.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang, '.auth()->user()->name.'!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout()
    {
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        auth()->logout();
        return redirect('/login')->withCookie(cookie()->forget('laravel_session'))->with('success', 'Anda telah logout.');
    }
}
