<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;


class CustomerAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "name" => "required",
            "surname" => "required",
            "phone" => "required",
            "email" => "required|email|unique:customers,email",
            "password" => "required|confirmed"
        ]);

        Customer::create([
            "name" => $request->name,
            "email" => $request->email,
            "surname" => $request->surname,
            "phone" => $request->phone,
            "password" => Hash::make($request->password)
        ]);

        return response()->json([
            "status" => true,
            "message" => "User registered successfully"
        ], Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (!$token = Auth::guard('api')->attempt($request->only('email', 'password'))) {
            return response()->json([
                "status" => false,
                "message" => "Invalid details"
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            "status" => true,
            "message" => "User logged in successfully",
            "token" => $token
        ], Response::HTTP_OK);
    }

    public function profile()
    {
        $userdata = Auth::guard('api')->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userdata
        ], Response::HTTP_OK);
    }

    public function refreshToken()
    {
        $newToken = Auth::guard('api')->refresh();

        return response()->json([
            "status" => true,
            "message" => "New access token",
            "token" => $newToken
        ], Response::HTTP_OK);
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ],Response::HTTP_OK);
    }

    public function update(Request $request)
    {
        $user = Auth::guard('api')->user();

        $request->validate([
            "name" => "sometimes|required",
            "surname" => "sometimes|required",
            "phone" => "sometimes|required",
            "email" => "sometimes|required|email|unique:customers,email," . $user->id,
            "password" => "sometimes|confirmed"
        ]);

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('surname')) {
            $user->surname = $request->surname;
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            "status" => true,
            "message" => "User updated successfully",
            "data" => $user
        ], Response::HTTP_OK);
    }
}
