<?php

namespace App\Http\Livewire;

use App\Models\Store;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionsTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public Store $store;
    public int $limit = 25;
    public bool $showFilters = false;

    public int $filterYear;
    public int $filterMonth;
    public int $filterCategory;

    public $categories;
    public int $transactionSelected = 0;
    public bool $modeEdit = false;

    public $editInputShop = "";
    public $editInputInfo = "";
    public $editInputQty = "";
    public $editInputUnit = "";
    public $editInputAmount = "";
    public $editInputCategoryId = "";

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

    public function selectTransaction($id) {
        $this->transactionSelected = $id;
    }

    public function openEditForm($id) {
        $transaction = Transaction::find($id);
        $this->modeEdit = true;
        $this->editInputShop = $transaction->shop;
        $this->editInputInfo = $transaction->info;
        $this->editInputQty = $transaction->qty;
        $this->editInputUnit = $transaction->unit;
        $this->editInputAmount = $transaction->amount;
        $this->editInputCategoryId = $transaction->category_id;
    }

    public function saveEdit()
    {
        $transaction = Transaction::find($this->transactionSelected);

        $transaction->fill([
            'info' => $this->editInputInfo,
            'shop' => $this->editInputShop,
            'qty' => $this->editInputQty,
            'unit' => $this->editInputUnit,
            'amount' => $this->editInputAmount,
            'category_id' => $this->editInputCategoryId,
        ]);
        $transaction->save();

        $this->modeEdit = false;
        $this->transactionSelected = 0;

        $this->getTransactions();
        $this->emit('transactionUpdated', $transaction->id);
    }

    public function deleteTransaction($id)
    {
        Transaction::where('id', $id)->delete();

        $this->emit('transactionDeleted', $id);
        $this->getTransactions();
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
