	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key }}">
					Заглавие {{ $key+1 }}
				</a>
			</h4>
		</div>
		<div id="collapse{{ $key }}" class="panel-collapse collapse">
			<div class="panel-body">
				@render('crud._create_form_fields', array('fields' => $fields))
			</div>
		</div>
	</div>
