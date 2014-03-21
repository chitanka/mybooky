<div class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ URL::home() }}">MyBooky</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li>{{ HTML::link('books', __('admin.books_title_index')) }}</li>
				<li>{{ HTML::link('contents', __('admin.contents_title_index')) }}</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Личности <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>{{ HTML::link('authors', __('admin.authors_title_index')) }}</li>
						<li>{{ HTML::link('translators', __('admin.translators_title_index')) }}</li>
						<li>{{ HTML::link('compilers', __('admin.compilers_title_index')) }}</li>
						<li>{{ HTML::link('illustrators', __('admin.illustrators_title_index')) }}</li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Издатели <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>{{ HTML::link('publishers', __('admin.publishers_title_index')) }}</li>
						<li>{{ HTML::link('printhouses', __('admin.printhouses_title_index')) }}</li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Допълнителни <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>{{ HTML::link('sequences', __('admin.sequences_title_index')) }}</li>
						<li>{{ HTML::link('themes', __('admin.themes_title_index')) }}</li>
						<li>{{ HTML::link('languages', __('admin.languages_title_index')) }}</li>
					</ul>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</div>
