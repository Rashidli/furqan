<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OfficeRequest;
use App\Models\Office;

class OfficeController extends Controller
{
    public function index()
    {

        $offices = Office::paginate(10);
        return view('admin.offices.index', compact('offices'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.offices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfficeRequest $request)
    {

        Office::create([
            'map'=>  $request->map,
            'az'=>[
                'title'=>$request->az_title,
                'value'=>$request->az_value,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'value'=>$request->en_value,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'value'=>$request->ru_value,
            ]
        ]);

        return redirect()->route('offices.index')->with('message','Office added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {

        return view('admin.offices.edit', compact('office'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(OfficeRequest $request, Office $office)
    {

        $office->update( [
            'map'=>  $request->map,
            'is_active'=> $request->is_active,
            'az'=>[
                'title'=>$request->az_title,
                'value'=>$request->az_value,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'value'=>$request->en_value,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'value'=>$request->ru_value,
            ]

        ]);

        return redirect()->back()->with('message','Office updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {

        $office->delete();

        return redirect()->route('offices.index')->with('message', 'Office deleted successfully');

    }
}
