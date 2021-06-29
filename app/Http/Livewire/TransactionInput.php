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
    public $unit = 1;
    public $category_id = 0;

    public Store $store;

    public function submitTransaction()
    {
        if ($this->category_id == 0)
        {
            $this->emit('error:invalid_category');
            return;
        }

        if (empty($this->shop) || empty($this->info))
        {
            $this->emit('error:invalid_inputs');
            return;
        }

        $transaction = $this->store->transactions()->create([
            'info' => $this->info,
            'shop' => $this->shop,
            'qty' => $this->qty,
            'unit' => $this->unit,
            'amount' => $this->amount,
            'category_id' => $this->category_id,
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
    }

    public function render()
    {
        return view('livewire.transaction-input');
    }
}
