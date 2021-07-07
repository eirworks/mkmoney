<?php

namespace App\Http\Livewire;

use App\Models\IncomeRecord;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class IncomeRecordForm extends Component
{
    public bool $showForm = false;
    public bool $showFilter = false;

    public Store $store;
    public $day = 0;
    public $month = 0;
    public $year = 0;
    public $amount = 0;
    public $name = "";

    public function submitTransaction()
    {
        if ($this->amount < 0) {
            $this->emit('formError', "Jumlah tidak bisa bernilai minus!");
        }

        $date = Carbon::create($this->year, $this->month, $this->day);
        $trx = $this->store->incomeRecords()->whereDate('date', $date)->first();
        if($trx) {
            $trx->fill([
                'store_id' => $this->store->id,
                'date' => $date,
                'amount' => $this->amount,
                'name' => $this->name,
            ]);
            $trx->save();
        } else {
            $trx = new IncomeRecord([
                'store_id' => $this->store->id,
                'date' => $date,
                'amount' => $this->amount,
                'name' => $this->name,
            ]);
            $trx->user_id = auth()->id();
            $trx->save();
        }

        $this->emit('trxAdded', $trx);
    }

    public function render()
    {
        return view('livewire.income-record-form');
    }
}
