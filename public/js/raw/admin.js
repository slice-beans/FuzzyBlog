;(function($) {
	'use strict';
	$('.admin .sidebar .nav-parent').on('click', function() 
	{
		$(this).find('.children').slideToggle();
	});

	if($('#htmlwysiwyg').length)
	{
		$('#htmlwysiwyg').summernote({
			onChange: function(contents, $editable) {
			    $('[name="content[html]"]').val(contents);
			},
		});
	}

	if($('#post-type').length)
	{
		$('.editor-container').hide();
		$('#'+$('#post-type').val()+'container').show();
	}

	$('#post-type').on('change', function() 
	{
		$('.editor-container').hide();

		$('#'+$(this).val()+'container').show();

	});

})(jQuery);