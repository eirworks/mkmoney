<div>
    <div class="card">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-auto">
                    <label for="store">Nama Toko</label>
                    <input type="text" class="form-control" placeholder="Beli dimana?">
                </div>
                <div class="col-auto">
                    <label for="info">Keterangan</label>
                    <input type="text" class="form-control" wire:model.defer="info" placeholder="Apa yang dibeli?">
                </div>
                <div class="col-auto">
                    <label for="amount">Nilai</label>
                    <div class="input-group">
                        <div class="input-group-text">Rp</div>
                        <input type="number" class="form-control" placeholder="Jumlah" wire:model.defer="amount">
                    </div>
                </div>
                <div class="col-auto">
                    <label for="amount">Jumlah Barang</label>
                    <div class="input-group">
                        <div class="input-group-text">@</div>
                        <input type="number" min="0" class="form-control" placeholder="Berapa banyak?">
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
                    <div class="text-muted" wire:loading>Tunggu sebentar...</div>
                </div>
            </div>
        </div>
    </div>
</div>
