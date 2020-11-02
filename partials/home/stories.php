<?php
/**
 * Stories on the Home Page
 *
 * @since       1.0.0
 * @package     PatRobertson
 * @subpackage  PatRobertson/partials/home
 */

defined( 'ABSPATH' ) || die();

// Just in case there are any Hooks for Post
locate_template( '/includes/hooks/lfl-story-hooks.php', true, true );

global $post;

$query = new WP_Query( array(
	'post_type' => 'post',
	'posts_per_page' => 3,
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'category',
			'terms' => array( 'story' ),
			'compare' => 'IN',
			'field' => 'slug',
		)
	)
) );

?>

<div class="lfl-stories row expanded">
	
	<h1><?php echo get_post_meta( get_the_ID(), '_rbm_lfl_home_blog_title', true ); ?></h1>
	
	<div class="row">

		<?php if ( $query->have_posts() ) : $query->the_post(); ?>

			<div class="small-12 medium-6 columns left">
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( has_post_thumbnail() ) : ?>

						<a href ="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail( 'medium' ); ?>
						</a>

					<?php endif; ?>

					<h4>
						<a href ="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a>
					</h4>

					<span class="timestamp"><span class="fa fa-clock-o"></span>&nbsp;<?php the_date(); ?></span>

					<?php the_excerpt(); ?>

					<a href="<?php the_permalink(); ?>" class="primary hollow button">
						<?php echo _x( 'Read More', 'Read More Text', 'love-from-louie' ); ?>
					</a>

				</article>
		
			</div>
		
			<div class="small-12 medium-6 columns right">

				<?php $index = 1;
				while ( $query->have_posts() ) : $query->the_post(); ?>

					<div class="row small-collapse">

						<div class="small-12 columns">

							<article id="post-<?php the_ID(); ?>" <?php post_class( array(
								'row',
							) ); ?>>
								
								<div class="small-12 medium-4 columns">

									<?php if ( has_post_thumbnail() ) : ?>

										<a href ="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php the_post_thumbnail( 'medium' ); ?>
										</a>

									<?php endif; ?>
									
								</div>
								
								<div class="small-12 medium-8 columns">

									<h4>
										<a href ="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php the_title(); ?>
										</a>
									</h4>

									<p class="timestamp-container">
										<span class="timestamp"><span class="fa fa-clock-o"></span>&nbsp;<?php the_date(); ?></span>
									</p>
									
									<a href="<?php the_permalink(); ?>" class="primary hollow button">
										<?php echo _x( 'Read More', 'Read More Text', 'love-from-louie' ); ?>
									</a>
									
								</div>

							</article>

						</div>

					</div>

				<?php endwhile; ?>
				
			</div>

			<?php wp_reset_postdata();

		endif; ?>
		
	</div>
	
	<div class="row">
	
		<div class="small-12 medium-8 medium-push-2 text-center">

			<a href="<?php echo get_term_link( 'story', 'category' ); ?>" class="primary hollow button expanded">
				<?php _e( 'See All Stories', 'Stories Archive Link Text', 'love-from-louie' ); ?>
			</a>

		</div>
		
	</div>
                 
</div>