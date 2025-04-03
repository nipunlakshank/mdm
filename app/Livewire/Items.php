<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use Livewire\Component;

class Items extends Component
{
    public function getCategory(int $id)
    {
        return Category::find($id, ['name'])->name;
    }

    public function getBrand(int $id)
    {
        return Brand::find($id, ['name'])->name;
    }

    public function render()
    {
        return view('livewire.items', [
            'items' => Item::query()->paginate(5)
        ]);
    }
}
