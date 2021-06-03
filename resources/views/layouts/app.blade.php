<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
	<!-- CSS files -->
	@stack('before-style')
	@include('includes.styles')
	@stack('after-style')
</head>

<body class="antialiased">
	@include('layouts.aside')
	<div class="page">
		@include('layouts.header')
		<div class="content">
			<div class="container-xl">
				@yield('content')
			</div>
			@include('layouts.footer')
		</div>
	</div>

	{{-- Modal Logout --}}
	<div class="modal modal-blur fade" id="modal-logout" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="modal-title">Are you sure?</div>
					<div>You will logout from the application.</div>
				</div>
				<div class="modal-footer d-flex align-items-center">
					<button type="button" class="btn btn-link link-secondary mr-auto"
							data-dismiss="modal">Cancel</button>
					<form action="{{ route('logout') }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-danger">Yes, log me out</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	@include('includes.modal_info')
	<!-- JS files -->
	@stack('before-script')
	@include('includes.scripts')
	@stack('after-script')
</body>

</html>