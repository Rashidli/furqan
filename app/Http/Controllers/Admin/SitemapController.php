<?php

namespace App\Http\Controllers\Admin;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Single;

class SitemapController extends Controller
{
    public function sitemap()
    {

        $singles = Single::with('translations')->get();
        $blogs = Blog::with('translations')->get();
        $products = Product::with('translations')->get();
        $categories = Category::active()->get();
        return response()->view('front.sitemap', compact('singles','blogs','products','categories'))
            ->header('Content-type','text/xml');

    }
}
