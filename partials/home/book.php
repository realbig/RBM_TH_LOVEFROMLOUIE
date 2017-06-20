<?php
/**
 * Book section on the Home Page
 *
 * @since       1.0.0
 * @package     Love_From_Louie
 * @subpackage  Love_From_Louie/partials/home
 */

defined( 'ABSPATH' ) || die();

$attachment_id = rbm_get_field( 'lfl_home_book_image' );

$image_url = wp_get_attachment_image_url( $attachment_id, 'full' );

?>

<div class="lfl-book row expanded">
	
	<div class="image" style="background-image: url('<?php echo $image_url; ?>');"></div>
	
	<div class="row">
		
		<div class="small-12 medium-8 columns text-container">
			
			<h4>
				<?php echo rbm_get_field( 'lfl_home_book_text' ); ?>
			</h4>
		
		</div>
		
		<div class="small-12 medium-4 columns button-container">
			
			<a class="button white hollow" href="<?php echo rbm_get_field( 'lfl_home_book_button_url' ); ?>" target="_blank">
				<?php echo rbm_get_field( 'lfl_home_book_button_text' ); ?>
			</a>
			
		</div>
	
	</div>

</div>