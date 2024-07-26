<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\FaqResource;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestimonialController extends Controller
{

    public function index()
    {
        $faqs = Testimonial::active()->orderBy('id','asc')->get();
        return response()->json([
            'status'=> true,
            'testimonials' => TestimonialResource::collection($faqs)
        ], Response::HTTP_OK);
    }

}
