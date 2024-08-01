<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
class AddressController extends Controller
{
    public function index(): JsonResponse
    {
        $customer = Auth::guard('api')->user();
        $address = $customer->address;

        if (!$address) {
            return response()->json(['status' => false, 'message' => 'Address not found'], 404);
        }

        return response()->json([
            'status' => true,
            'address' => new AddressResource($address)
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'email' => 'nullable',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $customer = Auth::guard('api')->user();

        $address = $customer->address()->create([
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'status' => true,
            'address' => new AddressResource($address)
        ], 201);
    }

    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $customer = Auth::guard('api')->user();
        $address = $customer->address;

        if (!$address) {
            return response()->json(['status' => false, 'message' => 'Address not found'], 404);
        }

        $address->update([
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'status' => true,
            'address' => new AddressResource($address)
        ]);
    }

}
