<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|email|max:250',
            'password' => 'required',
        ]);
        $email = $req->email;
        $password = $req->password;
        $user_data = array(
            'email'  => $email,
            'password' => $password
        );

        if (Auth::attempt($user_data)) {
            $req->session()->regenerate();
            return response()->json([
                'success' => true,
            ]);
        } else {
            $user = User::where('email',$email)->first();
            if(!$user) {
                $errors = ['email' => ['Email not found.']];
            } 
            if ($user && !Hash::check($password, $user->password)) {
                $errors = ['password' => ['Password not match.']];
            }
            return response([
                'errors' => $errors,
            ],401);
        }
    }

    public function logout(Request $req)
    {
        Auth::logout();
        return response()->noContent();
    }

}
