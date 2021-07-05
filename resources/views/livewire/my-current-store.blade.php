<div>
    <div class="card">
        @if($header)
        <div class="card-header">
            Bisnisku: {{ $store['name'] ?? 'Anda belum mengeset bisnis utama' }}
        </div>
        @endif
        @unless($store)
            <div class="card-body text-center text-muted">
                Anda belum menentukan bisnis utama anda, pilih bisnis utama anda
                di halaman <a href="{{ route('stores::index') }}">bisnisku</a>.
            </div>
        @else
            <table class="table">
                <thead class="bg-primary text-white">
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ \Illuminate\Support\Carbon::simpleDate($transaction->created_at) }}</td>
                        <td>{{ $transaction->info }}</td>
                        <td>{{ $transaction->category->name }}</td>
                        <td>{{ \Illuminate\Support\Str::currency($transaction->amount, "Rp") }}</td>
                        <td>{{ $transaction->qty }}</td>
                        <td>{{ \Illuminate\Support\Str::currency($transaction->amount * $transaction->qty, "Rp") }}</td>
                    </tr>
                @endforeach
                <tr class="bg-light">
                    <td colspan="6" class="fw-bold text-end">Total</td>
                    <td class="fw-bold text-success">{{ \Illuminate\Support\Str::currency($total, "Rp") }}</td>
                </tr>
                </tbody>
            </table>
        @endif
        @if($store && $showLinks)
            <div class="card-footer">
                <div class="btn-group">
                    <a href="{{ route('stores::show', [$store['id']]) }}" class="btn btn-link fw-bold">{{ $store['name'] }}</a>
                    <a href="{{ route('stores::income::index', [$store['id']]) }}" class="btn btn-link">Rekap Pemasukan</a>
                    <a href="{{ route('stores::expenditures::index', [$store['id']]) }}" class="btn btn-link">Rekap Pengeluaran</a>
                    <a href="{{ route('stores::reports::income', [$store['id']]) }}" class="btn btn-link">Laporan Laba Rugi</a>
                </div>
            </div>
        @endif
    </div>
</div>
