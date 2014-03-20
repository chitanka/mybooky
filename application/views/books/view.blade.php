<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('books')}}">Books</a> 
		</li>
		<li class="active">Viewing Book</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Title:</strong>
	{{$book->title}}
</p>
<p>
	<strong>Edition:</strong>
	{{$book->edition}}
</p>
<p>
	<strong>Pub date:</strong>
	{{$book->pub_date}}
</p>
<p>
	<strong>Volume:</strong>
	{{$book->volume}}
</p>
<p>
	<strong>Pages:</strong>
	{{$book->pages}}
</p>
<p>
	<strong>Seq num:</strong>
	{{$book->seq_num}}
</p>
<p>
	<strong>Note:</strong>
	{{$book->note}}
</p>

<p><a href="{{URL::to('books/edit/'.$book->id)}}" class="btn btn-default">Edit</a> <a href="{{URL::to('books/delete/'.$book->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></p>
<h2>{{ __('admin.themes') }}</h2>

@if(count($book->themes) == 0)
	<p>No themes.</p>
@else
	<table class="table table-striped">
		<thead>
			<th>Name</th>
			<th></th>
		</thead>

		<tbody>
			@foreach($book->themes as $theme)
				<tr>
					<td>{{$theme->name}}</td>
					<td><a href="{{URL::to('themes/view/'.$theme->id)}}">View</a> <a href="{{URL::to('themes/edit/'.$theme->id)}}">Edit</a> <a href="{{URL::to('themes/delete/'.$theme->id)}}">Delete</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn btn-success" href="{{URL::to('themes/create/'.$book->id)}}">Create new theme</a></p>
