<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\CartItemResource;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('api')->user();
        $cart = $customer->cart;
        if ($cart) {
            $cartItems = $cart->items()->with('product')->get();
            return response()->json([
                'status' => true,
                'cart' => new CartResource($cart)
            ]);
        }
        return response()->json([
            'status' => true,
            'cart' => new CartResource($cart)
        ]);
    }

    public function add(Request $request, Product $product)
    {
        $customer = Auth::guard('api')->user();
        $cart = $customer->cart ?: Cart::create(['customer_id' => $customer->id]);

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return response()->json([
            'status' => true,
            'cart' => new CartResource($cart)
        ]);
    }

    public function remove(Request $request, Product $product)
    {
        $customer = Auth::guard('api')->user();
        $cart = $customer->cart;

        if ($cart) {
            $cartItem = $cart->items()->where('product_id', $product->id)->first();
            if ($cartItem) {
                $cartItem->delete();
            }
        }

        return response()->json([
            'status' => true,
            'cart' => new CartResource($cart)
        ]);
    }
}
