;(function($)
{
	if($('#post-type').length)
	{
		$('.editor-container').hide();
		$('#'+$('#post-type').val()+'container').show();
	}

	$('.deleteResource').on('click', function(e)
	{
		e.preventDefault();
		if(confirm('Are you sure you wish to delete this item?'))
		{
			$(this).parents('form').eq(0).submit();
		}
	});

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

})(jQuery);