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

$hero_button_text = get_post_meta( get_the_ID(), '_rbm_lfl_home_hero_button_text', true );
$hero_url = get_post_meta( get_the_ID(), '_rbm_lfl_home_hero_button_url', true );

if ( ( strpos( $hero_url, '#' ) !== 0 ) && 
	( strpos( $hero_url, 'http' ) !== 0 ) && 
	( strpos( $hero_url, '/' ) !== 0 ) 
) :
	$hero_url = '//' . $hero_url;
endif;

?>

<div class="lfl-hero row expanded" style="background-image: url(<?php echo $hero_image[0]; ?>); height: <?php echo $hero_image[2]; ?>px;">

    <div class="small-12 medium-8 columns blank-container">
		
		&nbsp;
		
    </div>
	
	<div class="small-12 medium-4 columns text-container">

        <h1><?php echo get_post_meta( get_the_ID(), '_rbm_lfl_home_hero_title', true ); ?></h1>

        <a href="<?php echo $hero_url; ?>" title="<?php echo $hero_button_text; ?>" class="button secondary hollow">
			<?php echo $hero_button_text; ?>
		</a>

    </div>

</div>