<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $user = Auth::user();
        return $user;
    }

    /**
     * Show the form for creating a new resource.
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function create(UserRequest $request)
    {   
        $validate = $request->validated();
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return response()->json([
            'status' => 'success',
            'user' => $user,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'message' => 'Post created',
            'users' => $users
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json([
            'status' => 'success',
            'user' => $user,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'user_name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users,email,'.$id,
            'phone_number' => 'required|numeric|digits:10',
            'gender' => 'required|string|max:50',
        ]);
        $user = User::find($id);
        $fileName = '';

        if($request->hasFile('profile_path')) {
            $file = $request->file('profile_path');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            // Store the file in the 'public/profiles' directory.
            $file->storeAs('public/profiles', $fileName); 
        }
        
        if ($user) {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'user_name' => $request->user_name,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'profile_path' => $fileName ? $fileName : '',
            ]);
            return response()->json([
                'success' => true,
                'message' => 'User updated Successfully',
                'user' => $user
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'User not found'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        if ($id) {
            $user = User::find($id);
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }
            
            $photoPath = '/public/profiles/' . $user->profile_path;
            if($user->profile_path != 'default.png') {
                // Use Storage facade to delete the file
                if (Storage::exists($photoPath)) {
                    Storage::delete($photoPath);
                }
            }

            User::find($id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Post not found'
        ], 404);
    }
}