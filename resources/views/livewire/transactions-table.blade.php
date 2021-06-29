<div>
    <div class="my-3 bg-white d-flex">
        <div class="btn-group me-auto">
            <a href="#" class="btn btn-outline-secondary">Omset Pendapatan</a>
            <a href="#" class="btn btn-outline-secondary">Laba Rugi</a>
        </div>
        <div class="btn-group">
            <button class="btn btn-outline-secondary" wire:click="toggleFilters">{{ $showFilters ? 'Sembunyikan' : 'Tampilkan' }} Filter</button>
        </div>
    </div>
    @if($showFilters)
        <div class="row g-3">
        <div class="col-6">
            <select name="month" id="month" class="form-control" wire:model.defer="filterMonth">
                @for($i=1;$i<=12; $i++)
                    <option value="{{ $i }}" {{ $i == $filterMonth ? 'selected' : '' }}>{{ now()->startOfMonth()->month($i)->monthName }}</option>
                @endfor
            </select>
        </div>
        <div class="col-5">
            <select name="year" id="year" class="form-control" wire:model.defer="filterYear">
                @for($i=2010;$i<=now()->year; $i++)
                    <option value="{{ $i }}" {{ $i == $filterYear ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col">
            <button class="btn btn-primary" wire:click="getTransactions">Filter</button>
        </div>
    </div>
    @endif
    <div class="bg-white my-3 table-responsive">
        <table class="table">
            <thead class="bg-primary text-white">
            <tr>
                <th>Tanggal</th>
                <th>Nama Toko</th>
                <th>Keterangan</th>
                <th>Kategori</th>
                <th>Qty</th>
                <th>Unit</th>
                <th class="text-end">Harga</th>
                <th class="text-end">Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr wire:loading.table wire:target="getTransactions">
                <td colspan="8" class="text-center text-muted bg-light">Mengambil data...</td>
            </tr>
            @if($transactions->count() > 0)
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ \Illuminate\Support\Carbon::simpleDate($transaction->created_at) }}</td>
                        <td>{{ $transaction->shop }}</td>
                        <td>{{ $transaction->info }}</td>
                        <td><a href="#">?</a></td>
                        <td>{{ $transaction->qty }}</td>
                        <td>{{ $transaction->unit }}</td>
                        <td class="text-end">{{ \Illuminate\Support\Str::currency($transaction->amount, 'Rp') }}</td>
                        <td class="text-end">{{ \Illuminate\Support\Str::currency($transaction->amount * $transaction->qty, 'Rp') }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center text-muted">Tidak ada data untuk bulan ini</td>
                </tr>
            @endif
            <tr class="bg-light">
                <td colspan="7" class="fw-bold text-end">Total</td>
                <td class="fw-bold text-end">{{ \Illuminate\Support\Str::currency($total, "Rp") }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="my-3">
        {!! $transactions->links() !!}
    </div>
</div>
