<?php

namespace App\Http\Controllers\Admin;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class TestimonialController extends Controller
{

    public function index()
    {

        $testimonials = Testimonial::paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.testimonials.create');
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
            'az_position'=>'required',
            'en_position'=>'required',
            'ru_position'=>'required',
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
        }

        if($request->hasFile('bg_image')){
            $file = $request->file('bg_image');
            $manager = new ImageManager(new Driver());

            $image = $manager->read($file);
            $image = $image->toWebp(60);

            $filenameBg = Str::uuid()  . '.webp';
            Storage::put('public/' . $filenameBg, (string) $image);
        }

        Testimonial::create([
            'image'=>  $filename ?? null,
            'bg_image'=>  $filenameBg ?? null,
            'az'=>[
                'title'=>$request->az_title,
                'description'=>$request->az_description,
                'position'=>$request->az_position,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'description'=>$request->en_description,
                'position'=>$request->en_position,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'description'=>$request->ru_description,
                'position'=>$request->ru_position,
            ]
        ]);

        return redirect()->route('testimonials.index')->with('message','Testimonial added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {

        return view('admin.testimonials.edit', compact('testimonial'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_position'=>'required',
            'en_position'=>'required',
            'ru_position'=>'required',
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
            $testimonial->image = $filename;
        }

        if($request->hasFile('bg_image')){
            $file = $request->file('bg_image');
            $manager = new ImageManager(new Driver());

            $image = $manager->read($file);
            $image = $image->toWebp(60);

            $filename = Str::uuid()  . '.webp';
            Storage::put('public/' . $filename, (string) $image);
            $testimonial->bg_image = $filename;
        }

        $testimonial->update( [

            'is_active'=> $request->is_active,
            'az'=>[
                'title'=>$request->az_title,
                'description'=>$request->az_description,
                'position'=>$request->az_position,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'description'=>$request->en_description,
                'position'=>$request->en_position,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'description'=>$request->ru_description,
                'position'=>$request->ru_position,
            ]

        ]);

        return redirect()->back()->with('message','Testimonial updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {

        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('message', 'Testimonial deleted successfully');

    }
}
