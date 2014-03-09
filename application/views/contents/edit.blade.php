<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('books/view/'.$content->book->id)}}">Book</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('contents')}}">Contents</a> <span class="divider">/</span>
		</li>
		<li class="active">Editing Content</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('book_id', 'Book Id')}}

			<div class="input">
				{{Form::text('book_id', Input::old('book_id', $content->book_id), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('idx', 'Idx')}}

			<div class="input">
				{{Form::text('idx', Input::old('idx', $content->idx), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('title', 'Title')}}

			<div class="input">
				{{Form::text('title', Input::old('title', $content->title), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('note', 'Note')}}

			<div class="input">
				{{Form::text('note', Input::old('note', $content->note), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}