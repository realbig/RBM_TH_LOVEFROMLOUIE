<?php
/**
 * Displays the home page
 *
 * @since   1.0.0
 * @package Love_From_Louie
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Load any post-type specific hooks, if they exist
locate_template( '/includes/hooks/front_page-hooks.php', true, true );

get_header();

the_post();

include locate_template( 'partials/home/hero.php' );

include locate_template( 'partials/home/graph.php' );

include locate_template( 'partials/home/stories.php' );

get_footer();
?>