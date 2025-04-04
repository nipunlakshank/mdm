<?php

namespace App\Livewire\Modals;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateItem extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $code = '';
    public string $status = '1';
    public ?int $brandId = null;
    public ?int $categoryId = null;
    public $attachment = null;
    public Collection $categories;
    public Collection $brands;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'status' => 'required|in:1,0',
            'categoryId' => 'nullable|exists:categories,id',
            'brandId' => 'nullable|exists:brands,id',
            'attachment' => 'nullable|image|max:5120', // 5MB Max
        ]);

        if ($this->attachment) {
            $attachmentUrl = Storage::disk('public')->put('brands', $this->attachment);
        }

        Item::create([
            'name' => $this->name,
            'code' => $this->code,
            'is_active' => $this->status === '1',
            'category_id' => $this->categoryId,
            'brand_id' => $this->brandId,
            'attachment' => $attachmentUrl ?? null,
        ]);

        $this->reset([
            'name',
            'code',
            'status',
            'brandId',
            'categoryId',
            'attachment',
        ]);

        $this->dispatch('itemCreated');
        $this->dispatch('closeItemModal');
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
    }

    public function render()
    {
        return view('livewire.modals.create-item');
    }
}
