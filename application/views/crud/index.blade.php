@if(count($objects) == 0)
	<p class="no-items">{{ __('admin.message_'.$key.'_empty') }}</p>
@else
	<table class="table table-striped table-condensed">
		<thead>
			<tr>
				@foreach($fields as $field)
				<th>{{__('admin.field_'.$field)}}</th>
				@endforeach
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($objects as $object)
				<tr>
					@foreach($fields as $field)
					<td>{{$object->$field}}</td>
					@endforeach
					<td>
						<a href="{{URL::to($key.'/view/'.$object->id)}}" class="btn btn-default btn-sm">{{ __('admin.action_view') }}</a>
						<a href="{{URL::to($key.'/edit/'.$object->id)}}" class="btn btn-default btn-sm">{{ __('admin.action_edit') }}</a>
						<a href="{{URL::to($key.'/delete/'.$object->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('admin.action_delete_confirm') }}')">{{ __('admin.action_delete') }}</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn btn-success" href="{{URL::to($key.'/create')}}">{{ __('admin.action_create_'.$key) }}</a></p>
