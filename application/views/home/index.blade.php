<!doctype html>
<html lang="bg">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>MyBooky</title>
	<link rel="stylesheet" type="text/css" href="{{asset('bundles/scaffold/css/bootstrap.css')}}">
</head>
<body>
	<div class="container">
		<h1>MyBooky</h1>
		<ul>
			<li>{{ HTML::link('books', __('admin.title_books_index')) }}</li>
			<li>{{ HTML::link('contents', __('admin.title_contents_index')) }}</li>
		</ul>
		Личности
		<ul>
			<li>{{ HTML::link('authors', __('admin.title_authors_index')) }}</li>
			<li>{{ HTML::link('translators', __('admin.title_translators_index')) }}</li>
			<li>{{ HTML::link('compilers', __('admin.title_compilers_index')) }}</li>
			<li>{{ HTML::link('illustrators', __('admin.title_illustrators_index')) }}</li>
		</ul>
		Издатели
		<ul>
			<li>{{ HTML::link('publishers', __('admin.title_publishers_index')) }}</li>
			<li>{{ HTML::link('printhouses', __('admin.title_printhouses_index')) }}</li>
			<li>{{ HTML::link('sequences', __('admin.title_sequences_index')) }}</li>
			<li>{{ HTML::link('themes', __('admin.title_themes_index')) }}</li>
		</ul>
		Допълнителни
		<ul>
			<li>{{ HTML::link('sequences', __('admin.title_sequences_index')) }}</li>
			<li>{{ HTML::link('themes', __('admin.title_themes_index')) }}</li>
			<li>{{ HTML::link('languages', __('admin.title_languages_index')) }}</li>
		</ul>
	</div>
</body>
</html>
