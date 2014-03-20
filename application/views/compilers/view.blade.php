<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('compilers')}}">Compilers</a> 
		</li>
		<li class="active">Viewing Compiler</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Name:</strong>
	{{$compiler->name}}
</p>
<p>
	<strong>Nickname:</strong>
	{{$compiler->nickname}}
</p>
<p>
	<strong>Note:</strong>
	{{$compiler->note}}
</p>

<p><a href="{{URL::to('compilers/edit/'.$compiler->id)}}" class="btn btn-default">Edit</a> <a href="{{URL::to('compilers/delete/'.$compiler->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></p>
