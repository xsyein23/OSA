<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User; // Make sure to import your User model

class UserController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect('/'); // Redirect to the home page or any other page after logout
    }

    public function showProfile(){

    }

    public function updateProfile(){
        
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user()->role;

            if ($user == 1 || $user == 0) {
                return redirect()->route('admin.index');
            }
            return redirect('/login')->with('error', 'Invalid credentials');
        }
    }
}
