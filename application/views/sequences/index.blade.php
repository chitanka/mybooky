@if(count($sequences) == 0)
	<p>No sequences.</p>
@else
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($sequences as $sequence)
				<tr>
					<td>{{$sequence->name}}</td>
					<td>
						<a href="{{URL::to('sequences/view/'.$sequence->id)}}" class="btn btn-default">View</a>
						<a href="{{URL::to('sequences/edit/'.$sequence->id)}}" class="btn btn-default">Edit</a>
						<a href="{{URL::to('sequences/delete/'.$sequence->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn btn-success" href="{{URL::to('sequences/create')}}">Create new Sequence</a></p>