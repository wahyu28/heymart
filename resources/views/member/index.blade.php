@extends('layouts.app')

@section('content')
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Daftar Member
            </h2>
            <div class="page-pretitle">
                <a href="{{ route('home') }}">Dashboard</a> / Member
            </div>
        </div>
    </div>
</div>

<div class="row row-cards text-muted">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex flex-row-reverse">
                {{-- <h3 class="card-title">Dashboard</h3> --}}
                <a onclick="addForm()" class="btn btn-success ml-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="4" y="4" width="16" height="16" rx="2" />
                        <line x1="9" y1="12" x2="15" y2="12" />
                        <line x1="12" y1="9" x2="12" y2="15" /></svg>
                    Tambah
                </a>
                <a onclick="printCard()" class="btn btn-info">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                        <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                        <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                        <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                        <rect x="5" y="11" width="1" height="2" />
                        <line x1="10" y1="11" x2="10" y2="13" />
                        <rect x="14" y="11" width="1" height="2" />
                        <line x1="19" y1="11" x2="19" y2="13" /></svg>
                    Cetak Kartu
                </a>
            </div>
            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <form method="POST" id="form-member">
                        @csrf
                        <table class="table table-striped table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="form-check-input" value="1" id="select-all"></th>
                                    <th class="20">No.</th>
                                    <th>Kode Member</th>
                                    <th>Nama Member</th>
                                    <th>Alamat</th>
                                    <th>Telpon</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('member.form')
@endsection

@push('after-script')
<script>
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
        "ajax": {
            "url": "{{ route('member.data') }}",
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
            if (save_method == "add") url = "{{ route('member.store') }}";
            else url = "member/" + id;

            $.ajax({
                url: url,
                type: "POST",
                data: $('#modal-form form').serialize(),
                success: function(data) {
                    if ($.isEmptyObject(data.errors)) {
                        if(data.msg == "error") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kode Member sudah digunakan',
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
                        title: 'Tidak dapat menyimpan data!',
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
        $('.alamat_err').hide();
        $('.telpon_err').hide();
    }
});

//Menampilkan form edit dan menampilkan data pada form tersebut
function editForm(id)
{
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modal-form form')[0].reset();
    $.ajax({
        url: "member/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#modal-form').modal({
                backdrop: 'static',
    		    keyboard: false,
                show: true
            });
            $('.modal-title').text('Edit Member');

            $('#id').val(data.id_member);
            $('#kode').val(data.kode_member).attr('readonly', true);
            $('#nama').val(data.nama);
            $('#alamat').val(data.alamat);
            $('#telpon').val(data.telpon);
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
    $('.modal-title').text('Tambah Member');
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
                url: "member/" + id,
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
                        title: 'Tidak dapat menghapus data!',
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
function printCard()
{
    if($('input:checked').length < 1) {
        Swal.fire({
            icon: 'warning',
            title: 'Pilih data yang akan di cetak!',
            showConfirmButton: true,
        });
    } else {
        $('#form-member').attr('target', '_blank').attr('action', 'member/cetak').submit();
    }
}
</script>
@endpush