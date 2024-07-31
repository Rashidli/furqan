<?php

use App\Http\Controllers\Admin\{AboutController,
    AuthController,
    BlogController,
    CampaignController,
    CategoryController,
    ContactController,
    ContactItemController,
    CreditController,
    FilterController,
    ImageController,
    MainAboutController,
    MainController,
    ModuleController,
    OfficeController,
    OptionController,
    PageController,
    PermissionController,
    ProductController,
    RoleController,
    ServiceController,
    SingleController,
    SocialController,
    SubscriptionController,
    TestimonialController,
    UserController,
    VacancyController,
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

Route::get('/storage',function (){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
});

Route::get('/migrate',function (){
    \Illuminate\Support\Facades\Artisan::call('migrate');
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
    Route::resource('main_abouts',MainAboutController::class);
    Route::resource('services',ServiceController::class);
    Route::resource('services',ServiceController::class);
    Route::resource('subscriptions',SubscriptionController::class);
    Route::resource('vacancies',VacancyController::class);
    Route::resource('products.modules',ModuleController::class);
    Route::resource('filters',FilterController::class);
    Route::resource('filters.options',OptionController::class);
    Route::get('/delete-slider-image/{id}', [ProductController::class, 'deleteImage'])->name('delete-slider-image');

    Route::get('/categories/{id}/children', [CategoryController::class, 'getChildren']);

});
