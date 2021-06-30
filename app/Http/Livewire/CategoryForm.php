<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Store;
use Livewire\Component;

class CategoryForm extends Component
{
    public Store $store;

    public bool $showForm = false;
    public string $inputName = "";
    public string $inputDescription = "";

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function submitCategory()
    {
        $category = new Category([
            'name' => $this->inputName,
            'description' => $this->inputDescription,
        ]);
        $category->store_id = $this->store->id;
        $category->save();

        $this->resetInputs();
        $this->emit("categorySubmitted", $category->id);
    }

    public function resetInputs()
    {
        $this->showForm = false;
        $this->inputName = "";
        $this->inputDescription = "";
    }

    public function render()
    {
        return view('livewire.category-form');
    }
}
