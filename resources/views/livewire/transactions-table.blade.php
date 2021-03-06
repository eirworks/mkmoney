<div>
    <div class="my-3 bg-white d-print-none">
        <div class="btn-group">
            <button class="btn btn-outline-secondary" wire:click="toggleFilters">{{ $showFilters ? 'Sembunyikan' : 'Tampilkan' }} Filter</button>
        </div>
        <div class="btn-group">
            <a href="{{ route('stores::reports::expenditure', [$store, 'month' => $filterMonth, 'year' => $filterYear]) }}" class="btn btn-outline-secondary">Grafik</a>
            <a href="{{ route('stores::expenditures::createCsv', [$store]) }}" class="btn btn-outline-secondary">Upload</a>
        </div>
    </div>
    @if($showFilters)
        <div class="card d-print-none">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label for="filter_category_id">Pilih Kategori</label>
                        <select name="category_id" id="filter_category_id" class="form-control" wire:model.defer="filterCategory">
                            <option value="0">Semua Kategori:</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Bulan &amp; Tahun</label>
                        <select name="month" id="month" class="form-control" wire:model.defer="filterMonth">
                            @for($i=1;$i<=12; $i++)
                                <option value="{{ $i }}" {{ $i == $filterMonth ? 'selected' : '' }}>{{ now()->startOfMonth()->month($i)->monthName }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <select name="year" id="year" class="form-control" wire:model.defer="filterYear">
                            @for($i=2010;$i<=now()->year; $i++)
                                <option value="{{ $i }}" {{ $i == $filterYear ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" wire:click="getTransactions">Filter</button>
            </div>
        </div>
    @endif
    <div class="my-3 text-center h2 d-print-block d-none">Laporan Pengeluaran {{ $store->name }}</div>
    <div class="bg-white my-3 table-responsive">
        <table class="table">
            <thead class="bg-primary text-white">
            <tr>
                <th>Tanggal</th>
                @if($expenditure)
                <th>Nama Toko</th>
                <th>Keterangan</th>
                @endif
                <th>Kategori</th>
                <th>Qty</th>
                @if($expenditure)
                <th>Unit</th>
                @endif
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
                        <td><button class="btn btn-link text-dark p-0 m-0" wire:click="$set('transactionSelected', '{{ $transaction->id }}')">{{ \Illuminate\Support\Carbon::simpleDate($transaction->purchased_at) }}</button></td>
                        @if($expenditure)
                        <td>{{ $transaction->shop }}</td>
                        <td>{{ $transaction->info }}</td>
                        @endif
                        <td><button class="btn btn-link p-0 m-0" wire:click="setCategory({{ $transaction->category_id }})">{{ $transaction->category->name }}</button></td>
                        <td>{{ $transaction->qty }}</td>
                        @if($expenditure)
                        <td>{{ $transaction->unit }}</td>
                        @endif
                        <td class="text-end">{{ \Illuminate\Support\Str::currency(abs($transaction->amount), 'Rp') }}</td>
                        <td class="text-end">{{ \Illuminate\Support\Str::currency(abs($transaction->amount * $transaction->qty), 'Rp') }}</td>
                    </tr>
                    @if($transactionSelected == $transaction->id)
                        @if(!$modeEdit)
                            <tr>
                                <td colspan="8">
                                    <span class="text-muted me-2">ID: {{ $transaction->id }}</span>
                                    <span class="text-muted me-2">Tanggal: {{ \Illuminate\Support\Carbon::simpleDatetime($transaction->created_at) }}</span>
                                    <div class="btn-group">
                                        <button class="btn m-0 p-0 mx-2 btn-link text-dark" wire:click="$set('transactionSelected', '0')">Tutup</button>
                                        <button class="btn m-0 p-0 mx-2 btn-link" wire:click="openEditForm({{ $transaction->id }})">Edit</button>
                                        <button class="btn m-0 p-0 mx-2 btn-link text-danger" wire:click="deleteTransaction({{ $transaction->id }})">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td><button class="btn btn-link text-muted" wire:click="$set('modeEdit', false)">Batal</button></td>
                                <td><input type="text" class="form-control w-auto" value="{{ $transaction->shop }}" wire:model.defer="editInputShop"></td>
                                <td><input type="text" class="form-control w-auto" value="{{ $transaction->info }}" wire:model.defer="editInputInfo"></td>
                                <td>
                                    <select name="category_id" id="category_id" class="form-control" wire:model.defer="editInputCategoryId">
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" class="form-control" value="{{ $transaction->qty }}" wire:model.defer="editInputQty"></td>
                                <td><input type="number" class="form-control" value="{{ $transaction->unit }}" wire:model.defer="editInputUnit"></td>
                                <td class="text-end"><input type="number" class="form-control" value="{{ $transaction->amount }}" wire:model.defer="editInputAmount"></td>
                                <td>
                                    <button class="btn btn-outline-primary" wire:click="saveEdit">Simpan</button>
                                </td>
                            </tr>
                        @endif
                    @endif
                @endforeach
            @else
                <tr>
                    <td colspan="{{ $expenditure ? '8' : '6' }}" class="text-center text-muted">Tidak ada data untuk bulan ini</td>
                </tr>
            @endif
            <tr class="bg-light">
                <td colspan="{{ $expenditure ? '7' : '4' }}" class="fw-bold text-end">Total</td>
                <td class="fw-bold text-end">{{ \Illuminate\Support\Str::currency(abs($total), "Rp") }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="my-3">
        {!! $transactions->links() !!}
    </div>
</div>
