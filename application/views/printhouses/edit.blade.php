<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('printhouses')}}">Printhouses</a> 
		</li>
		<li class="active">Editing Printhouse</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('name', 'Name')}}

			<div class="input">
				{{Form::text('name', Input::old('name', $printhouse->name), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn btn-primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}