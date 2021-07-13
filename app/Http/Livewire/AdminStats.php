<?php

namespace App\Http\Livewire;

use App\Models\IncomeRecord;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class AdminStats extends Component
{
    public string $stat;
    public int $value;
    public string $name = "?";

    public function mount()
    {
        if ($this->stat == Store::class)
        {
            $this->name = "Bisnis";
            $this->value = $this->countStores();
        } else if ($this->stat == Transaction::class)
        {
            $this->name = "Transaksi";
            $this->value = $this->countTransactions();
        } else {
            $this->name = "Pengguna";
            $this->value = $this->countUsers();
        }
    }

    private function countUsers()
    {
        return User::count();
    }

    private function countStores()
    {
        return Store::count();
    }

    private function countTransactions()
    {
        return Transaction::count() + IncomeRecord::count();
    }

    public function render()
    {
        return view('livewire.admin-stats');
    }
}
