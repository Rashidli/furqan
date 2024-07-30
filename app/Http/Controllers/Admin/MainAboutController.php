<?php

namespace App\Http\Controllers\Admin;

use App\Models\MainAbout;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class MainAboutController extends Controller
{

    public function __construct(protected ImageUploadService $imageUploadService)
    {

    }
    public function index()
    {

        $main_abouts = MainAbout::paginate(10);
        return view('admin.main_abouts.index', compact('main_abouts'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.main_abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'az_description'=>'required',
            'en_description'=>'required',
            'ru_description'=>'required',
            'image'=>'required',
        ]);

        if($request->hasFile('image')){
            $filename = $this->imageUploadService->upload($request->file('image'));
        }

        MainAbout::create([
            'image'=>  $filename,
            'az'=>[
                'description'=>$request->az_description,
            ],
            'en'=>[
                'description'=>$request->en_description,
            ],
            'ru'=>[
                'description'=>$request->ru_description,
            ]
        ]);

        return redirect()->route('main_abouts.index')->with('message','MainAbout added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(MainAbout $main_about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MainAbout $main_about)
    {

        return view('admin.main_abouts.edit', compact('main_about'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, MainAbout $main_about)
    {
        $request->validate([
            'az_description'=>'required',
            'en_description'=>'required',
            'ru_description'=>'required',
        ]);

        if($request->hasFile('image')){
            $main_about->image = $this->imageUploadService->upload($request->file('image'));
        }

        $main_about->update( [

            'is_active'=> $request->is_active,
            'az'=>[
                'description'=>$request->az_description,
            ],
            'en'=>[
                'description'=>$request->en_description,
            ],
            'ru'=>[
                'description'=>$request->ru_description,
            ]

        ]);

        return redirect()->back()->with('message','MainAbout updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainAbout $main_about)
    {

        $main_about->delete();

        return redirect()->route('main_abouts.index')->with('message', 'MainAbout deleted successfully');

    }
}
