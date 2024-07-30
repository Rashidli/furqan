<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\Controller;
use App\Http\Resources\MainAboutResponse;
use App\Models\MainAbout;

class MainAboutController extends Controller
{

    public function index()
    {
        $main_abouts = MainAbout::active()->get();
        return response()->json([
            'status' => true,
            'main_about' => MainAboutResponse::collection($main_abouts)
        ]);
    }

}
