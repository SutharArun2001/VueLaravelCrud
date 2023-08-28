<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'message' => 'Post created',
            'data' => $users
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function create(UserRequest $request)
    {   
        $validate = $request->validated();
        if(!$validate) {
            return;
        }
        // $request->validate([
        //     'firstName' => 'required|string|max:250',
        //     'lastName' => 'required|string|max:250',
        //     'userName' => 'required|string|max:250',
        //     'email' => 'required|email|max:250|unique:users',
        //     'phoneNumber' => 'required|numeric|digits:10',
        //     'gender' => 'required|string|max:50',
        //     'passWord' => 'required|string|max:250',
        // ]);

        $user = User::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'user_name' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phonenumber,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $users = User::all();
        return $users;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'user_name' => $request->username,
                'phone_number' => $request->phonenumber,
                'gender' => $request->gender,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User updated Successfully',
                'data' => $user
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