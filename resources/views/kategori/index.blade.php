@extends('layouts.app')

@section('content')
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Kategori
            </h2>
            <div class="page-pretitle">
                <a href="{{ route('home') }}">Dashboard</a> /
                @for ($i = 0; $i <= count(Request::segments()); $i++) {{ Request::segment($i) }} @if ($i <
                    count(Request::segments()) & $i> 0)
                    /
                    @endif
                    @endfor
            </div>
        </div>

        <!-- Tombol Aksi Halaman -->
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <a onclick="addForm()" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Tambah Kategori
                </a>
                <a onclick="addForm()" class="btn btn-primary d-sm-none btn-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="row row-cards text-muted">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom py-3">
                    <div class="table-responsive">
                        <table class="table table-vcenter">
                        {{-- <table class="table text-nowrap"> --}}
                            <thead>
                                <tr>
                                    {{-- <th class="w-4">No.</th> --}}
                                    <th>Nama Kategori</th>
                                    <th class="w-5">Aksi</th>
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
</div>
@include('kategori.form')
@endsection

@push('after-style')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('js/toastr/notifications-toastr.js') }}"></script>
<script src="{{ asset('js/module/kategori.js') }}"></script>
@endpush