<?php

namespace App\Livewire\Modals;

use App\Models\Brand;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteBrand extends Component
{
    public ?Brand $brand;

    #[On('deleteBrand')]
    public function deleteBrand(int $brandId)
    {
        $this->brand = Brand::findOrFail($brandId);
    }

    public function delete()
    {
        $this->brand->delete();

        $this->brand = null;

        $this->dispatch('brandDeleted');
        $this->dispatch('closeBrandModal');
    }

    public function render()
    {
        return view('livewire.modals.delete-brand');
    }
}
