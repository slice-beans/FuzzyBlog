;(function($)
{
	'use strict';

	var charts = {},
		chartConfigs = {
			Radar: {
				datasets: [{
				    label: "My First dataset",
				    fillColor: "rgba(20,172,173,0.3)",
				    strokeColor: "rgba(20,172,173,1)",
				    pointColor: "rgba(20,172,173,1)",
				    pointStrokeColor: "#fff",
				    pointHighlightFill: "#fff",
				    pointHighlightStroke: "rgba(220,220,220,1)",
				}]
			}
		};

	var setDims = function(canvasid) {
		charts[canvasid].canvas.width  = $('#'+canvasid).parents('div').eq(0).width();
		charts[canvasid].canvas.height = $('#'+canvasid).parents('div').eq(0).width();
	}
		
	$('.dashboardChart').each(function()
	{
		var _this = $(this),
			id    = _this.attr('id');

		charts[id] = {};

		charts[id].labels  = _this.data('labels').split(',');
		charts[id].data    = _this.data('chartdata').split(',');
		charts[id].type    = _this.data('type');
		charts[id].canvas  = document.getElementById(id);
		charts[id].context = charts[id].canvas.getContext('2d');
		charts[id].config  = chartConfigs[charts[id].type];

		if(charts[id].type == 'Radar') {
			charts[id].config.labels = charts[id].labels;
			charts[id].config.datasets[0].data = charts[id].data;
		}

		setDims(id);
		charts[id].chart = new Chart(charts[id].context)[charts[id].type](charts[id].config, {responsive: true});
	});

})(jQuery);
