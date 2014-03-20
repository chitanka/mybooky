<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('authors')}}">Authors</a> 
		</li>
		<li class="active">New Author</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('name', 'Name')}}

			<div class="input">
				{{Form::text('name', Input::old('name'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('nickname', 'Nickname')}}

			<div class="input">
				{{Form::text('nickname', Input::old('nickname'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('note', 'Note')}}

			<div class="input">
				{{Form::text('note', Input::old('note'), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn btn-primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}