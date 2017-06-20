<?php
/**
 * Hero section on the Home Page
 *
 * @since       1.0.0
 * @package     Love_From_Louie
 * @subpackage  Love_From_Louie/partials/home
 */

defined( 'ABSPATH' ) || die();

$hero_image = wp_get_attachment_image_src( get_post_meta( get_the_ID(), '_rbm_lfl_home_hero_image', true ), 'lfl-hero' );

?>

<div class="lfl-hero row expanded" style="background-image: url(<?php echo $hero_image[0]; ?>); height: <?php echo ( $hero_image[2] + 50 ); ?>px;">
	
	<div class="row">

		<div class="small-12 large-8 columns blank-container hide-for-small-only hide-for-medium-only">

			&nbsp;

		</div>

		<div class="small-12 large-4 columns text-container">
			
			<div class="vertical-align">

				<h1><?php echo get_post_meta( get_the_ID(), '_rbm_lfl_home_hero_title', true ); ?></h1>

				<?php if ( $give_form = get_post_meta( get_the_ID(), '_rbm_lfl_home_hero_give_form', true ) ) : ?>

					<?php echo do_shortcode( '[give_form id="' . $give_form . '" show_title="false" show_goal="false" show_content="none" display_style="modal"]' ); ?>

				<?php else : ?>

					<?php echo _x( 'Please select a Donation Form on the Edit Screen for this page', 'No Donation Form set', 'love-from-louie' ); ?>

				<?php endif; ?>
				
			</div>

		</div>

		
	</div>
</div>