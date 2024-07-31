<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\FilterResource;
use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FilterController extends Controller
{
    public function index()
    {
        $filters = Filter::with('options')->active()->get();
        return response()->json([
            'status' => true,
            'filters' => FilterResource::collection($filters)
        ], Response::HTTP_OK);
    }
}
