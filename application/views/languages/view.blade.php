<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('languages')}}">Languages</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Language</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Name:</strong>
	{{$language->name}}
</p>

<p><a href="{{URL::to('languages/edit/'.$language->id)}}" class="btn">Edit</a> <a href="{{URL::to('languages/delete/'.$language->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
