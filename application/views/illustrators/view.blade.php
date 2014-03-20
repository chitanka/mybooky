<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('illustrators')}}">Illustrators</a> 
		</li>
		<li class="active">Viewing Illustrator</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Name:</strong>
	{{$illustrator->name}}
</p>
<p>
	<strong>Nickname:</strong>
	{{$illustrator->nickname}}
</p>
<p>
	<strong>Note:</strong>
	{{$illustrator->note}}
</p>

<p><a href="{{URL::to('illustrators/edit/'.$illustrator->id)}}" class="btn btn-default">Edit</a> <a href="{{URL::to('illustrators/delete/'.$illustrator->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></p>
