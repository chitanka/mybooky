<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('books/view/'.$object->book->id)}}">Book</a>
		</li>
		<li>
			<a href="{{URL::to('contents')}}">Contents</a>
		</li>
		<li class="active">Viewing Content</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Book id:</strong>
	{{$object->book_id}}
</p>
<p>
	<strong>Idx:</strong>
	{{$object->idx}}
</p>
<p>
	<strong>Title:</strong>
	{{$object->title}}
</p>
<p>
	<strong>Note:</strong>
	{{$object->note}}
</p>

<p><a href="{{URL::to('contents/edit/'.$object->id)}}" class="btn btn-default">Edit</a> <a href="{{URL::to('contents/delete/'.$object->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></p>
<h2>Themes</h2>

@if(count($object->themes) == 0)
	<p>No themes.</p>
@else
	<table class="table table-striped">
		<thead>
			<th>Name</th>
			<th></th>
		</thead>

		<tbody>
			@foreach($object->themes as $theme)
				<tr>
					<td>{{$theme->name}}</td>
					<td><a href="{{URL::to('themes/view/'.$theme->id)}}">View</a> <a href="{{URL::to('themes/edit/'.$theme->id)}}">Edit</a> <a href="{{URL::to('themes/delete/'.$theme->id)}}">Delete</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn btn-success" href="{{URL::to('themes/create/'.$object->id)}}">Create new theme</a></p>
