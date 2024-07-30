<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProductController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService)
    {
        $this->middleware('permission:list-products|create-products|edit-products|delete-products', ['only' => ['index','show']]);
        $this->middleware('permission:create-products', ['only' => ['create','store']]);
        $this->middleware('permission:edit-products', ['only' => ['edit']]);
        $this->middleware('permission:delete-products', ['only' => ['destroy']]);
    }
    function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = Product::whereTranslation('title', $title)->count();

        if ($count > 0) {
            $slug .= '-' . $count;
        }

        return $slug;
    }
    public function index(Request $request)
    {

        $limit = $request->input('limit', 10);
        $categoryId = $request->input('category_id');
        $name = $request->input('name');

        $query = Product::query();

        if ($categoryId) {
            $query->where(function($q) use ($categoryId) {
                $q->where('category_id', $categoryId)
                    ->orWhere('parent_category_id', $categoryId);
            });
        }

        if ($name) {
            $query->whereHas('translations', function($q) use ($name) {
                $q->where('title', 'like', '%' . $name . '%');
            });
        }

        $products = $query->orderBy('id','desc')->paginate($limit)->withQueryString();

        $categories = Category::active()->get();
        return view('admin.products.index', compact('products','categories'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $categories = Category::all();
        $filters = Filter::with('options')->active()->get();
        return view('admin.products.create', compact('categories','filters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([

        ]);

        DB::beginTransaction();
        try {
            if($request->hasFile('image')){
                $filename = $this->imageUploadService->upload($request->file('image'));
            }

            $product = Product::create([
                'category_id' => $request->category_id,
                'price' => $request->price,
                'discounted_price' => $request->discounted_price,
                'discount_percent' => $request->discount_percent,
                'is_popular' => isset($request->is_popular),
                'is_stock' => isset($request->is_stock),
                'image'=>  $filename,
                'az'=>[
                    'title'=>$request->az_title,
                    'description'=>$request->az_description,
                    'slug'=>$this->generateUniqueSlug($request->az_title),
                ],
                'en'=>[
                    'title'=>$request->en_title,
                    'description'=>$request->en_description,
                    'slug'=>$this->generateUniqueSlug($request->en_title),
                ],
                'ru'=>[
                    'title'=>$request->ru_title,
                    'description'=>$request->ru_description,
                    'slug'=>$this->generateUniqueSlug($request->ru_title),
                ]
            ]);

            if($request->hasFile('product_images')) {
                foreach ($request->file('product_images') as $product_image) {
                    if ($product_image->isValid()) {
                        $filename = $this->imageUploadService->upload($product_image);
                        ProductImage::create([
                            'image' => $filename,
                            'product_id' => $product->id
                        ]);
                    }
                }
            }

            foreach ($request->option_ids as $option_id){
                if($option_id !== null){
                    DB::table('option_product')->insert([
                        'option_id' => $option_id,
                        'product_id' => $product->id
                    ]);
                }
            }

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

        return redirect()->route('products.index')->with('message','Product added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $filters = Filter::with('options')->active()->get();
        return view('admin.products.edit', compact('product','categories','filters'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Product $product)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_description'=>'required',
            'en_description'=>'required',
            'ru_description'=>'required',
            'price'=>'nullable',
            'discounted_price'=>'nullable',
            'category_id'=>'required',
        ]);

        DB::beginTransaction();
        try {
            if($request->hasFile('image')){
                $filename = $this->imageUploadService->upload($request->file('image'));
                $product->image = $filename;
            }

            $product->update( [
                'is_active'=> $request->is_active,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'discounted_price' => $request->discounted_price,
                'is_stock' => isset($request->is_stock),
                'is_popular' => isset($request->is_popular),
                'discount_percent' => $request->discount_percent,
                'az'=>[
                    'title'=>$request->az_title,
                    'description'=>$request->az_description,
                    'slug'=>$this->generateUniqueSlug($request->az_title),
                ],
                'en'=>[
                    'title'=>$request->en_title,
                    'description'=>$request->en_description,
                    'slug'=>$this->generateUniqueSlug($request->en_title),
                ],
                'ru'=>[
                    'title'=>$request->ru_title,
                    'description'=>$request->ru_description,
                    'slug'=>$this->generateUniqueSlug($request->ru_title),
                ]

            ]);

            if($request->hasFile('product_images')) {

                foreach ($request->file('product_images') as $product_image) {

                    if ($product_image->isValid()) {
                        $filename = $this->imageUploadService->upload($product_image);
                        ProductImage::create([
                            'image' => $filename,
                            'product_id' => $product->id
                        ]);
                    }
                }
            }

            DB::table('option_product')->where('product_id',$product->id)->delete();

            foreach ($request->option_ids as $option_id){
                if($option_id !== null){
                    DB::table('option_product')->insert([
                        'option_id' => $option_id,
                        'product_id' => $product->id
                    ]);
                }
            };
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

        return redirect()->route('products.index')->with('message','Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        $product->delete();
        return redirect()->route('products.index')->with('message', 'Product deleted successfully');

    }

    public function deleteImage($id)
    {

        DB::table('product_images')->where('id', '=', $id)->delete();
        return redirect()->back()->with('message','Şəkil silindi');

    }


}
