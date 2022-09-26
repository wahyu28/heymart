<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            {{-- <div class="nav-item dropdown d-none d-md-flex mr-3">
                <a href="#" id="btn-notifications" onclick="loadNotifications()" aria-label="button" class="nav-link px-0" tabindex="-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                    <span class="badge bg-red"></span>
                </a>
            </div> --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
                    <span class="avatar avatar-sm"
                        style="background-image: url({{ asset('images/' . Auth::user()->foto) }})"></span>
                    <div class="d-none d-xl-block pl-2">
                        <div>{{ Auth()->user()->name }}</div>
                        <div class="mt-1 small text-muted">Administrator</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a href="{{ route('user.profil') }}" class="dropdown-item">Profile & account</a>
                    @if (auth()->user()->level == 1)
                        <a href="#" class="dropdown-item">Settings</a>
                    @endif
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-logout">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div>
                <form action="." method="get">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                        </span>
                        <input type="text" class="form-control" placeholder="Search…">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Notifikasi -->
    <div class="modal modal-blur fade" id="modal-notifikasi" tabindex="-1" role="dialog" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notifikasi</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <h3 class="pt-2" style="padding-left: 1.5rem"><strong>Produk</strong></h3>
                    <div id="produk-notifikasi">

                        <a href="{{ route('produk.index') }}" class="produk-list-notifikasi">
                            <p class="pt-2 pb-2 m-0" style="padding-left: 1.5rem !important"><strong>Buku Trik Dahsyat
                                    Ajax</strong> jquery tersisa <span class="text-danger"><strong>4
                                        buah</strong></span></p>
                        </a>
                        <a href="{{ route('produk.index') }}" class="produk-list-notifikasi">
                            <p class="pt-2 pb-2 m-0" style="padding-left: 1.5rem !important"><strong>Buku Trik Dahsyat
                                    Ajax</strong> jquery tersisa <span class="text-danger"><strong>4
                                        buah</strong></span></p>
                        </a>
                    </div>
                </div>
                <div class="modal-footer pt-2">
                    <button type="button" class="btn me-auto" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Notifikasi -->
</header>
