<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\HeroResource;
use App\Models\Main;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

class HeroController extends Controller
{

    public function index(): JsonResponse
    {
        $hero = Main::active()->get();
        return response()->json([
            'status' => true,
            'hero' => HeroResource::collection($hero)
        ]);
    }

}
