<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FavoritesController extends Controller
{

    public function index()
    {
        $customer = Auth::guard('api')->user();
        $favorites = $customer->favorites()->with('favoritedBy')->get();
        return response()->json([
            'status' => true,
            'favorites' => ProductResource::collection($favorites),
        ]);
    }

    public function add(Request $request, Product $product)
    {
        $customer = Auth::guard('api')->user();
        if (!$customer->favorites()->where('product_id', $product->id)->exists()) {
            $customer->favorites()->attach($product->id);
        }
        return response()->json([
            'status' => true,
            'favorites' => ProductResource::collection($customer->favorites()->with('favoritedBy')->get())
        ]);
    }

    public function addAll(Request $request)
    {

        $customer = Auth::guard('api')->user();

        foreach ($request->product_ids as $productId) {
            if (!$customer->favorites()->where('product_id', $productId)->exists()) {
                $customer->favorites()->attach($productId);
            }
        }

        return response()->json([
            'status' => true,
            'favorites' => ProductResource::collection($customer->favorites()->with('favoritedBy')->get())
        ]);

    }

    public function remove(Request $request, Product $product)
    {
        $customer = Auth::guard('api')->user();
        $customer->favorites()->detach($product->id);
        return response()->json([
            'status' => true,
            'favorites' => ProductResource::collection($customer->favorites()->with('favoritedBy')->get())
        ]);
    }

}
