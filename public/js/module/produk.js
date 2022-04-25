var table, save_method;

$(function() {
    // $('#modal-form').modal('show');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    //Menampilkan data dengan plugin Datatable
    table = $('.table').DataTable({
        "processing": true,
        "serverside": true,
        "ajax": {
            "url": "produk/data",
            "type": "GET"
        },
        'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'orderable': false
        }],
        'order': [1, 'asc']
    });

    $('#select-all').click(function() {
        $('input[type="checkbox"]').prop('checked', this.checked);
    });

    // Menyimpan data form tambah/edit beserta validasinya
    $("#modal-form form").on('submit', function(e) {
        if(!e.isDefaultPrevented()) {
            var id = $("#id").val();
            if (save_method == "add") url = "/produk";
            else url = "produk/" + id;

            $.ajax({
                url: url,
                type: "POST",
                data: $('#modal-form form').serialize(),
                success: function(data) {
                    if ($.isEmptyObject(data.errors)) {
                        if(data.msg == "error") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kode produk sudah digunakan',
                                showConfirmButton: true,
                            });
                        } else {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
    
                            Swal.fire({
                                icon: 'success',
                                title: 'Data berhasil dimasukan',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    } else {
                        console.log(data.errors);
                        resetValidationText();
                        printErrorMsg(data.errors);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Data gagal dimasukan',
                        showConfirmButton: true,
                    });
                }
            });
            return false;
        }

        function printErrorMsg(msg) {
            $.each(msg, function(key, value) {
                console.log(key);
                $('.' + key + '_err').text(value);
                $('.' + key + '_err').show();
            });
        }
    });

    $("#modal-form").on('hidden.bs.modal', function () {
        resetValidationText();
    });

    function resetValidationText() {
        $('.kode_err').hide();
        $('.nama_err').hide();
        $('.kategori_err').hide();
        $('.merk_err').hide();
        $('.harga_beli_err').hide();
        $('.diskon_err').hide();
        $('.harga_jual_err').hide();
        $('.stok_err').hide();
    }
});

//Menampilkan form edit dan menampilkan data pada form tersebut
function editForm(id)
{
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modal-form form')[0].reset();
    $.ajax({
        url: "produk/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#modal-form').modal({
                backdrop: 'static',
    		    keyboard: false,
                show: true
            });
            $('.modal-title').text('Edit Produk');

            $('#id').val(data.id_produk);
            $('#kode').val(data.kode_produk).attr('readonly', true);
            $('#nama').val(data.nama_produk);
            $('#kategori').val(data.id_kategori);
            $('#merk').val(data.merk);
            $('#harga_beli').val(data.harga_beli);
            $('#diskon').val(data.diskon);
            $('#harga_jual').val(data.harga_jual);
            $('#stok').val(data.stok);
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Tidak dapat menampilkan data',
                showConfirmButton: true,
            });
        }
    });
}

//Menampilkan form tambah
function addForm()
{
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
    $('#modal-form form')[0].reset();
    $('.modal-title').text('Tambah Produk');
    $('#kode').attr('readonly', false);
}

//Menghapus data
function deleteData(id)
{
    Swal.fire({
        title: 'Yakin menghapus data ini?',
        text: "Anda tidak akan bisa mengembalikan data yang telah di hapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6e7d88',
        confirmButtonText: 'Ya, Hapus data!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "produk/" + id,
                type: "POST",
                data: {_method: 'DELETE', _token: '{{csrf_token()}}'},
                success: function(data) {
                    table.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus dari database',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Data gagal dihapus, Silahkan refresh browser anda',
                        showConfirmButton: true,
                    });
                }
            });
        }
    })
}

//Menghapus semua data yang di centang
function deleteAll()
{
    if($('input:checked').length < 1) {
        Swal.fire({
            icon: 'warning',
            title: 'Pilih data yang akan di hapus!',
            showConfirmButton: true,
        });
    } else {
        Swal.fire({
            // title: 'Yakin menghapus data ini?',
            text: "Apakah yakin akan menghapus semua data terpilih?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6e7d88',
            confirmButtonText: 'Ya, Hapus data!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "produk/hapus",
                    type: "POST",
                    data: $('#form-produk').serialize(),
                    success: function(data) {
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil dihapus dari database',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Tidak dapat menghapus data',
                            showConfirmButton: true,
                        });
                    }
                });
            }
        })
    }
}

//Mencetak barcode ketika tombol cetak barcode di klik
function printBarcode()
{
    if($('input:checked').length < 1) {
        Swal.fire({
            icon: 'warning',
            title: 'Pilih data yang akan di cetak!',
            showConfirmButton: true,
        });
    } else {
        $('#form-produk').attr('target', '_blank').attr('action', 'produk/cetak').submit();
    }
}