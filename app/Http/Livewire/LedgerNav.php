<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LedgerNav extends Component
{
    public array $types;
    public string $selected;

    public function mount() {
        $this->selected = 'cash';
    }
    protected $listeners = [
        'ledgerNavChanged' => 'setSelected'
    ];

    public function setSelected($selected)
    {
        $this->selected = $selected;
    }

    public function render()
    {
        return view('livewire.ledger-nav');
    }
}
