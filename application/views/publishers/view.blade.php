<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('publishers')}}">Publishers</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Publisher</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Name:</strong>
	{{$publisher->name}}
</p>

<p><a href="{{URL::to('publishers/edit/'.$publisher->id)}}" class="btn">Edit</a> <a href="{{URL::to('publishers/delete/'.$publisher->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
