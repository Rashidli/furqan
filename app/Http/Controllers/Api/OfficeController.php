<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\OfficeResource;
use App\Models\Office;
use Illuminate\Http\Response;

class OfficeController extends Controller
{

    public function index(): JsonResponse
    {
        $offices = Office::active()->orderBy('id', 'asc')->get();

        return response()->json([
            'status' => true,
            'branches' => OfficeResource::collection($offices)
        ], Response::HTTP_OK);
    }

}
