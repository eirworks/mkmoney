<div>
    <div class="card">
        <div class="card-header">
            Bisnisku: {{ $store['name'] ?? 'Anda belum mengeset bisnis utama' }}
        </div>
        <div class="card-body">
            @unless($store)
                Anda belum menentukan bisnis utama anda, pilih bisnis utama anda
                di halaman <a href="#">bisnisku</a>.
            @else
            @endif
        </div>
    </div>
</div>
