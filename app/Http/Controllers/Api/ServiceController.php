<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('id','asc')->get();
        return response()->json([
            'status' => true,
            'services' => ServiceResource::collection($services)
        ]);
    }
}
