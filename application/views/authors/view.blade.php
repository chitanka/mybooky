<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('authors')}}">Authors</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Author</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Name:</strong>
	{{$author->name}}
</p>
<p>
	<strong>Nickname:</strong>
	{{$author->nickname}}
</p>
<p>
	<strong>Note:</strong>
	{{$author->note}}
</p>

<p><a href="{{URL::to('authors/edit/'.$author->id)}}" class="btn">Edit</a> <a href="{{URL::to('authors/delete/'.$author->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
