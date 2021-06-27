<div>
    <div class="card">
        <table class="table">
            <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Kategori</th>
                <th></th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-light">
                <td colspan="2"></td>
                <td>Total sebelumnya</td>
                <td colspan="2"></td>
                <td>{{ $total_before }}</td>
            </tr>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ Carbon\Carbon::parse($transaction->created_at)->format('d M Y H:i') }}</td>
                    <td>{{ $transaction->info }}</td>
                    <td><a href="#">?</a></td>
                    <td class="text-{{ $transaction->amount > 0 ? 'success' : 'danger' }}">Rp {{ $transaction->amount }}</td>
                    <td>Rp {{ $transaction->amount }}</td>
                </tr>
            @endforeach
            <tr class="bg-light">
                <td colspan="5" class="fw-bold text-end">Total</td>
                <td class="fw-bold text-{{ $transaction->amount > 0 ? 'success' : 'danger' }}">Rp {{ $total }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="my-3">
        {!! $transactions->links() !!}
    </div>
</div>
