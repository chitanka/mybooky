<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('translators')}}">Translators</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Translator</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Name:</strong>
	{{$translator->name}}
</p>
<p>
	<strong>Nickname:</strong>
	{{$translator->nickname}}
</p>
<p>
	<strong>Note:</strong>
	{{$translator->note}}
</p>

<p><a href="{{URL::to('translators/edit/'.$translator->id)}}" class="btn">Edit</a> <a href="{{URL::to('translators/delete/'.$translator->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
