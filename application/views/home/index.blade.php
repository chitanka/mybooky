<!doctype html>
<html lang="bg">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>MyBooky</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<style>
		body { margin: 1em; }
	</style>
</head>
<body>
	<div class="container">
		<?php echo render('navbar') ?>
		<p>Привет!</p>
	</div>
	<script src="{{asset('js/jquery-1.11.0.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
