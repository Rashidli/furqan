<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService)
    {

    }

    public function index()
    {

        $services = Service::paginate(10);
        return view('admin.services.index', compact('services'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.services.create');
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
            $filename = $this->imageUploadService->upload($request->file('image'));
        }

        Service::create([
            'image'=>  $filename,
            'az'=>[
                'title'=>$request->az_title,
                'description'=>$request->az_description,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'description'=>$request->en_description,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'description'=>$request->ru_description,
            ]
        ]);

        return redirect()->route('services.index')->with('message','Service added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {

        return view('admin.services.edit', compact('service'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Service $service)
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
            $service->image = $this->imageUploadService->upload($request->file('image'));
        }

        $service->update( [

            'is_active'=> $request->is_active,
            'az'=>[
                'title'=>$request->az_title,
                'description'=>$request->az_description,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'description'=>$request->en_description,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'description'=>$request->ru_description,
            ]

        ]);

        return redirect()->back()->with('message','Service updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {

        $service->delete();
        return redirect()->route('services.index')->with('message', 'Service deleted successfully');

    }
}
