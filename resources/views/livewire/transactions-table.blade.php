<div>
    <div class="my-3 bg-white d-flex">
        <div class="btn-group me-auto">
            <a href="#" class="btn btn-outline-secondary">Omset Pendapatan</a>
            <a href="#" class="btn btn-outline-secondary">Laba Rugi</a>
        </div>
        <div class="btn-group">
            <button class="btn btn-outline-secondary">Filter</button>
        </div>
    </div>
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
            <tr class="bg-light">
                <td colspan="2"></td>
                <td>Total sebelumnya</td>
                <td colspan="4"></td>
                <td class="text-end">{{ $total_before }}</td>
            </tr>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ \Illuminate\Support\Carbon::simpleDate($transaction->created_at) }}</td>
                    <td>{{ $transaction->shop }}</td>
                    <td>{{ $transaction->info }}</td>
                    <td><a href="#">?</a></td>
                    <td>1</td>
                    <td>1</td>
                    <td class="text-end text-{{ $transaction->amount > 0 ? 'success' : 'danger' }}">Rp {{ $transaction->amount }}</td>
                    <td class="text-end">Rp {{ $transaction->amount }}</td>
                </tr>
            @endforeach
            <tr class="bg-light">
                <td colspan="7" class="fw-bold text-end">Total</td>
                <td class="fw-bold text-end text-{{ $transaction->amount > 0 ? 'success' : 'danger' }}">Rp {{ $total }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="my-3">
        {!! $transactions->links() !!}
    </div>
</div>
