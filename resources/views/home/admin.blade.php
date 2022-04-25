@extends('layouts.app')

@section('content')
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Dashboard
            </h2>
            <div class="page-pretitle">
                Home / <a href="{{ route('home') }}">Dashboard</a>
            </div>
        </div>
    </div>
</div>

<div class="row row-cards text-muted">
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Penjualan</div>
                    <div class="ml-auto lh-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Last 7 days</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item active" href="#">Last 7 days</a>
                                <a class="dropdown-item" href="#">Last 30 days</a>
                                <a class="dropdown-item" href="#">Last 3 months</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h1 mb-3 text-blue">75</div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
          <div class="card-body d-flex align-items-center">
            <span class="bg-blue text-white avatar mr-3"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path><path d="M12 3v3m0 12v3"></path></svg>
            </span>
            <div class="mr-0">
              <div class="font-weight-medium">
                132 Sales
              </div>
              <div class="text-muted">12 waiting payments</div>
            </div>
          </div>
        </div>
      </div>

    <div class="col-12">
        <div class="card">
            {{-- <div class="card-header">
                <h3 class="card-title">Dashboard</h3>
            </div> --}}
            <div class="card-body border-bottom py-3">
                <h1>Selamat Datang</h1>
                <h2>Anda login sebagai ADMIN</h2>
            </div>
        </div>
    </div>
</div>
@endsection