<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Livewire\Component;

class LedgerTable extends Component
{
    public Store $store;
    public array $types;
    public int $changes = 0;
    public int $month;
    public int $year;

    public string $selected = 'cash';

    protected $listeners = [
        'ledgerNavChanged' => 'setSelected'
    ];

    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;
    }

    public function setSelected($selected)
    {
        $this->selected = $selected;
    }

    public function getTransactions()
    {
        return $this->store->transactions()
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->when($this->selected == 'costs', function($query) {
                $query->where('amount', '<=', 0);
            })
            ->when($this->selected == 'income', function($query) {
                $query->where('amount', '>', 0);
            })
            ->get();
    }

    public function render()
    {
        $trx = $this->getTransactions();
        $total = $trx->sum('amount');
        return view('livewire.ledger-table', [
            'transactions' => $trx,
            'total' => $total,
        ]);
    }
}
