<?php

use App\Http\Controllers\Admin\{AboutController,
    AuthController,
    BlogController,
    CampaignController,
    CategoryController,
    ContactController,
    ContactItemController,
    CreditController,
    ImageController,
    MainController,
    OfficeController,
    PageController,
    PermissionController,
    ProductController,
    RoleController,
    SingleController,
    SocialController,
    TestimonialController,
    UserController,
    WordController};

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/optimize_clear',function (){
   \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

Route::get('/', [PageController::class,'login'])->name('login');
Route::get('/register', [PageController::class,'register'])->name('register');
Route::post('/login_submit',[AuthController::class,'login_submit'])->name('login_submit');
Route::post('/register_submit',[AuthController::class,'register_submit'])->name('register_submit');

Route::group(['middleware' =>'auth'], function (){

    Route::get('/home', [PageController::class,'home'])->name('home');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);

    Route::resource('blogs',BlogController::class);
    Route::resource('mains',MainController::class);
    Route::resource('abouts',AboutController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('contacts',ContactController::class);
    Route::resource('images',ImageController::class);
    Route::resource('socials',SocialController::class);
    Route::resource('words',WordController::class);
    Route::resource('products',ProductController::class);
    Route::resource('campaigns',CampaignController::class);
    Route::resource('contact_items',ContactItemController::class);
    Route::resource('singles',SingleController::class);
    Route::resource('testimonials',TestimonialController::class);
    Route::resource('credits',CreditController::class);
    Route::resource('offices',OfficeController::class);
    Route::get('/delete-slider-image/{id}', [ProductController::class, 'deleteImage'])->name('delete-slider-image');

    Route::get('/categories/{id}/children', [CategoryController::class, 'getChildren']);

});
