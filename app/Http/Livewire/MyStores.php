<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyStores extends Component
{
    private array $stores = [];

    public int $limit = 15;

    public function getMyStores()
    {
        $this->stores = auth()->user()->stores()->latest('updated_at')->limit($this->limit)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.my-stores', [
            'stores' => $this->stores,
        ]);
    }
}
