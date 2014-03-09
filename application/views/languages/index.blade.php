@if(count($languages) == 0)
	<p>No languages.</p>
@else
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($languages as $language)
				<tr>
					<td>{{$language->name}}</td>
					<td>
						<a href="{{URL::to('languages/view/'.$language->id)}}" class="btn">View</a>
						<a href="{{URL::to('languages/edit/'.$language->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('languages/delete/'.$language->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('languages/create')}}">Create new Language</a></p>