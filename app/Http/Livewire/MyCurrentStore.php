<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyCurrentStore extends Component
{
    public $store = null;

    public function mount()
    {
        $this->store = auth()->user()->currentStore;
    }

    public function render()
    {
        return view('livewire.my-current-store');
    }
}
