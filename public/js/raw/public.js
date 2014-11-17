;(function($)
{
	'use strict';

	$('#wookmarkcontainer').imagesLoaded(function() 
	{
		var wookmarkopts =  {
				autoResize: true,
			    align: 'center',
			    container: $('#wookmarkcontainer'),
			    direction: 'left',
			    offset: 15,
			    ignoreInactiveItems: false,
			    comparator: function(a, b) {
			    	return $(a).hasClass('active') ? 1 : -1;
			    }
			}

		var handler = $('#wookmarkcontainer .grid-item'),
		 	filters = $('#wookmarkfilters li');

		handler.wookmark(wookmarkopts);

		function onClickFilter(e) {
            
            var $item = $(e.currentTarget),
                activeFilters = [],
                filterType = $item.data('filter');
          
            if (filterType === 'all') 
            {
	            filters.removeClass('active');
	        } 
	        else 
	        {
	            $item.toggleClass('active');

	            filters.filter('.active').each(function() 
	            {
		            activeFilters.push($(this).data('filter'));
	            });
	        }

	        handler.wookmarkInstance.filter(activeFilters);
        }

        $('#wookmarkfilters').on('click.wookmark-filter', 'li', onClickFilter);

	});

})(jQuery);