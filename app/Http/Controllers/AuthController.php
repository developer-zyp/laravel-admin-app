<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Responses\ApiResponse;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        //create user
        $user = User::create([
            'name' => $attr['name'],
            'email' => $attr['email'],
            'password' => bcrypt($attr['password']),
        ]);

        $data['token'] = $user->createToken($request->email)->plainTextToken;
        $data['user'] = $user;

        $response = new ApiResponse(true, 'User is created successfully.', $data);
        return response()->json($response);
    }


    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            $response = new ApiResponse(false, 'Invalid credentials');
            return response()->json($response);
        }

        $data['token'] = auth()->user()->createToken($request->email)->plainTextToken;
        $data['user'] = auth()->user();

        $response = new ApiResponse(true, 'User is logged in successfully.', $data);
        return response()->json($response);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();

        $response = new ApiResponse(true, 'User is logged out successfully.');

        return response()->json($response, 200);
    }

    public function loginuser()
    {
        $response = new ApiResponse(true, 'User is logged out successfully.', auth()->user());
        return response()->json($response, 200);
    }

    public function updateUser(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string',
        ]);

        $imageUrl = $this->saveImage($request->image, 'profiles');

        auth()->user()->update([
            'name' => $attr['name'],
            'iamge' => $imageUrl,
        ]);

        $response = new ApiResponse(true, 'User updated successfully.', auth()->user());
        return response()->json($response, 200);

    }

}
