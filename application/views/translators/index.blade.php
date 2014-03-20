@if(count($translators) == 0)
	<p>No translators.</p>
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
			@foreach($translators as $translator)
				<tr>
					<td>{{$translator->name}}</td>
					<td>{{$translator->nickname}}</td>
					<td>{{$translator->note}}</td>
					<td>
						<a href="{{URL::to('translators/view/'.$translator->id)}}" class="btn btn-default">View</a>
						<a href="{{URL::to('translators/edit/'.$translator->id)}}" class="btn btn-default">Edit</a>
						<a href="{{URL::to('translators/delete/'.$translator->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn btn-success" href="{{URL::to('translators/create')}}">Create new Translator</a></p>