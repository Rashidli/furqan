<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function popularProducts(Request $request)
    {

        $query = Product::query();

        if($request->category_id){
            $query->where('parent_category_id', $request->category_id);
        }

        $popularProducts = $query->active()->where('is_popular',true)->get();
        return response()->json([
            'status' => true,
            'popular_products' => ProductResource::collection($popularProducts)
        ], Response::HTTP_OK);

    }

    public function allProducts(Request $request)
    {

        $query = Product::query();

        $parent_category_id = $request->parent_category_id;
        $category_id = $request->category_id;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $sort = $request->sort;

        if($category_id){
            $query->where('category_id', $category_id);
        }

        if($parent_category_id){
            $query->where('parent_category_id', $parent_category_id);
        }

        if($min_price && $max_price){
            $query->whereBetween('price', [$min_price,$max_price]);
        }

        $query->when($sort, function ($query, $sort) {
            switch ($sort) {
                case 'price_asc':
                    return $query->orderBy('price', 'asc');
                case 'price_desc':
                    return $query->orderBy('price', 'desc');
                case 'new_products':
                    return $query->where('is_new', true);
                case 'discounted_products':
                    return $query->whereNotNull('discounted_price');
            }
        });

        $popularProducts = $query->with(['modules','options'])->active()->get();
        return response()->json([
            'status' => true,
            'products' => ProductResource::collection($popularProducts)
        ], Response::HTTP_OK);

    }
}
