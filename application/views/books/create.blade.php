<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('books')}}">{{__('admin.title_books_index')}}</a> <span class="divider">/</span>
		</li>
		<li class="active">{{__('admin.title_books_create')}}</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('title', 'Title')}}

			<div class="input">
				{{Form::text('title', Input::old('title'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('edition', 'Edition')}}

			<div class="input">
				{{Form::text('edition', Input::old('edition'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('pub_date', 'Pub Date')}}

			<div class="input">
				{{Form::text('pub_date', Input::old('pub_date'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('volume', 'Volume')}}

			<div class="input">
				{{Form::text('volume', Input::old('volume'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('pages', 'Pages')}}

			<div class="input">
				{{Form::text('pages', Input::old('pages'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('seq_num', 'Seq Num')}}

			<div class="input">
				{{Form::text('seq_num', Input::old('seq_num'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('note', 'Note')}}

			<div class="input">
				{{Form::text('note', Input::old('note'), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="clearfix">
			{{Form::label('themes', 'Themes')}}

			<div class="input">
				{{Form::select('themes[]', $themeOptions, Input::old('themes'), array('multiple', 'class' => 'span6 themes', 'placeholder' => 'Избор'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}