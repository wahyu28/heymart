<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Log in</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
    <style>
        body {
            display: none;
        }

        /** Hide spinner on page load */
        .spinner {
            display: none;
        }

        /** Code to rotate the spinnner with keyframes */
        .button-prevent-multiple-submits .spinner {
            -webkit-animation: spin 4s linear infinite;
            -moz-animation: spin 4s linear infinite;
            animation: spin 4s linear infinite;
        }

        @-moz-keyframes spin {
            100% {
                -moz-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spin {
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center py-4">
        <div class="container-tight py-6">
            <div class="text-center mb-4">
                <a href="."><img src="{{ asset('static/logo.svg') }}" height="36" alt=""></a>
            </div>
            <form class="card card-md needs-validation form-prevent-multiple-submits" method="POST"
                action="{{ route('login') }}" autocomplete="off">
                @csrf
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Login to your account</h2>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            tabindex="1" autofocus value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="mb-2" style="font-size: 85.7142857%; color: #e53e3e;margin-top:-10px !important">{{ $message }}</div>
                    @enderror

                    <div class="mb-2">
                        <label class="form-label">
                            <label class="form-label">Password</label>
                        </label>

                        <div class="input-group input-group-flat">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                tabindex="2" required>
                            <span class="input-group-text">
                                <a href="#" class="link-secondary" title="Show password" data-toggle="tooltip"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="12" cy="12" r="2" />
                                        <path
                                            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                    </svg>
                                </a>
                            </span>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-check">
                            <input type="checkbox" class="form-check-input" {{ old('remember') ? 'checked': '' }}/>
                            <span class="form-check-label">Remember me on this device</span>
                        </label>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100 button-prevent-multiple-submits">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon spinner" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="6" x2="12" y2="3" />
                                <line x1="16.25" y1="7.75" x2="18.4" y2="5.6" />
                                <line x1="18" y1="12" x2="21" y2="12" />
                                <line x1="16.25" y1="16.25" x2="18.4" y2="18.4" />
                                <line x1="12" y1="18" x2="12" y2="21" />
                                <line x1="7.75" y1="16.25" x2="5.6" y2="18.4" />
                                <line x1="6" y1="12" x2="3" y2="12" />
                                <line x1="7.75" y1="7.75" x2="5.6" y2="5.6" /></svg>
                            Sign in
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Libs JS -->
    <script src="{{ asset('js/tooltip.js') }}"></script>
    <script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script>
        document.body.style.display = "block";
    </script>
    <script>
        $('.form-prevent-multiple-submits').on('submit', function() {
            $('.button-prevent-multiple-submits').attr('disabled', true);
            $('.button-prevent-multiple-submits .spinner').show();
        });
    </script>
</body>

</html>