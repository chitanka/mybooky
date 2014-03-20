@if(count($illustrators) == 0)
	<p>No illustrators.</p>
@else
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Nickname</th>
				<th>Note</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($illustrators as $illustrator)
				<tr>
					<td>{{$illustrator->name}}</td>
					<td>{{$illustrator->nickname}}</td>
					<td>{{$illustrator->note}}</td>
					<td>
						<a href="{{URL::to('illustrators/view/'.$illustrator->id)}}" class="btn btn-default">View</a>
						<a href="{{URL::to('illustrators/edit/'.$illustrator->id)}}" class="btn btn-default">Edit</a>
						<a href="{{URL::to('illustrators/delete/'.$illustrator->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn btn-success" href="{{URL::to('illustrators/create')}}">Create new Illustrator</a></p>