<?php

namespace App\Livewire\Modals;

use App\Models\Category;
use Livewire\Component;

class CreateCategory extends Component
{
    public string $name = '';
    public string $code = '';
    public string $status = '1';

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'status' => 'required|in:1,0',
        ]);

        Category::create([
            'name' => $this->name,
            'code' => $this->code,
            'is_active' => $this->status === '1',
        ]);

        $this->reset(['name', 'code', 'status']);

        $this->dispatch('categoryCreated');
        $this->dispatch('closeCategoryModal');
    }

    public function render()
    {
        return view('livewire.modals.create-category');
    }
}
