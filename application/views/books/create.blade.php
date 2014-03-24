@include('crud._create_form_breadcrumbs')

<ul class="nav nav-tabs">
	<li class="active"><a href="#main" data-toggle="tab">Основни данни</a></li>
	<li><a href="#contents" data-toggle="tab">Съдържание</a></li>
</ul>

{{ Form::open(null, 'post', array('class' => 'form-horizontal', 'role' => 'form')) }}
<div class="tab-content" style="padding: 1em 0">
	<div class="tab-pane active" id="main">
		@include('crud._create_form_fields')
	</div>
	<div class="tab-pane" id="contents">
		Съдържание
	</div>
	@include('crud._create_form_submit')
</div>
{{ Form::close() }}
