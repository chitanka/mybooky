<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>{{$title}}</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<link href="{{asset('select2-3.4.5/select2.css')}}" rel="stylesheet">
	<style>
		body { margin: 40px; }
	</style>
</head>
<body>
	<div class="container">
		<div class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">MyBooky</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li>{{ HTML::link('books', __('admin.title_books_index')) }}</li>
						<li>{{ HTML::link('contents', __('admin.title_contents_index')) }}</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Личности <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ HTML::link('authors', __('admin.title_authors_index')) }}</li>
								<li>{{ HTML::link('translators', __('admin.title_translators_index')) }}</li>
								<li>{{ HTML::link('compilers', __('admin.title_compilers_index')) }}</li>
								<li>{{ HTML::link('illustrators', __('admin.title_illustrators_index')) }}</li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Издатели <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ HTML::link('publishers', __('admin.title_publishers_index')) }}</li>
								<li>{{ HTML::link('printhouses', __('admin.title_printhouses_index')) }}</li>
								<li>{{ HTML::link('sequences', __('admin.title_sequences_index')) }}</li>
								<li>{{ HTML::link('themes', __('admin.title_themes_index')) }}</li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Допълнителни <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ HTML::link('sequences', __('admin.title_sequences_index')) }}</li>
								<li>{{ HTML::link('themes', __('admin.title_themes_index')) }}</li>
								<li>{{ HTML::link('languages', __('admin.title_languages_index')) }}</li>
							</ul>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div><!--/.container-fluid -->
		</div>

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
