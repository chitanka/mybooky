@if(count($publishers) == 0)
	<p>No publishers.</p>
@else
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($publishers as $publisher)
				<tr>
					<td>{{$publisher->name}}</td>
					<td>
						<a href="{{URL::to('publishers/view/'.$publisher->id)}}" class="btn btn-default">View</a>
						<a href="{{URL::to('publishers/edit/'.$publisher->id)}}" class="btn btn-default">Edit</a>
						<a href="{{URL::to('publishers/delete/'.$publisher->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn btn-success" href="{{URL::to('publishers/create')}}">Create new Publisher</a></p>