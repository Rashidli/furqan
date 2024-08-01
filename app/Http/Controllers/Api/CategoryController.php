<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::query()->with('children')->whereNull('parent_id')->get();
        return response()->json([
            'status' => true,
            'categories' => CategoryResource::collection($categories)
        ],Response::HTTP_OK);

    }
}
