<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CustomerAuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $rules = [
            "name" => "required",
            "surname" => "required",
            "phone" => "required",
            "email" => "required|email|unique:customers,email",
            "password" => "required|confirmed"
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

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

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (!$token = Auth::guard('api')->attempt($request->only('email', 'password'))) {
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials"
            ], Response::HTTP_UNAUTHORIZED);
        }
        $customer = Auth::guard('api')->user();
        return response()->json([
            "status" => true,
            "message" => "User logged in successfully",
            "token" => $token,
            "user" => new CustomerResource($customer)
        ], Response::HTTP_OK);
    }

    public function profile(): JsonResponse
    {
        $userdata = Auth::guard('api')->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "user" => new CustomerResource($userdata)
        ], Response::HTTP_OK);
    }

    public function refreshToken(): JsonResponse
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

    public function update(Request $request): JsonResponse
    {
        $user = Auth::guard('api')->user();

//        $request->validate([
//            "name" => "sometimes|required",
//            "surname" => "sometimes|required",
//            "phone" => "sometimes|required",
//            "email" => "sometimes|required|email|unique:customers,email," . $user->id,
//            "password" => "sometimes|confirmed"
//        ]);

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

    public function updatePassword(Request $request): JsonResponse
    {
        $user = Auth::guard('api')->user();

        $request->validate([
            "current_password" => "required",
            "new_password" => "required|confirmed"
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                "status" => false,
                "message" => "Current password does not match"
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            "status" => true,
            "message" => "Password updated successfully"
        ], Response::HTTP_OK);
    }


}
