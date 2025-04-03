<?php

namespace App\Livewire\Modals;

use App\Models\Brand;
use Livewire\Attributes\On;
use Livewire\Component;

class EditBrand extends Component
{
    public ?Brand $brand;
    public int $id;
    public ?string $name = '';
    public ?string $code = '';
    public ?string $status = '';

    #[On('editBrand')]
    public function editBrand(int $brandId)
    {
        $this->brand = Brand::findOrFail($brandId);
        $this->id = $this->brand->id;
        $this->name = $this->brand->name;
        $this->code = $this->brand->code;
        $this->status = $this->brand->is_active ? '1' : '0';
        $this->dispatch('showModal')->self();
    }

    public function mount()
    {
        $this->brand = null;
    }

    public function render()
    {
        return view('livewire.modals.edit-brand');
    }
}
