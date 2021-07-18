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
                            <label for="nama" class="form-label">Nama User</label>
                            <input type="text" class="form-control" id="nama" name="nama"/>
                            <span class="invalid-feedback nama_err"></span>
                        </div>
                        <div class="form-group col-12  mt-2">
                            <input type="hidden" id="id" name="id">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"/>
                            <span class="invalid-feedback email_err"></span>
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"/>
                            <span class="invalid-feedback password_err"></span>
                        </div>
                        <div class="form-group col-12  mt-2">
                            <label for="password_confirmation" class="form-label">Ulangi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"/>
                            <span class="invalid-feedback password_confirmation_err"></span>
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