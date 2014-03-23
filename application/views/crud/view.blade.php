<ul class="breadcrumb">
	<li>
		<a href="{{ URL::to($key) }}">{{ __('admin.'.$key.'_title_index') }}</a>
	</li>
	<li class="active">{{ __('admin.'.$key.'_title_view', array('name' => $object)) }}</li>
</ul>


<dl class="dl-horizontal">
	@foreach($fields as $field)
		<dt>{{ __('admin.field_'.$field) }}</dt>
		<dd>
			@if( is_array($object->$field) )
				<ul class="list-inline">
				@forelse($object->$field as $relObject)
					<li><a href="{{ URL::to($field.'/view/'.$relObject->id) }}">{{ $relObject }}</a></li>
				@empty
					<li>&nbsp;</li>
				@endforelse
				</ul>
			@elseif ( is_object($object->$field) )
				<a href="{{ URL::to($field.'s/view/'.$object->$field->id) }}">{{ $object->$field }}</a>
			@else
				{{ $object->$field }}&nbsp;
			@endif
		</dd>
	@endforeach
</dl>

<p>
	<a href="{{ URL::to($key.'/edit/'.$object->id) }}" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> {{ __('admin.action_edit') }}</a>
	<a href="{{ URL::to($key.'/delete/'.$object->id) }}" class="pull-right btn btn-danger" onclick="return confirm('{{ __('admin.action_delete_confirm') }}')"><span class="glyphicon glyphicon-remove"></span> {{ __('admin.action_delete') }}</a>
</p>
