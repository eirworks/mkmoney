<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Livewire\Component;

class CategoryForm extends Component
{
    private Store $store;

    public bool $showForm = false;
    public string $inputName;
    public string $inputDescription;

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function submitCategory()
    {
        $this->emit("categorySubmitted");
    }

    public function render()
    {
        return view('livewire.category-form');
    }
}
