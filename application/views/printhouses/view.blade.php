<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('printhouses')}}">Printhouses</a> 
		</li>
		<li class="active">Viewing Printhouse</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Name:</strong>
	{{$printhouse->name}}
</p>

<p><a href="{{URL::to('printhouses/edit/'.$printhouse->id)}}" class="btn btn-default">Edit</a> <a href="{{URL::to('printhouses/delete/'.$printhouse->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></p>
