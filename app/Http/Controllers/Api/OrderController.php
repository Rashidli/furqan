<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $customer = Auth::guard('api')->user();
            $orders = $customer->orders()->with('items.product')->withCount('items')->get();
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'status' => true,
            'orders' => OrderResource::collection($orders)
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = Auth::guard('api')->user();
            $cart = $customer->cart;

            if (!$cart || $cart->items()->count() == 0) {
                return response()->json(['error' => 'Cart is empty'], 400);
            }

            $order = Order::create([
                'customer_id' => $customer->id,
                'status' => OrderStatus::ACCEPTED,
                'total_price' => $cart->total_price
            ]);

            foreach ($cart->items as $cartItem) {
                $order->items()->create([
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                    'product_name' => $cartItem->product->title,
                ]);
            }

            $cart->items()->delete();
            $cart->delete();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => true,
            'order' => new OrderResource($order->load('items.product')->loadCount('items'))
        ]);
    }
}
