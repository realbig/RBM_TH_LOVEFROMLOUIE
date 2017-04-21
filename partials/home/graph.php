<?php
/**
 * Graph section on the Home Page
 *
 * @since       1.0.0
 * @package     Love_From_Louie
 * @subpackage  Love_From_Louie/partials/home
 */

defined( 'ABSPATH' ) || die();

$graph_data = get_post_meta( get_the_ID(), '_rbm_lfl_home_graph_data', true );

?>

<div class="lfl-graph row expanded" style="margin-top: <?php echo $hero_image[2] / 1.5; ?>px">
	
	<div class="row">
	
		<div class="small-12 medium-6 columns text-container">

			<h1><?php echo get_post_meta( get_the_ID(), '_rbm_lfl_home_graph_title', true ); ?></h1>

			<?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), '_rbm_lfl_home_graph_text', true ) ); ?>

		</div>

		<div class="small-12 medium-6 columns chart-container">

			<canvas data-chart_data='<?php echo json_encode( $graph_data ); ?>'></canvas>

		</div>
		
	</div>

</div>