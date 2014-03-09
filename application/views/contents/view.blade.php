<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('books/view/'.$content->book->id)}}">Book</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('contents')}}">Contents</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Content</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Book id:</strong>
	{{$content->book_id}}
</p>
<p>
	<strong>Idx:</strong>
	{{$content->idx}}
</p>
<p>
	<strong>Title:</strong>
	{{$content->title}}
</p>
<p>
	<strong>Note:</strong>
	{{$content->note}}
</p>

<p><a href="{{URL::to('contents/edit/'.$content->id)}}" class="btn">Edit</a> <a href="{{URL::to('contents/delete/'.$content->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
<h2>Themes</h2>

@if(count($content->themes) == 0)
	<p>No themes.</p>
@else
	<table>
		<thead>
			<th>Name</th>
			<th></th>
		</thead>

		<tbody>
			@foreach($content->themes as $theme)
				<tr>
					<td>{{$theme->name}}</td>
					<td><a href="{{URL::to('themes/view/'.$theme->id)}}">View</a> <a href="{{URL::to('themes/edit/'.$theme->id)}}">Edit</a> <a href="{{URL::to('themes/delete/'.$theme->id)}}">Delete</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('themes/create/'.$content->id)}}">Create new theme</a></p>
