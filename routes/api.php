<?php


use App\Http\Controllers\Api\{
    CreditController,
    OfficeController,
    TestimonialController,
    BlogController,
    CustomerAuthController
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware'=>'setLocale'], function (){

    Route::post("register", [CustomerAuthController::class, "register"]);
    Route::post("login", [CustomerAuthController::class, "login"]);

    Route::group(["middleware" => ["auth:api"]], function(){

        Route::get("profile", [CustomerAuthController::class, "profile"]);
        Route::get("refresh", [CustomerAuthController::class, "refreshToken"]);
        Route::get("logout", [CustomerAuthController::class, "logout"]);
        Route::post("update", [CustomerAuthController::class, "update"]);

    });

    Route::get('blogs', [BlogController::class, 'index']);
    Route::get('blog/{slug}', [BlogController::class, 'show']);

    Route::get('testimonials', [TestimonialController::class,'index']);
    Route::get('credits', [CreditController::class,'index']);
    Route::get('branches', [OfficeController::class,'index']);

});
