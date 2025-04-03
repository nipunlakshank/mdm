<?php

namespace App\Livewire\Modals;

use App\Models\Category;
use Livewire\Component;

class FormCategory extends Component
{
    public string $action = 'add';
    public ?Category $category;

    public function updateOrSave()
    {
        $this->action = 'edit';
        $this->dispatch('closeCategoryModal');
    }

    public function mount(?Category $category = null)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.modals.form-category');
    }
}
