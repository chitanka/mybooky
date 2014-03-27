<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $content->id }}">
				{{ $content->idx }}. {{ $content->title }}
			</a>
		</h4>
	</div>
	<div id="collapse{{ $content->id }}" class="panel-collapse collapse">
		<div class="panel-body">
			@render('crud._edit_form_fields', array('object' => $content, 'fields' => $fields))
		</div>
	</div>
</div>
