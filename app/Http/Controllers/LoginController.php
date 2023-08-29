<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class LoginController extends Controller
{
    public function login(Request $req)
    {
        $email = $req->email;
        $password = $req->password;
        $user_data = array(
            'email'  => $email,
            'password' => $password
        );

        if (Auth::attempt($user_data)) {
            return response()->json([
                'success' => true,
            ]);
        } else {
            $user = User::where('email',$email)->first();
            if(!$user) {
                $errors = ['email' => 'email not found'];
            } 
            if ($user && !Hash::check($password, $user->password)) {
                $errors = ['password' => 'Wrong password'];
            }
            return response()->json([
                'error' => $errors,
            ],401);
        }
    }
}
