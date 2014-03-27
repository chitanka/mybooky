<script>
jQuery(function($) {
	var nextContentIndex = {{ $nextContentIndex }};
	$("#new-content-button").click(function() {
		var newForm = $("#content-form-template").html();
		newForm = newForm.replace(/NEXT_INDEX/g, nextContentIndex);
		$("#content-form-template").parent().append(newForm);
		$('#content_'+nextContentIndex)
			.find(':input[name$="[idx]"]').val(nextContentIndex).end()
			.find(".select2-container").remove().end()
			.find("select").select2().end();
		nextContentIndex++;
	});
});
</script>
