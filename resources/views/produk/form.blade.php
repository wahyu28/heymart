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
                            <label for="nama" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama" name="nama"/>
                            <span class="invalid-feedback nama_err"></span>
                        </div>
                        <div class="form-group col-6  mt-2">
                            <input type="hidden" id="id" name="id">
                            <label for="kode" class="form-label">Kode Produk</label>
                            <input type="number" class="form-control" id="kode" name="kode"/>
                            <span class="invalid-feedback kode_err"></span>
                        </div>
                        <div class="form-group col-6 mt-2">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select name="kategori" id="kategori" name="kategori" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $list)
                                    <option value="{{ $list->id_kategori }}">{{ $list->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback kategori_err"></span>
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="merk" class="form-label">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk"/>
                            <span class="invalid-feedback merk_err"></span>
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="harga_bei" class="form-label">Harga Beli</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="harga_bei" name="harga_bei"/>
                            </div>
                            <span class="invalid-feedback harga_beli_err"></span>
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="diskon" class="form-label">Diskon</label>
                            <input type="text" class="form-control" id="diskon" name="diskon"/>
                            <span class="invalid-feedback diskon_err"></span>
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="harga_jual" name="harga_jual"/>
                            </div>
                            <span class="invalid-feedback harga_jual_err"></span>
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="text" class="form-control" id="stok" name="stok"/>
                            <span class="invalid-feedback stok_err"></span>
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