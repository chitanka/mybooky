@if(count($authors) == 0)
	<p>No authors.</p>
@else
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Nickname</th>
				<th>Note</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($authors as $author)
				<tr>
					<td>{{$author->name}}</td>
					<td>{{$author->nickname}}</td>
					<td>{{$author->note}}</td>
					<td>
						<a href="{{URL::to('authors/view/'.$author->id)}}" class="btn">View</a>
						<a href="{{URL::to('authors/edit/'.$author->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('authors/delete/'.$author->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('authors/create')}}">Create new Author</a></p>