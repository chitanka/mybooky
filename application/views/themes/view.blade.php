<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('themes')}}">Themes</a> 
		</li>
		<li class="active">Viewing Theme</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Name:</strong>
	{{$theme->name}}
</p>

<p><a href="{{URL::to('themes/edit/'.$theme->id)}}" class="btn btn-default">Edit</a> <a href="{{URL::to('themes/delete/'.$theme->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></p>
