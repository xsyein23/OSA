<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Account;

class LoginController extends Controller
{
    public function index()
    {
        return view('/login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // \Log::info('User authenticated: ' . $user->email);
            // \Log::info('User authenticated: ' . $user->password);

            if ($user->userType == 'Admin' || $user->userType == 'Student') {
                return redirect()->route('welcome');
            } else {
                // \Log::info('User role is not allowed: ' . $user->role);
                return redirect()->route('login')->with('error', 'Access denied.');
            }
        } else {
            // \Log::info('Authentication failed for email: ' . $credentials['email']);
        }

        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }


    public function authenticatess(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if ($user->role == 1 || $user->role == 0) {

                // \Log::info('User authenticated: ' . $user->fullname);

                return redirect()->route('welcome');
            }
        }

        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }
}
