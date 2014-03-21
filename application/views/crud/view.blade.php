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
				@forelse($object->$field as $subfield)
					<li>{{ $subfield }}</li>
				@empty
					<li>&nbsp;</li>
				@endforelse
				</ul>
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
