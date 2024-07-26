<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreditRequest;
use App\Models\Credit;

class CreditController extends Controller
{
    public function index()
    {

        $credits = Credit::paginate(10);
        return view('admin.credits.index', compact('credits'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.credits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreditRequest $request)
    {

        Credit::create([
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

        return redirect()->route('credits.index')->with('message','Credit added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Credit $credit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Credit $credit)
    {

        return view('admin.credits.edit', compact('credit'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(CreditRequest $request, Credit $credit)
    {

        $credit->update( [

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

        return redirect()->back()->with('message','Credit updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Credit $credit)
    {

        $credit->delete();
        return redirect()->route('credits.index')->with('message', 'Credit deleted successfully');

    }
}
