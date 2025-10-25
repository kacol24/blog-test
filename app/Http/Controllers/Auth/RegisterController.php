<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed',
        ]);

        User::create($validated);

        return to_route('login')->withSuccess('Register success, please login');
    }
}
