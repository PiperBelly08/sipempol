<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function page()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|same:password|min:8',
        ]);

        $user = User::create($validated)->assignRole('customer');
        Pelanggan::create([
            'nama' => $user->name,
            'email' => $user->email,
            'telepon' => '',
            'alamat' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
