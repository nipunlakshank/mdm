<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::paginate(5),
        ]);
    }
}
