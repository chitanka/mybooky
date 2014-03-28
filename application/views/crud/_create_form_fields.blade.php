	@foreach($fields as $field => $options)
	@if( $options['create'] )
		<div class="form-group">
			@if ( $options['type'] != 'hidden' )
				{{ Form::label($options['name'], __('admin.field_'.$options['label']), array('class' => 'col-sm-2 control-label')) }}
			@endif
			<div class="col-sm-10">
			@if( $options['type'] == 'textarea' )
				{{ Form::textarea($options['name'], Input::old($field), array('class' => 'form-control')) }}
			@elseif ( $options['type'] == 'hidden' )
				{{ Form::hidden($options['name'], Input::old($field), array('class' => 'form-control')) }}
			@elseif ( $options['type'] == 'select' )
				{{ Form::select($options['name'].($options['multiple'] ? '[]' : ''), $options['choices'], Input::old($field), array('class' => 'form-control', 'placeholder' => 'Избор') + ($options['multiple'] ? array('multiple') : array())) }}
			@else
				{{ Form::text($options['name'], Input::old($field), array('class' => 'form-control')) }}
			@endif
			</div>
		</div>
	@endif
	@endforeach
