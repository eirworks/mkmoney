<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionsTable extends Component
{
    use WithPagination;
    public Store $store;
    public int $limit = 25;

    protected $listeners = [
        'transactionAdded' => 'getTransactions'
    ];

    public function getTransactions($page = 1)
    {
        if ($page == 1) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $transactions = $this->store->transactions()->latest('id')
            ->whereMonth('created_at',now()->month)
            ->whereYear('created_at',now()->year)
            ->paginate($this->limit);

        $total = $this->store->transactions()
            ->whereMonth('created_at',now()->month)
            ->whereYear('created_at',now()->year)
            ->sum('amount');

        $totalBefore = $this->store->transactions()
            ->whereDate('created_at', '<', now()->startOfMonth())
            ->sum('amount');

        return view('livewire.transactions-table', [
            'transactions' => $transactions,
            'total_before' => $totalBefore,
            'total' => $total,
        ]);
    }
}
