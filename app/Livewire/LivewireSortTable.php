<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class LivewireSortTable extends Component
{
    public function updateCategoryOrder($categories)
    {
        foreach ($categories as $category) {
            Category::whereId($category['value'])->update(['row' => $category['order']]);
        }
    }

    public function render()
    {
        $categories = Category::with('parent')->orderBy('row')->get();
        return view('admin.livewire.livewire-sort-table', compact('categories'));
    }

}
