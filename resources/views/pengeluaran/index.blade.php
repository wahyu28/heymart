@extends('layouts.app')

@section('content')
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Daftar Pengeluaran
            </h2>
            <div class="page-pretitle">
                <a href="{{ route('home') }}">Dashboard</a> / 
                @for ($i = 0; $i <= count(Request::segments()); $i++)
                {{ Request::segment($i) }}
                    @if ($i < count(Request::segments()) & $i > 0)
                       /
                    @endif
                @endfor
            </div>
        </div>
    </div>
</div>

<div class="row row-cards text-muted">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex flex-row-reverse">
                {{-- <h3 class="card-title">Dashboard</h3> --}}
                <a onclick="addForm()" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="4" y="4" width="16" height="16" rx="2" />
                        <line x1="9" y1="12" x2="15" y2="12" />
                        <line x1="12" y1="9" x2="12" y2="15" /></svg>
                    Tambah
                </a>
            </div>
            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th class="w-4">No.</th>
                                <th>Tanggal</th>
                                <th>Jenis Pengeluaran</th>
                                <th>Nominal</th>
                                <th class="w-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pengeluaran.form')
@endsection

@push('after-script')
<script>
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
            "url": "{{ route('pengeluaran.data') }}",
            "type": "GET"
        }
    });

    // Menyimpan data form tambah/edit beserta validasinya
    $("#modal-form form").on('submit', function(e) {
        if(!e.isDefaultPrevented()) {
            var id = $("#id").val();
            if (save_method == "add") url = "{{ route('pengeluaran.store') }}";
            else url = "pengeluaran/" + id;

            $.ajax({
                url: url,
                type: "POST",
                data: $('#modal-form form').serialize(),
                success: function(data) {
                    if ($.isEmptyObject(data.errors)) {
                        table.ajax.reload();
                        $('#modal-form').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil dimasukan',
                            showConfirmButton: false,
                            timer: 1500
                        });
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
        $('.jenis_err').hide();
        $('.nominal_err').hide();
    }
});

//Menampilkan form edit dan menampilkan data pada form tersebut
function editForm(id)
{
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modal-form form')[0].reset();
    $.ajax({
        url: "pengeluaran/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#modal-form').modal({
                backdrop: 'static',
    		    keyboard: false,
                show: true
            });
            $('.modal-title').text('Edit Pengeluaran');

            $('#id').val(data.id_pengeluaran);
            $('#jenis').val(data.jenis_pengeluaran);
            $('#nominal').val(data.nominal);
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Data gagal dimasukan, Silahkan refresh browser anda',
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
    $('.modal-title').text('Tambah Pengeluaran');
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
                url: "pengeluaran/" + id,
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
</script>
@endpush