<?php

namespace App\Http\Controllers\Admin;


use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list-blogs|create-blogs|edit-blogs|delete-blogs', ['only' => ['index','show']]);
        $this->middleware('permission:create-blogs', ['only' => ['create','store']]);
        $this->middleware('permission:edit-blogs', ['only' => ['edit']]);
        $this->middleware('permission:delete-blogs', ['only' => ['destroy']]);
    }
    function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = Blog::whereTranslation('title', $title)->count();

        if ($count > 0) {
            $slug .= '-' . $count;
        }

        return $slug;
    }

    public function index()
    {

        $blogs = Blog::paginate(10);
        return view('admin.blogs.index', compact('blogs'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_description'=>'required',
            'en_description'=>'required',
            'ru_description'=>'required',
            'image'=>'required',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $manager = new ImageManager(new Driver());

            $image = $manager->read($file);
            $image = $image->toWebp(60);

            $filename = Str::uuid()  . '.webp';
            Storage::put('public/' . $filename, (string) $image);
        }

        Blog::create([
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

        return redirect()->route('blogs.index')->with('message','Blog added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {

        return view('admin.blogs.edit', compact('blog'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_description'=>'required',
            'en_description'=>'required',
            'ru_description'=>'required',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $manager = new ImageManager(new Driver());

            $image = $manager->read($file);
            $image = $image->toWebp(60);

            $filename = Str::uuid()  . '.webp';
            Storage::put('public/' . $filename, (string) $image);
            $blog->image = $filename;
        }

        $blog->update( [

            'is_active'=> $request->is_active,
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

        return redirect()->back()->with('message','Blog updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {

        $blog->delete();

        return redirect()->route('blogs.index')->with('message', 'Blog deleted successfully');

    }
}
