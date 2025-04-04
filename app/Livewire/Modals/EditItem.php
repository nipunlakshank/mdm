<?php

namespace App\Livewire\Modals;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class EditItem extends Component
{
    public ?Item $item;
    public Collection $categories;
    public Collection $brands;
    public ?int $itemId;
    public ?int $categoryId;
    public ?int $brandId;
    public ?string $attachment;
    public ?string $name = '';
    public ?string $code = '';
    public ?string $status;

    #[On('editItem')]
    public function editItem(int $itemId)
    {
        $this->item = Item::findOrFail($itemId);
        $this->itemId = $itemId;
        $this->name = $this->item->name;
        $this->code = $this->item->code;
        $this->categoryId = $this->item->category_id;
        $this->brandId = $this->item->brand_id;
        $this->status = $this->item->is_active ? '1' : '0';
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'status' => 'required|in:1,0',
            'categoryId' => 'nullable|exists:categories,id',
            'brandId' => 'nullable|exists:brands,id',
            'attachment' => 'nullable|image|max:5120', // 5MB Max
        ]);

        $this->item->update([
            'name' => $this->name,
            'code' => $this->code,
            'is_active' => $this->status === '1',
            'category_id' => $this->categoryId ?? null,
            'brand_id' => $this->brandId ?? null,
        ]);

        $this->item = null;
        $this->reset(['itemId', 'categoryId', 'brandId', 'attachment', 'name', 'code', 'status']);

        $this->dispatch('itemUpdated');
        $this->dispatch('closeItemModal');
    }

    public function render()
    {
        return view('livewire.modals.edit-item');
    }
}
