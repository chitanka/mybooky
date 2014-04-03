<div class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ URL::home() }}">{{ Config::get('application.sitename') }}</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
			@foreach(Config::get('application.menu') as $title => $item)
				@if( is_array($item) )
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ __('admin.'.$title.'_title_index') }} <b class="caret"></b></a>
						<ul class="dropdown-menu">
						@foreach($item as $subitem)
							<li>{{ HTML::link($subitem, __('admin.'.$subitem.'_title_index')) }}</li>
						@endforeach
						</ul>
					</li>
				@else
					<li>{{ HTML::link($item, __('admin.'.$item.'_title_index')) }}</li>
				@endif
			@endforeach
			</ul>
		</div><!--/.nav-collapse -->

	</div><!--/.container-fluid -->
</div>
