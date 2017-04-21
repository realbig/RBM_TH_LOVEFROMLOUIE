<?php
/**
 * The theme's single file use for displaying single posts.
 * 
 * @since 1.0.0
 * @package Love_From_Louie
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Load any post-type specific hooks, if they exist
locate_template( '/includes/hooks/' . get_post_type() . '-hooks.php', true, true );

get_header();

the_post();
?>

<div class="row">

    <article id="page-<?php the_ID(); ?>" <?php post_class( array( 
        'columns',
        'small-12',
        is_active_sidebar( 'sidebar-main' ) ? 'medium-9': 'no-sidebar',
    ) ); ?>>
        
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="thumbnail alignleft">
                <?php the_post_thumbnail( 'full' ); ?>
            </div>
        <?php endif; ?>

        <h1 class="page-title">
            <?php the_title(); ?>
        </h1>
        
        <p>
            <span class="timestamp"><span class="fa fa-clock-o"></span>&nbsp;<?php the_date(); ?></span>
        </p>

        <?php the_content(); ?>

    </article>
	
	<?php if ( is_active_sidebar( 'sidebar-main' ) ) : ?>
    
        <div class="small-12 medium-3 columns">
            
            <?php dynamic_sidebar( 'sidebar-main' ); ?>
            
        </div>
    
    <?php endif; ?>

    <?php if ( comments_open() ) : ?>

    <div class="columns small-12">
        <?php comments_template(); ?>
    </div>

    <?php endif; ?>
    
</div>

<?php get_footer();