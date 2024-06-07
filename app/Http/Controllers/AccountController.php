<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Account; // Make sure to import your User model

class UserController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect('/'); // Redirect to the home page or any other page after logout
    }

    public function showProfile()
    {
    }

    public function updateProfile()
    {
    }
}
