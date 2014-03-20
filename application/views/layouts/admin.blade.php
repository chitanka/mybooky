<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>{{$title}}</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<link href="{{asset('select2-3.4.5/select2.css')}}" rel="stylesheet">
	<style>
		body { margin: 1em; }
	</style>
</head>
<body>
	<div class="container">
		<?php echo render('navbar') ?>
		<div class="row">
			<div class="span16">
				<h1>{{$title}}</h1>
				<hr>

				@if (Session::has('message'))
					<div class="alert-message success">
						<p>{{Session::get('message')}}</p>
					</div>
				@endif

				@if($errors->has())
					<div class="alert-message error">
						@foreach($errors->all('<p>:message</p>') as $error)
							{{$error}}
						@endforeach
					</div>
				@endif
			</div>
			<div class="span16">
				{{$content}}
			</div>
		</div>
	</div>
	<script src="{{asset('js/jquery-1.11.0.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('select2-3.4.5/select2.min.js')}}"></script>
	<script>
		$(document).ready(function() {
			$('select').select2();
		});
	</script>
</body>
</html>
