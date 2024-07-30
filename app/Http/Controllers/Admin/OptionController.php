<?php

namespace App\Http\Controllers\Admin;

use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OptionController extends Controller
{
    public function index($filterId)
    {
        $filter = Filter::findOrFail($filterId);
        $options = $filter->options()->paginate(10);

        return view('admin.options.index', compact('filter', 'options'));
    }

    public function create($filterId)
    {
        $filter = Filter::findOrFail($filterId);
        return view('admin.options.create', compact('filter'));
    }

    public function store(Request $request, $filterId)
    {
        $filter = Filter::findOrFail($filterId);

        $request->validate([
            'az_title' => 'nullable',
            'en_title' => 'nullable',
            'ru_title' => 'nullable',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = Str::uuid() . "." . $file->extension();
            $file->storeAs('public/',$filename);
        }

        $filter->options()->create([
            'image'=>  $filename ?? null,
            'az' => ['title' => $request->az_title],
            'en' => ['title' => $request->en_title],
            'ru' => ['title' => $request->ru_title]
        ]);

        return redirect()->route('filters.options.index', $filterId)->with('message', 'Option added successfully');
    }

    public function show($filterId, $optionId)
    {
        $filter = Filter::findOrFail($filterId);
        $option = $filter->options()->findOrFail($optionId);

        return view('admin.options.show', compact('filter', 'option'));
    }

    public function edit($filterId, $optionId)
    {
        $filter = Filter::findOrFail($filterId);
        $option = $filter->options()->findOrFail($optionId);

        return view('admin.options.edit', compact('filter', 'option'));
    }

    public function update(Request $request, $filterId, $optionId)
    {
        $filter = Filter::findOrFail($filterId);
        $option = $filter->options()->findOrFail($optionId);

        $request->validate([
            'az_title' => 'nullable',
            'en_title' => 'nullable',
            'ru_title' => 'nullable',
        ]);

        if($request->hasFile('image')){

            $file = $request->file('image');
            $filename = Str::uuid() . "." . $file->extension();
            $file->storeAs('public/',$filename);
            $option->image = $filename;
        }

        $option->update([
            'az' => ['title' => $request->az_title],
            'en' => ['title' => $request->en_title],
            'ru' => ['title' => $request->ru_title]
        ]);

        return redirect()->route('filters.options.index', $filterId)->with('message', 'Option updated successfully');
    }

    public function destroy($filterId, $optionId)
    {
        $filter = Filter::findOrFail($filterId);
        $option = $filter->options()->findOrFail($optionId);

        $option->delete();

        return redirect()->route('filters.options.index', $filterId)->with('message', 'Option deleted successfully');
    }
}
