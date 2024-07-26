<?php

namespace App\Http\Controllers\Admin;

use App\Models\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-mains|create-mains|edit-mains|delete-mains', ['only' => ['index','show']]);
        $this->middleware('permission:create-mains', ['only' => ['create','store']]);
        $this->middleware('permission:edit-mains', ['only' => ['edit']]);
        $this->middleware('permission:delete-mains', ['only' => ['destroy']]);
    }
    public function index()
    {

        $mains = Main::paginate(10);
        return view('admin.mains.index', compact('mains'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.mains.create');
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
            $filename = Str::uuid() . "." . $file->extension();
            $file->storeAs('public/',$filename);
        }

        Main::create([
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

        return redirect()->route('mains.index')->with('message','Main added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Main $main)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Main $main)
    {

        return view('admin.mains.edit', compact('main'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Main $main)
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
            $filename = Str::uuid() . "." . $file->extension();
            $file->storeAs('public/',$filename);
            $main->image = $filename;
        }

        $main->update( [

            'is_active'=> $request->is_active,
            'color'=>  $request->color,
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

        return redirect()->back()->with('message','Main updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Main $main)
    {

        $main->delete();

        return redirect()->route('mains.index')->with('message', 'Main deleted successfully');

    }
}
