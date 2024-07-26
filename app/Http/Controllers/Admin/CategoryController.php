<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct(protected ImageUploadService $imageUploadService)
    {

    }

    public function getChildren($id) {

        $children = Category::where('parent_id', $id)->get();
        return response()->json($children);

    }

    function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = Category::whereTranslation('title', $title)->count();

        if ($count > 0) {
            $slug .= '-' . $count;
        }

        return $slug;
    }

    public function index()
    {
        $categories = Category::query()->whereNull('parent_id')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'en_title' => 'required|string|max:255',
            'ru_title' => 'required|string|max:255',
            'az_title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $filename = $this->imageUploadService->upload($request->file('image'));
        }

        Category::create([
           'parent_id'=>  $request->parent_id,
           'image'=>   $filename ?? null,
           'az'=>[
               'title'=>$request->az_title,
               'slug' => $this->generateUniqueSlug($request->az_title),
           ],
            'en'=>[
                'title'=>$request->en_title,
                'slug' => $this->generateUniqueSlug($request->en_title),
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'slug' => $this->generateUniqueSlug($request->ru_title),
            ]
        ]);

        return redirect()->route('categories.index')->with('message','Category updated successfully');
    }

    public function edit(Category $category)
    {
        $categories = Category::query()->whereNull('parent_id')->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'en_title' => 'required|string|max:255',
            'ru_title' => 'required|string|max:255',
            'az_title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);


        if ($request->hasFile('image')) {
            $filename = $this->imageUploadService->upload($request->file('image'));
            $category->image = $filename;
        }

        $category->update( [

            'parent_id'=> $request->parent_id,
            'az'=>[
                'title'=>$request->az_title,
            ],
            'en'=>[
                'title'=>$request->en_title,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
            ]

        ]);

        return redirect()->back()
            ->with('message', 'Category updated successfully');
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }

}
