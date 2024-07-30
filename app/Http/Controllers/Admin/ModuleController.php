<?php

namespace App\Http\Controllers\Admin;

use App\Models\Module;
use App\Models\Product;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Product $product)
    {
        $modules = $product->modules()->paginate(10);
        return view('admin.modules.index', compact('modules', 'product'));
    }

    public function create(Product $product)
    {
        return view('admin.modules.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'az_title' => 'required|string|max:255',
            'en_title' => 'required|string|max:255',
            'ru_title' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product->modules()->create([
            'price' => $request->price,
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

        return redirect()->route('products.modules.index', $product->id)
            ->with('message', 'Module added successfully');
    }

    public function edit(Product $product, Module $module)
    {
        return view('admin.modules.edit', compact('product', 'module'));
    }

    public function update(Request $request, Product $product, Module $module)
    {
        $request->validate([
            'az_title' => 'required|string|max:255',
            'en_title' => 'required|string|max:255',
            'ru_title' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $module->update([
            'price' => $request->price,
            'is_active' => $request->is_active,
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

        return redirect()->route('products.modules.index', $product->id)
            ->with('message', 'Module updated successfully');
    }

    public function destroy(Product $product, Module $module)
    {
        $module->delete();

        return redirect()->route('products.modules.index', $product->id)
            ->with('message', 'Module deleted successfully');
    }
}
