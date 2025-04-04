<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;

    protected $listeners = [
        'itemCreated' => '$refresh',
        'itemUpdated' => '$refresh',
        'modelDeleted' => '$refresh',
    ];

    public function getCategory(?int $id): ?string
    {
        return Category::find($id, ['name'])?->name;
    }

    public function getBrand(?int $id): ?string
    {
        return Brand::find($id, ['name'])?->name;
    }

    public function render()
    {
        return view('livewire.items', [
            'items' => Item::paginate(5),
        ]);
    }
}
