@if(count($themes) == 0)
	<p>No themes.</p>
@else
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($themes as $theme)
				<tr>
					<td>{{$theme->name}}</td>
					<td>
						<a href="{{URL::to('themes/view/'.$theme->id)}}" class="btn btn-default">View</a>
						<a href="{{URL::to('themes/edit/'.$theme->id)}}" class="btn btn-default">Edit</a>
						<a href="{{URL::to('themes/delete/'.$theme->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn btn-success" href="{{URL::to('themes/create')}}">Create new Theme</a></p>