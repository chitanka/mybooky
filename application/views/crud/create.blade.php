<div class="span16">
	<ul class="breadcrumb">
		<li>
			<a href="{{URL::to($key)}}">{{ __('admin.title_'.$key.'_index') }}</a>
		</li>
		<li class="active">{{ __('admin.title_'.$key.'_create') }}</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => '', 'role' => 'form'))}}
	<fieldset>
		@foreach($fields as $field)
		<div class="form-group">
			{{Form::label($field, __('admin.field_'.$field))}}
			{{Form::text($field, Input::old($field), array('class' => 'form-control'))}}
		</div>
		@endforeach

		<div class="actions">
			{{Form::submit(__('admin.action_save'), array('class' => 'btn btn-primary'))}}
			<a href="{{URL::to(Request::referrer())}}">{{ __('admin.action_cancel') }}</a>
		</div>
	</fieldset>
{{Form::close()}}
