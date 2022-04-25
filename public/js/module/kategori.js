var table, save_method;

$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    table = $('.table').DataTable({
        "processing": true,
        "ajax": {
            "url": "kategori/data",
            "type": "GET"
        }
    });    

    // Menyimpan data form tambah/edit beserta validasinya
    $("#modal-form form").on('submit', function(e) {
        if(!e.isDefaultPrevented()) {
            var id = $("#id").val();
            if (save_method == "add") url = "/kategori";
            else url = "kategori/" + id;

            $.ajax({
                url: url,
                type: "POST",
                data: $('#modal-form form').serialize(),
                success: function(data) {
                    if ($.isEmptyObject(data.errors)) {
                        table.ajax.reload();
                        $('#modal-form').modal('hide');

                        if (save_method == "add") {
                            toastr.success("Kategori baru berhasil ditambahkan", "Berhasil!");
                        } else {
                            toastr.success("Kategori berhasil diperbaharui", "Berhasil!");
                        }
                    } else {
                        console.log(data.errors);
                        resetValidationText();
                        printErrorMsg(data.errors);
                    }
                },
                error: function() {
                    if (save_method == "add") {
                        toastr.error("Kategori gagal ditambahkan", "Gagal!");
                    } else {
                        toastr.error("Kategori gagal diperbaharui", "Gagal!");
                    }
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
        $('.nama_err').hide();
    }
});

//Menampilkan form edit dan menampilkan data pada form tersebut
function editForm(id)
{
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modal-form form')[0].reset();
    $.ajax({
        url: "kategori/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#modal-form').modal({
                backdrop: 'static',
    		    keyboard: false,
                show: true
            });
            $('.modal-title').text('Edit Kategori');

            $('#id').val(data.id_kategori);
            $('#nama').val(data.nama_kategori);
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Kategori gagal di tampilkan',
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
    $('.modal-title').text('Tambah Kategori');
}

//Menghapus data
function deleteData(id)
{
    var url = "kategori/" + id;

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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/kategori/" + id,
                type: "delete",
                data: {
                    "id": id
                },
                success: function(res) {
                    table.ajax.reload();
                    toastr.success("Kategori berhasil dihapus", "Berhasil!");
                    console.log(res);
                },
                error: function(xhr) {
                    toastr.error("Kategori gagal dihapus", "Error!");
                    console.log(url);
                    console.log(xhr.responseText);
                }
            });
        }
    })
}