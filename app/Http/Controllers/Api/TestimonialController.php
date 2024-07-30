<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{

    public function index(): JsonResponse
    {
        $faqs = Testimonial::active()->orderBy('id','asc')->get();
        return response()->json([
            'status'=> true,
            'testimonials' => TestimonialResource::collection($faqs)
        ], Response::HTTP_OK);
    }

}
