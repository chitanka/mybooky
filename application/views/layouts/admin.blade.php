@layout('layouts.base')

@section('title')
	{{ $title }}
@endsection

@section('stylesheets')
	@parent
	<link href="{{ asset('select2-3.4.5/select2.css') }}" rel="stylesheet">
	<link href="{{ asset('select2-3.4.5/select2-bootstrap.css') }}" rel="stylesheet">
@endsection

@section('content')
			<h1>{{ $title }}</h1>
			<hr>

			@if (Session::has('message'))
				<div class="alert alert-success">
					<p>{{ Session::get('message') }}</p>
				</div>
			@endif

			@if($errors->has())
				<div class="alert alert-danger">
					@foreach($errors->all('<p>:message</p>') as $error)
						{{ $error }}
					@endforeach
				</div>
			@endif
			{{ $content }}
@endsection

@section('scripts')
	@parent
	<script src="{{ asset('select2-3.4.5/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('select').select2();
		});
	</script>
@endsection
