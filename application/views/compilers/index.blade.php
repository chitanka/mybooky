@if(count($compilers) == 0)
	<p>No compilers.</p>
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
			@foreach($compilers as $compiler)
				<tr>
					<td>{{$compiler->name}}</td>
					<td>{{$compiler->nickname}}</td>
					<td>{{$compiler->note}}</td>
					<td>
						<a href="{{URL::to('compilers/view/'.$compiler->id)}}" class="btn">View</a>
						<a href="{{URL::to('compilers/edit/'.$compiler->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('compilers/delete/'.$compiler->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('compilers/create')}}">Create new Compiler</a></p>