@if(count($books) == 0)
	<p>No books.</p>
@else
	<table>
		<thead>
			<tr>
				<th>Title</th>
				<th>Edition</th>
				<th>Pub Date</th>
				<th>Volume</th>
				<th>Pages</th>
				<th>Seq Num</th>
				<th>Note</th>
				<th>Themes</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($books as $book)
				<tr>
					<td>{{$book->title}}</td>
					<td>{{$book->edition}}</td>
					<td>{{$book->pub_date}}</td>
					<td>{{$book->volume}}</td>
					<td>{{$book->pages}}</td>
					<td>{{$book->seq_num}}</td>
					<td>{{$book->note}}</td>
					<td>{{count($book->themes)}}</td>
					<td>
						<a href="{{URL::to('books/view/'.$book->id)}}" class="btn">View</a>
						<a href="{{URL::to('books/edit/'.$book->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('books/delete/'.$book->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('books/create')}}">Create new Book</a></p>