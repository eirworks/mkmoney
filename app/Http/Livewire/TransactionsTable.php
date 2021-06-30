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
    public bool $showFilters = false;

    public int $filterYear;
    public int $filterMonth;
    public int $filterCategory;

    public $categories;

    protected $listeners = [
        'transactionAdded' => 'getTransactions'
    ];

    public function mount()
    {
        $this->filterYear = now()->year;
        $this->filterMonth = now()->month;
        $this->filterCategory = 0;
        $this->categories = $this->store->categories()->orderBy('name')->select(['id', 'name'])->get()->toArray();
    }

    public function getTransactions($page = 1)
    {
        if ($page == 1) {
            $this->resetPage();
        }
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function setCategory($category = 0)
    {
        $this->filterCategory = $category;
    }

    public function render()
    {
        $transactions = $this->store->transactions()
            ->whereMonth('created_at',$this->filterMonth)
            ->whereYear('created_at',$this->filterYear)
            ->when($this->filterCategory > 0, function($query) {
                $query->where('category_id', $this->filterCategory);
            })
            ->with(['category:id,name'])
            ->paginate($this->limit);

        $total = $this->store->transactions()
            ->whereMonth('created_at',$this->filterMonth)
            ->whereYear('created_at',$this->filterYear)
            ->when($this->filterCategory > 0, function($query) {
                $query->where('category_id', $this->filterCategory);
            })
            ->sum('amount');

        return view('livewire.transactions-table', [
            'transactions' => $transactions,
            'total' => $total,
        ]);
    }
}
