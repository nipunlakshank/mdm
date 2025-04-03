<?php

namespace App\Livewire\Modals;

use App\Models\Item;
use Livewire\Component;

class FormItem extends Component
{
    public string $action = 'add';
    public ?Item $item;

    public function updateOrSave()
    {
        $this->action = 'edit';
        $this->dispatch('closeItemModal');
    }

    public function mount(?Item $item = null)
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.modals.form-item');
    }
}
