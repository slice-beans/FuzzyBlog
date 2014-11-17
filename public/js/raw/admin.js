;(function(window, $) {
	'use strict';
	
	$('.admin .sidebar .nav-parent').on('click', function() 
	{
		$(this).find('.children').slideToggle();
	});
	
	$('#entityDT').DataTable();

})(window, jQuery);