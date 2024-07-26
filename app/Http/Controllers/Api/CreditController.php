<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\CreditResource;
use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreditController extends Controller
{
    public function index()
    {
        $credits = Credit::active()->orderBy('id','asc')->get();
        return response()->json([
            'status' => true,
            'credits' => CreditResource::collection($credits)
        ], Response::HTTP_OK);
    }
}
