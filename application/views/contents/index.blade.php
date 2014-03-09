@if(count($contents) == 0)
	<p>No contents.</p>
@else
	<table>
		<thead>
			<tr>
				<th>Book Id</th>
				<th>Idx</th>
				<th>Title</th>
				<th>Note</th>
				<th>Themes</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($contents as $content)
				<tr>
					<td><a href="{{URL::to('books/view/'.$content->id)}}">Book #{{$content->book_id}}</a></td>
					<td>{{$content->idx}}</td>
					<td>{{$content->title}}</td>
					<td>{{$content->note}}</td>
					<td>{{count($content->themes)}}</td>
					<td>
						<a href="{{URL::to('contents/view/'.$content->id)}}" class="btn">View</a>
						<a href="{{URL::to('contents/edit/'.$content->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('contents/delete/'.$content->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('contents/create')}}">Create new Content</a></p>