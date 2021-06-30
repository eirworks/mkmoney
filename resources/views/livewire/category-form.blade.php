<div>
    <div><button class="btn btn-primary" wire:click="toggleForm">Tambah Kategori</button></div>
    @if($showForm)
        <div class="card my-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" wire:model.defer="inputName" placeholder="Nama Kategori">
                </div>
                <div class="col">
                    <input type="text" class="form-control" wire:model.defer="inputDescription" placeholder="Deskripsi Kategori">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" wire:click="submitCategory">Simpan</button>
            <button class="btn btn-link" wire:click="toggleForm">Tutup</button>
            <span class="text-muted" wire:loading>Tunggu sebentar...</span>
        </div>
    </div>
    @endif
</div>

@push('bottom')
    <script>
        Livewire.on('categorySubmitted', function() {
            alert("Kategori telah ditambahkan!");
            window.location.reload();
        })
    </script>
@endpush
