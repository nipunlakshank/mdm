<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    protected $listeners = [
        'categoryCreated' => '$refresh',
        'categoryUpdated' => '$refresh',
        'modelDeleted' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::paginate(5),
        ]);
    }
}
