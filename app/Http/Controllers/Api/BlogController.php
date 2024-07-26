<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Response;


class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::active()->orderBy('id','asc')->get();
        return response()->json([
            'status' => true,
            'blogs' => BlogResource::collection($blogs)
        ], Response::HTTP_OK);
    }

    public function show($slug)
    {

        $blog = Blog::whereHas('translations', function ($q)use ($slug){
            $q->where('slug', $slug);
        })->get();
        return response()->json([
           'status' => true,
            'blog' => BlogResource::collection($blog)
        ], Response::HTTP_OK);

    }

}
