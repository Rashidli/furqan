<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VacancyController extends Controller
{
    function generateUniqueSlug($title)
    {

        $slug = Str::slug($title);
        $count = Vacancy::whereTranslation('title', $title)->count();

        if ($count > 0) {
            $slug .= '-' . $count;
        }

        return $slug;

    }

    public function index()
    {

        $vacancies = Vacancy::paginate(10);
        return view('admin.vacancies.index', compact('vacancies'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.vacancies.create');
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
            'az_branch'=>'required',
            'en_branch'=>'required',
            'ru_branch'=>'required',
            'az_description'=>'required',
            'en_description'=>'required',
            'ru_description'=>'required',
            'az_requirement'=>'required',
            'en_requirement'=>'required',
            'ru_requirement'=>'required',
            'phone' => 'required',
            'email' => 'nullable'
        ]);

        Vacancy::create([
            'phone'=> $request->phone,
            'email'=> $request->email,
            'az'=>[
                'title'=>$request->az_title,
                'branch'=>$request->az_branch,
                'requirement'=>$request->az_requirement,
                'description'=>$request->az_description,
                'slug'=>$this->generateUniqueSlug($request->az_title),
            ],
            'en'=>[
                'title'=>$request->en_title,
                'branch'=>$request->en_branch,
                'requirement'=>$request->en_requirement,
                'description'=>$request->en_description,
                'slug'=>$this->generateUniqueSlug($request->en_title),
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'branch'=>$request->ru_branch,
                'requirement'=>$request->ru_requirement,
                'description'=>$request->ru_description,
                'slug'=>$this->generateUniqueSlug($request->ru_title),
            ],


        ]);

        return redirect()->route('vacancies.index')->with('message','Vacancy added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancy $vacancy)
    {

        return view('admin.vacancies.edit', compact('vacancy'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Vacancy $vacancy)
    {
        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
            'az_branch'=>'required',
            'en_branch'=>'required',
            'ru_branch'=>'required',
            'az_description'=>'required',
            'en_description'=>'required',
            'ru_description'=>'required',
            'az_requirement'=>'required',
            'en_requirement'=>'required',
            'ru_requirement'=>'required',
            'phone' => 'required',
            'email' => 'nullable'
        ]);

        $vacancy->update( [

            'is_active'=> $request->is_active,
            'phone'=> $request->phone,
            'email'=> $request->email,
            'az'=>[
                'title'=>$request->az_title,
                'branch'=>$request->az_branch,
                'requirement'=>$request->az_requirement,
                'description'=>$request->az_description,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'branch'=>$request->en_branch,
                'requirement'=>$request->en_requirement,
                'description'=>$request->en_description,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'branch'=>$request->ru_branch,
                'requirement'=>$request->ru_requirement,
                'description'=>$request->ru_description,
            ]

        ]);

        return redirect()->back()->with('message','Vacancy updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {

        $vacancy->delete();

        return redirect()->route('vacancies.index')->with('message', 'Vacancy deleted successfully');

    }
}
