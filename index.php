<?php
/**
 * Displays archive of posts.
 *
 * @since   1.0.0
 * @package Love_From_Louie
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

?>

<h1 class="page-title columns small-12">
    <?php echo _x( 'Blog', 'Blog Header', 'love-from-louie' ); ?>
</h1>

<?php

get_template_part( 'partials/loop/loop', get_post_type() );

get_footer();