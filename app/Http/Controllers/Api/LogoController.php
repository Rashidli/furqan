<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\LogoResource;
use App\Models\Image;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function index()
    {
        $logo = Image::all();

        return response()->json([
            'status' => true,
            'logo' => LogoResource::collection($logo)
        ]);
    }
}
