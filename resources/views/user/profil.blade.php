@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Profil
                </h2>
                <div class="page-pretitle">
                    <a href="{{ route('home') }}">Dashboard</a> /
                    @for ($i = 0; $i <= count(Request::segments()); $i++)
                        {{ Request::segment($i) }} @if (($i < count(Request::segments())) & ($i > 0))
                            /
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-body border-bottom py-3">
                    <form method="POST" class="form" enctype="multipart/form-data">
                        @csrf @method('PATCH')
                        <div class="form-group mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" id="foto" class="form-control" name="foto">
                            <br>
                            <div class="tampil-foto">
                                @if (!empty(Auth::user()->foto))
                                    <img src="{{ asset('/images/' . Auth::user()->foto) }}" width="200">
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="passwordlama" class="form-label">Password Lama</label>
                            <input type="password" id="passwordlama" class="form-control" name="passwordlama">
                            <span class="invalid-feedback passwordlama"></span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password">
                            <span class="invalid-feedback password"></span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password_confirmation " class="form-label">Ulangi Password</label>
                            <input type="password" id="password_confirmation" class="form-control"
                                name="password_confirmation">
                            <span class="invalid-feedback password_confirmation"></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <script>
        $(function() {
            $("#passwordlama").keyup(function() {
                if ($(this).val() != "") {
                    $('#password, $password1').attr('required', true);
                } else {
                    $('#password, $password1').attr('required', false);
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Menyimpan data form tambah/edit beserta validasinya
            $(".form").on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    $.ajax({
                        url: "{{ Auth::user()->id }}/change",
                        type: "POST",
                        data: new FormData($(".form")[0]),
                        dataType: 'JSON',
                        async: false,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.msg == 'error') {
                                alert('Password lama salah!');
                                $('#passwordlama').focus().select();
                            } else {
                                d = new Date();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Perubahan berhasil dilakukan',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('.tampil-foto img .user-image .user-header img').attr('src',
                                    data.url + '?' + d.getTime());
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
            });
        });
    </script>
@endpush
