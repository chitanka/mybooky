@if(count($objects) == 0)
	<p class="no-items">{{ __('admin.'.$key.'_message_empty') }}</p>
@else
	{{ $pagination }}
	<table class="table table-striped table-condensed">
		<thead>
			<tr>
				@foreach($fields as $field => $options)
				@if( $options['index'] )
					<th>{{ __('admin.field_'.$field) }}</th>
				@endif
				@endforeach
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($objects as $object)
				<tr>
					@foreach($fields as $field => $options)
					@if( $options['index'] )
						<td>
							@if( is_array($object->$field) )
								<ul class="list-inline">
								@foreach($object->$field as $relObject)
									<li><a href="{{ URL::to($field.'/view/'.$relObject->id) }}">{{ $relObject }}</a></li>
								@endforeach
								</ul>
							@elseif ( is_object($object->$field) )
								<a href="{{ URL::to($field.'s/view/'.$object->$field->id) }}">{{ $object->$field }}</a>
							@elseif ( $options['view_link'] )
								<a href="{{ URL::to($key.'/view/'.$object->id) }}">{{ $object->$field }}</a>
							@else
								{{ $object->$field }}
							@endif
						</td>
					@endif
					@endforeach
					<td>
						<a href="{{ URL::to($key.'/view/'.$object->id) }}" class="btn btn-default btn-xs" title="{{ __('admin.action_view') }}"><span class="glyphicon glyphicon-search"></span></a>
						<a href="{{ URL::to($key.'/edit/'.$object->id) }}" class="btn btn-default btn-xs" title="{{ __('admin.action_edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="{{ URL::to($key.'/delete/'.$object->id) }}" class="delete btn btn-danger btn-xs" onclick="return confirm('{{ __('admin.action_delete_confirm') }}')" title="{{ __('admin.action_delete') }}"><span class="glyphicon glyphicon-remove"></span></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p>
	<a class="btn btn-success" href="{{ URL::to($key.'/create') }}"><span class="glyphicon glyphicon-plus"></span> {{ __('admin.'.$key.'_action_create') }}</a>
</p>
