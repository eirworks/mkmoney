<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class MyCurrentStore extends Component
{
    public $store = null;
    public bool $showLinks = false;
    public bool $header = false;

    public function mount()
    {
        $this->store = auth()->user()->currentStore;
    }

    public function render()
    {
        $total = Transaction::where('store_id', $this->store['id'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $transactions = Transaction::where('store_id', $this->store['id'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->latest('id')
            ->take(5)
            ->get();

        return view('livewire.my-current-store', [
            'transactions' => $transactions,
            'total' => $total,
        ]);
    }
}
