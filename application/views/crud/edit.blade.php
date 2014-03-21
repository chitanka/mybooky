<ul class="breadcrumb">
	<li>
		<a href="{{ URL::to($key) }}">{{ __('admin.'.$key.'_title_index') }}</a>
	</li>
	<li class="active">{{ __('admin.'.$key.'_title_edit', array('name' => $object)) }}</li>
</ul>

{{ Form::open(null, 'post', array('class' => 'form-horizontal', 'role' => 'form')) }}
	@foreach($fields as $field => $options)
		<div class="form-group">
			<label for="{{ $field }}" class="col-sm-2 control-label">{{ __('admin.field_'.$field) }}</label>
			<div class="col-sm-10">
			@if( $options['type'] == 'textarea' )
				{{ Form::textarea($field, Input::old($field, $object->$field), array('class' => 'form-control')) }}
			@elseif ( $options['type'] == 'hidden' )
				{{ Form::hidden($field, Input::old($field, $object->$field), array('class' => 'form-control')) }}
			@elseif ( $options['type'] == 'select' )
				{{ Form::select($field.($options['multiple'] ? '[]' : ''), $options['choices'], Input::old($field, $object->$field()->lists('id')), array('class' => 'form-control', 'placeholder' => 'Избор') + ($options['multiple'] ? array('multiple') : array())) }}
			@else
				{{ Form::text($field, Input::old($field, $object->$field), array('class' => 'form-control')) }}
			@endif
			</div>
		</div>
	@endforeach

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			{{ Form::submit(__('admin.action_save'), array('class' => 'btn btn-primary')) }}
			<a class="pull-right btn btn-default" href="{{ URL::to(Request::referrer()) }}">{{ __('admin.action_cancel') }}</a>
		</div>
	</div>
{{ Form::close() }}
