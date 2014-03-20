<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('sequences')}}">Sequences</a> 
		</li>
		<li class="active">Viewing Sequence</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Name:</strong>
	{{$sequence->name}}
</p>

<p><a href="{{URL::to('sequences/edit/'.$sequence->id)}}" class="btn btn-default">Edit</a> <a href="{{URL::to('sequences/delete/'.$sequence->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></p>
