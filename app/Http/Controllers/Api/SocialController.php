<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\SocialResource;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {

        $socials = Social::active()->orderBy('id','asc')->get();

        return response()->json([
            'status' => true,
            'socials' => SocialResource::collection($socials)
        ]);

    }
}
