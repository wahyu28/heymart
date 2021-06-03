<div class="modal modal-blur fade" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST">
                @csrf @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-end">
                        <div class="col">
                            <input type="hidden" id="id" name="id">
                            <label for="nama" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama" name="nama" autofocus/>
                            <span class="invalid-feedback nama_err"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn mr-auto" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>