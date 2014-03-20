@if(count($printhouses) == 0)
	<p>No printhouses.</p>
@else
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($printhouses as $printhouse)
				<tr>
					<td>{{$printhouse->name}}</td>
					<td>
						<a href="{{URL::to('printhouses/view/'.$printhouse->id)}}" class="btn btn-default">View</a>
						<a href="{{URL::to('printhouses/edit/'.$printhouse->id)}}" class="btn btn-default">Edit</a>
						<a href="{{URL::to('printhouses/delete/'.$printhouse->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn btn-success" href="{{URL::to('printhouses/create')}}">Create new Printhouse</a></p>