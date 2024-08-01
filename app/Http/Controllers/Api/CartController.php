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
        try {
            $customer = Auth::guard('api')->user();
            $cart = $customer->cart;
            if ($cart) {
                return response()->json([
                    'status' => true,
                    'cart' => new CartResource($cart->load('items.product'))
                ]);
            } else {
                $cart = Cart::create(['customer_id' => $customer->id]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
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
        $quantityToAdd = $request->input('quantity', 1);

        if ($cartItem) {
            $cartItem->quantity += $quantityToAdd;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantityToAdd,
            ]);
        }

        $cart->total_price += $quantityToAdd * $product->price;
        $cart->save();

        return response()->json([
            'status' => true,
            'cart' => new CartResource($cart->load('items.product'))
        ]);
    }

    public function remove(Request $request, Product $product)
    {
        $customer = Auth::guard('api')->user();
        $cart = $customer->cart;

        if ($cart) {
            $cartItem = $cart->items()->where('product_id', $product->id)->first();
            if ($cartItem) {
                $cart->total_price -= $cartItem->quantity * $product->price;
                $cartItem->delete();
                $cart->save();
            }
        }

        return response()->json([
            'status' => true,
            'cart' => new CartResource($cart->load('items.product'))
        ]);
    }
}
