<?php

namespace App\Livewire\Modals;

use App\Models\Brand;
use Livewire\Component;

class CreateBrand extends Component
{
    public ?string $name = '';
    public ?string $code = '';
    public ?string $status = '';

    public function updateOrSave()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'status' => 'required|in:1,0',
        ]);

        Brand::create([
            'name' => $this->name,
            'code' => $this->code,
            'is_active' => $this->status === '1',
        ]);

        $this->dispatch('closeBrandModal');
    }

    public function render()
    {
        return view('livewire.modals.create-brand');
    }
}
