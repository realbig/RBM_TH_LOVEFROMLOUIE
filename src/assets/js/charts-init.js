import Chart from 'chart.js';

( function( $ ) {

	$( document ).ready( function() {
		
		// Clicking the Legend to remove things from view is weird
		Chart.defaults.pie.legend.onClick = function( ) {};

		$( '.chart-container' ).each( function( index, container ) {

			var $chart = $( container ).find( 'canvas' ),
				chartData = $chart.data( 'chart_data' );

			if ( chartData.length > 0 ) {

				var labels = [],
					values = [],
					colors = [];

				for ( var index in chartData ) {

					labels.push( chartData[ index ].label );
					values.push( chartData[ index ].percentage );
					colors.push( chartData[ index ].color );

				}

				var chart = new Chart( $chart, {
					type: 'pie',
					data: {
						labels: labels,
						datasets: [
							{
								data: values,
								backgroundColor: colors,
							}
						]
					},
					options: {
						tooltips: {
							callbacks: {
								label: function( tooltipItem, data ) {
									
									var allData = data.datasets[tooltipItem.datasetIndex].data,
										tooltipLabel = data.labels[tooltipItem.index],
										tooltipData = allData[tooltipItem.index];
									
									return ' ' + tooltipLabel + ': ' + tooltipData + '%';
									
								}
							}
						}
					}
				} );

			}

		} );

	} );

} )( jQuery );