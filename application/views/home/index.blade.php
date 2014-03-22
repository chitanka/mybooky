@layout('layouts.base')

@section('navbar')
@endsection

@section('content')

	<h1>{{ Config::get('application.sitename') }}</h1>
	@foreach($menu as $title => $item)
		@if( is_array($item) )
			<div class="panel panel-default">
				<div class="panel-heading">{{ __('admin.'.$title.'_title_index') }}</div>
				<ul class="list-group">
				@foreach($item as $subitem)
					<li class="list-group-item">
						<div class="btn-group">
							<a href="{{ URL::to($subitem) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-list"></span> {{ __('admin.'.$subitem.'_title_index') }}</a>
							<a href="{{ URL::to($subitem.'/create') }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> {{ __('admin.'.$subitem.'_title_create') }}</a>
						</div>
					</li>
				@endforeach
				</ul>
			</div>
		@else
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="btn-group">
						<a href="{{ URL::to($item) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-list"></span> {{ __('admin.'.$item.'_title_index') }}</a>
						<a href="{{ URL::to($item.'/create') }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> {{ __('admin.'.$item.'_title_create') }}</a>
					</div>
				</div>
			</div>
		@endif
	@endforeach

@endsection
