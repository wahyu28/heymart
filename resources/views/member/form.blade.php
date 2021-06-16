<div class="modal modal-blur fade" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
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
                        <div class="form-group col-12">
                            <input type="hidden" id="id" name="id">
                            <label for="kode" class="form-label">Kode Member</label>
                            <input type="number" class="form-control" id="kode" name="kode"/>
                            <span class="invalid-feedback kode_err"></span>
                        </div>
                        <div class="form-group col-12 mt-2">
                            <label for="nama" class="form-label">Nama Member</label>
                            <input type="text" class="form-control" id="nama" name="nama"/>
                            <span class="invalid-feedback nama_err"></span>
                        </div>
                        <div class="form-group col-12 mt-2">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"></textarea>
                            <span class="invalid-feedback alamat_err"></span>
                        </div>
                        <div class="form-group col-12 mt-2">
                            <label for="telpon" class="form-label">Telpon</label>
                            <input type="text" class="form-control" id="telpon" name="telpon"/>
                            <span class="invalid-feedback telpon_err"></span>
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