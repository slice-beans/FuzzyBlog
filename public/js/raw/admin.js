;(function(window, $) {
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

	$('.deleteResource').on('click', function(e)
	{
		e.preventDefault();
		if(confirm('Are you sure you wish to delete this item?'))
		{
			$(this).parents('form').eq(0).submit();
		}
	});

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

	$('#clearthumbnail').on('click', function(e) 
	{
		e.preventDefault();
		$('#post-thumbnail').val('');
		$('#postthumbnail').html('<p>No thumbnail.</p>');
		if($('#thumbnailupdate').length)
		{
			$('#thumbnailupdate').val('true');
		}
	});

	$('#newthumbnail').on('click', function(e) 
	{
		e.preventDefault();
		if($('#thumbnailupdate').length)
		{
			$('#thumbnailupdate').val('true');
		}
		$('#post-thumbnail').click();
	});

	$('#post-thumbnail').on('change', function() 
	{
		if(this.files && this.files[0])
		{
			var reader = new FileReader();

			reader.onload = function(e)
			{
				$('#postthumbnail').html('<img src="'+e.target.result+'">');
			}

			reader.readAsDataURL(this.files[0]);
		}
	});

	$('#entityDT').DataTable();

})(window, jQuery);