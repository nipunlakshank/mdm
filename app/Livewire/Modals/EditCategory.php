<?php

namespace App\Livewire\Modals;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class EditCategory extends Component
{
    public ?Category $category;
    public ?int $categoryId;
    public ?string $name = '';
    public ?string $code = '';
    public ?string $status = '';

    #[On('editCategory')]
    public function editCategory(int $categoryId)
    {
        $this->category = Category::findOrFail($categoryId);
        $this->categoryId = $categoryId;
        $this->name = $this->category->name;
        $this->code = $this->category->code;
        $this->status = $this->category->is_active ? '1' : '0';
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'status' => 'required|in:1,0',
        ]);

        $this->category->update([
            'name' => $this->name,
            'code' => $this->code,
            'is_active' => $this->status === '1',
        ]);

        $this->category = null;
        $this->reset(['categoryId', 'name', 'code', 'status']);

        $this->dispatch('categoryUpdated');
        $this->dispatch('closeCategoryModal');
    }

    public function render()
    {
        return view('livewire.modals.edit-category');
    }
}
