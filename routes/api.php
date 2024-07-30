<?php


use App\Http\Controllers\Api\{ContactItemController,
    ContactController,
    CreditController,
    LogoController,
    MainAboutController,
    OfficeController,
    ServiceController,
    SocialController,
    SubscriptionController,
    TestimonialController,
    BlogController,
    CustomerAuthController,
    HeroController,
    VacancyController};

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
        Route::post("updatePassword", [CustomerAuthController::class, "updatePassword"]);

    });

    Route::get('blogs', [BlogController::class, 'index']);
    Route::get('blog/{slug}', [BlogController::class, 'show']);

    Route::get('vacancies', [VacancyController::class, 'index']);
    Route::get('vacancy/{slug}', [VacancyController::class, 'show']);

    Route::get('testimonials', [TestimonialController::class,'index']);
    Route::get('credits', [CreditController::class,'index']);
    Route::get('branches', [OfficeController::class,'index']);
    Route::get('hero', [HeroController::class,'index']);
    Route::get('contact_items', [ContactItemController::class,'index']);
    Route::get('contact_footer', [ContactItemController::class,'footer_contact']);
    Route::get('services', [ServiceController::class,'index']);
    Route::get('main_about', [MainAboutController::class,'index']);
    Route::get('logo', [LogoController::class,'index']);
    Route::get('socials', [SocialController::class,'index']);

    Route::post('contact_post', [ContactController::class,'contact_post']);
    Route::post('subscribe', [SubscriptionController::class,'subscribe']);

});
