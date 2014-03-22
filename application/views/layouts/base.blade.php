<!DOCTYPE html>
<html lang="bg">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>
		@section('title')
			{{ Config::get('application.sitename') }}
		@endsection
		@yield('title')
	</title>
	@section('stylesheets')
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
		<style>
			body { margin: 1em; }
		</style>
	@endsection
	@yield('stylesheets')
</head>
<body>
	<div class="container">
		@section('navbar')
			<?php echo render('navbar') ?>
		@endsection
		@yield('navbar')
		@yield('content')
	</div>
	@section('scripts')
		<script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	@endsection
	@yield('scripts')
</body>
</html>
