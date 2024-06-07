<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use App\Models\Account;

class RegisterController extends Controller
{
    public function index()
    {
        return view('/register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'student_id' => 'required|regex:/^\d{2}\-\d{4}$/|unique:account',
            'fullname' => 'required',
            'college' => 'required',
            'course' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:account|regex:/^[A-Za-z]+\.[A-Za-z0-9]+@clsu2\.edu\.ph$/i',
            'confirm_email' => 'required|email|same:email',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/',
            'password_confirmation' => 'required|same:password',
        ], [
            'student_id.regex' => 'Please input valid Student ID (e.g., 00-0000).',
            'student_id.unique' => 'Student ID is already taken.',
            'confirm_email.same' => 'Emails do not match.',
            'email.unique' => 'CLSU email is already taken.',
            'email.regex' => 'Please input valid CLSU email address.',
            'password.regex' => 'Please input a password with a combination of lowercase and uppercase letters, a number, and a symbol.',
        ]);


        $user = new Account();
        $user->student_id = $request->input('student_id');
        $user->fullname = $request->input('fullname');
        $user->college = $request->input('college');
        $user->course = $request->input('course');
        $user->gender = $request->input('gender');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->userType = 'Student';

        $user->save();

        // $user = new Account([
        //     'student_id' => $request->input('student_id'),
        //     'fullname' => $request->input('fullname'),
        //     'college' => $request->input('college'),
        //     'course' => $request->input('course'),
        //     'gender' => $request->input('gender'),
        //     'email' => $request->input('email'),
        //     // 'password' => Hash::make($request->input('password')),
        //     'role' => 0, // Set the default role to 0
        // ]);
        // $user->save();

        return redirect()->route('welcome')->with('status_registered', 'success');
    }
}
