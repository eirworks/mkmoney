<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Livewire\Component;

class TransactionInput extends Component
{
    public $info = "";
    public $amount = 0;
    public $category_id = 0;

    public Store $store;

    public function submitTransaction()
    {
        if ($this->category_id == 0)
        {
            $this->emit('error:invalid_category');
            return;
        }
        $transaction = $this->store->transactions()->create([
            'info' => $this->info,
            'amount' => $this->amount,
            'category_id' => $this->category_id,
        ]);

        $this->emit('transactionAdded', $transaction->id);
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->info = "";
        $this->amount = 0;
        $this->category_id = 0;
    }

    public function render()
    {
        return view('livewire.transaction-input');
    }
}
