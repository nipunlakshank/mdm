<?php

namespace App\Livewire\Modals;

use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteConfirmation extends Component
{
    public ?Model $model;

    #[On('deleteModel')]
    public function deleteModel(int $modelId, string $modelClass)
    {
        $this->model = app($modelClass)->findOrFail($modelId);
    }

    public function delete()
    {
        $this->model->delete();

        $this->model = null;

        $this->dispatch('modelDeleted');
        $this->dispatch('closeDeleteModal');
    }

    public function render()
    {
        return view('livewire.modals.delete-confirmation');
    }
}
