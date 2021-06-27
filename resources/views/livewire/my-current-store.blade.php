<div>
    <div class="card">
        <div class="card-header">
            Bisnisku: {{ $store['name'] ?? 'Anda belum mengeset bisnis utama' }}
        </div>
        <div class="card-body">
            @unless($store)
                Anda belum menentukan bisnis utama anda, pilih bisnis utama anda
                di halaman <a href="{{ route('stores::index') }}">bisnisku</a>.
            @else
                <div class="mb-3">Menampilkan 5 transaksi terakhir bulan {{ now()->localeMonth }} {{ now()->year }} <a
                        href="#" class="ms-2">Lihat semua transaksi</a></div>
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
                    @for($i=1; $i<=5; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ now()->format('d M Y H:i') }}</td>
                            <td>Transaksi #{{ $i }}</td>
                            <td><a href="#">Operasional</a></td>
                            <td class="text-success">Rp 50.000</td>
                            <td>Rp {{ number_format(50000 + $i * 50000, 2, ',', '.') }}</td>
                        </tr>
                    @endfor
                    <tr class="bg-light">
                        <td colspan="5" class="fw-bold text-end">Total</td>
                        <td class="fw-bold text-success">Rp 5.570.000</td>
                    </tr>
                    </tbody>
                </table>
            @endif
        </div>
        <div class="card-footer">
            <div class="btn-group">
                <a href="{{ route('stores::show', [$store['id']]) }}" class="btn btn-link fw-bold">{{ $store['name'] }}</a>
                <a href="#" class="btn btn-link">Semua Transaksi</a>
                <a href="#" class="btn btn-link">Lihat Laporan</a>
            </div>
        </div>
    </div>
</div>
