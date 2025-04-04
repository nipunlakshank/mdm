<?php

namespace App\Livewire\Modals;

use App\Models\Brand;
use Livewire\Attributes\On;
use Livewire\Component;

class EditBrand extends Component
{
    public ?Brand $brand;
    public ?int $brandId;
    public ?string $name = '';
    public ?string $code = '';
    public ?string $status = '';

    #[On('editBrand')]
    public function editBrand(int $brandId)
    {
        $this->brand = Brand::findOrFail($brandId);
        $this->brandId = $brandId;
        $this->name = $this->brand->name;
        $this->code = $this->brand->code;
        $this->status = $this->brand->is_active ? '1' : '0';
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'status' => 'required|in:1,0',
        ]);

        $this->brand->update([
            'name' => $this->name,
            'code' => $this->code,
            'is_active' => $this->status === '1',
        ]);

        $this->brand = null;
        $this->reset(['brandId', 'name', 'code', 'status']);

        $this->dispatch('brandUpdated');
        $this->dispatch('closeBrandModal');
    }

    public function render()
    {
        return view('livewire.modals.edit-brand');
    }
}
