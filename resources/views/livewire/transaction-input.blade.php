<div>
    <div class="card">
        @if($showForm)
            <div class="card-body">
                <div class="float-end">
                    <button type="button" class="btn btn-link p-0 m-0 btn-sm" wire:click="toggleForm">Tutup</button>
                </div>
                <div class="row g-3 align-items-end">
                    <div class="col-auto">
                        <label for="store">Nama Toko</label>
                        <input type="text" class="form-control" placeholder="Beli dimana?" wire:model.defer="shop">
                    </div>
                    <div class="col-auto">
                        <label for="info">Keterangan</label>
                        <input type="text" class="form-control" wire:model.defer="info" placeholder="Apa yang dibeli?">
                    </div>
                    <div class="col-auto">
                        <label for="amount">Harga Satuan</label>
                        <div class="input-group">
                            <div class="input-group-text">Rp</div>
                            <input type="number" class="form-control" placeholder="Jumlah" wire:model.defer="amount">
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="amount">Satuan</label>
                        <div class="input-group">
                            <input type="number" min="0" wire:model.defer="unit" class="form-control" placeholder="Satuan">
                            <div class="input-group-text">Unit</div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="amount">Jumlah Barang</label>
                        <div class="input-group">
                            <div class="input-group-text">Qty</div>
                            <input type="number" min="1" wire:model.defer="qty" class="form-control" placeholder="Berapa banyak?">
                        </div>
                    </div>
                    <div class="col-auto">
                        <select name="category_id" id="category_id" class="form-control" wire:model.defer="category_id">
                            <option value="0">Pilih kategori:</option>
                            @for($i=1;$i<=5;$i++)
                                <option value="{{ $i }}">Kategori {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" wire:click="submitTransaction">Tambahkan</button>
                    </div>
                    <div class="col-auto">
                        <div class="text-muted" wire:loading wire:target="submitTransaction">Tunggu sebentar...</div>
                    </div>
                </div>
            </div>
        @else
            <div class="card-body">
                <button type="button" class="btn btn-link p-0 m-0 btn-sm" wire:click="toggleForm">Tambah Transaksi</button>
            </div>
        @endif
    </div>
</div>
