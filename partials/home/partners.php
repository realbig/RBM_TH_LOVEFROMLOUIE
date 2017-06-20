<?php
/**
 * Hero section on the Home Page
 *
 * @since       1.0.0
 * @package     Love_From_Louie
 * @subpackage  Love_From_Louie/partials/home
 */

defined( 'ABSPATH' ) || die();

// Just in case there are any Hooks for Post
locate_template( '/includes/hooks/lfl-partner-hooks.php', true, true );

global $post;

$query = new WP_Query( array(
	'post_type' => 'lfl-partner',
	'posts_per_page' => -1,
) );

$count = count( $query->posts );

switch ( $count ) {
	
	case ( $count % 5 == 0 ) :
	case ( $count % 4 == 0 ) :
		$row_break = 4;
		$medium_class = 'medium-3';
		break;
	case ( $count % 3 == 0 ) :
		$row_break = 3;
		$medium_class = 'medium-4';
		break;
	case ( $count % 2 == 0 ) : // Only applies in cases where there's only 2
		$row_break = 2;
		$medium_class = 'medium-4 medium-push-1';
		break;
	case ( $count % 1 == 0 ) : // Only applies in cases where there's only 1
		$row_break = 1;
		$medium_class = 'medium-4 medium-push-4';
		break;
	default : 
		$row_break = 2;
		$medium_class = 'medium-4 medium-push-1';
		break;
		
}

?>

<div class="lfl-partners row expanded">
	
	<h1><?php echo get_post_meta( get_the_ID(), '_rbm_lfl_home_partner_title', true ); ?></h1>

    <?php if ( $query->have_posts() ) : 
	
		$index = 1;
		while ( $query->have_posts() ) : $query->the_post(); 
	
			if ( $index == 1 ) : ?>
	
				<div class="row">
					
			<?php elseif ( $row_break == 2 ) :
					
				$medium_class = str_replace( 'push', 'pull', $medium_class );
	
			endif; ?>
    
					<div class="small-12 <?php echo $medium_class; ?> columns">

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<?php if ( has_post_thumbnail() ) : ?>

								<a href ="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_post_thumbnail( 'medium' ); ?>
								</a>

							<?php else: ?>

								<h4>
									<a href ="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</h4>
							
							<?php endif; ?>

						</article>

					</div>
					
			<?php if ( $index == $row_break ) : ?>
					
				</div>
	
			<?php 
	
				$index = 1;
	
			else : 
	
				$index++;
	
			endif;
	
		endwhile;
	
		wp_reset_postdata();
	
	endif; ?>
                 
</div>