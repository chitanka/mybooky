<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('books')}}">Books</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('contents')}}">Contents</a> <span class="divider">/</span>
		</li>
		<li class="active">New Content</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('book', 'Book')}}

			<div class="input">
				{{Form::select('book', $bookOptions, Input::old('book', $book), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('idx', 'Idx')}}

			<div class="input">
				{{Form::text('idx', Input::old('idx'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('title', 'Title')}}

			<div class="input">
				{{Form::text('title', Input::old('title'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('note', 'Note')}}

			<div class="input">
				{{Form::text('note', Input::old('note'), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}