<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Livewire\Component;

class TransactionInput extends Component
{
    public $shop = "";
    public $info = "";
    public $amount = 0;
    public $qty = 1;
    public $unit = "";
    public $category_id = 0;
    public $purchased_at = "";

    public Store $store;

    public bool $showForm = true;
    public bool $expenditure = false;

    public function mount()
    {
        $this->purchased_at = now()->format('Y-m-d');
    }

    public function submitTransaction()
    {
        if ($this->category_id == 0)
        {
            $this->emit('error:invalid_category');
            return;
        }

        if ($this->expenditure) {
            if (empty($this->shop) || empty($this->info))
            {
                $this->emit('error:invalid_inputs');
                return;
            }
        }

        $transaction = $this->store->transactions()->create([
            'info' => $this->info,
            'shop' => $this->shop,
            'qty' => $this->qty,
            'unit' => $this->unit,
            'amount' => $this->amount,
            'category_id' => $this->category_id,
            'purchased_at' => $this->purchased_at,
        ]);

        $this->emit('transactionAdded', $transaction->id);
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->shop = "";
        $this->info = "";
        $this->amount = 0;
        $this->category_id = 0;
        $this->unit = 1;
        $this->qty = 1;
        $this->purchased_at = now()->format('Y-m-d');
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function render()
    {
        $parentCategories = $this->store->categories()
            ->orderBy('name', 'asc')
            ->select(['id', 'name'])
            ->onlyParent()
            ->where('is_expenditure', $this->expenditure)
            ->with(['subcategories:id,name,parent_id'])
            ->get();

        return view('livewire.transaction-input', [
            'categories' => $parentCategories,
        ]);
    }
}
