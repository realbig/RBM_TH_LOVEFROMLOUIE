<?php
/**
 * Template Name: Full Width
 *
 * @since       1.0.0
 * @package     Love_From_Louie
 * @subpackage  Love_From_Louie/partials/loop
 */

defined( 'ABSPATH' ) || die();

// Load any post-type specific hooks, if they exist
locate_template( '/includes/hooks/' . get_post_type() . '-hooks.php', true, true );

get_header();

the_post();
?>

<div class="row">

    <article id="page-<?php the_ID(); ?>" <?php post_class( array( 
        'columns',
        'small-12',
    ) ); ?>>

        <h1 class="page-title">
            <?php the_title(); ?>
        </h1>

        <?php the_content(); ?>

    </article>
    
</div>

<?php
get_footer();