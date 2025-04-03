<?php

namespace App\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Brands extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.brands', [
            'brands' => Brand::paginate(5),
        ]);
    }
}
