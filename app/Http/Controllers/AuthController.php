<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        // logger($request);

        if (Auth::attempt($data)) {
            // dd('Login berhasil!', $request->all());
            return redirect()->route('dashboard.home')->with('success', 'berhasil login');
        }

        dd('login gagal');

        return back()->withErrors('error', $data);
    }


    public function logout() {
        Auth::logout();
        return redirect()->route('index')->with('success', 'berhasil logout');
    }
}
