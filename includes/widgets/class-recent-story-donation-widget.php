<?php
/**
 * Add Story Donation Widget
 *
 * @since   1.0.0
 * @package Love_From_Louie
 * @subpackage  Love_From_Louie/includes/widgets
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class LFL_Recent_Story_Donation_Widget extends WP_Widget {

    /**
	 * Register widget with WordPress.
	 */
    function __construct() {
        parent::__construct(
            'lfl_story_donation_widget', // Base ID
            _x( 'Love From Louie Story Donation Button', 'Story Donation Widget Name', 'love-from-louie' ), // Name
            array( 
                'classname' => 'lfl-story-donation-widget',
                'description' => _x( 'A Widget that shows the most recent Story and a Donation button.', 'Story Donation Widget Description', 'love-from-louie' ),
            ) // Args
        );
    }

    /**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
    public function widget( $args, $instance ) {

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Archives' ) : $instance['title'], $instance, $this->id_base );
        
		echo $args['before_widget'];
        
		if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        if ( ! empty( $instance['give_form'] ) ) : 
		
			global $post;

			$story = new WP_Query( array(
				'post_type' => 'lfl-story',
				'posts_per_page' => 1,
				'orderby' => 'date',
				'order' => 'DESC',
			) );
		
			while ( $story->have_posts() ) : $story->the_post(); ?>

				<h2 class="widgettitle">
					<?php printf( _x( 'Help %s,', 'Help this Animal header', 'love_from_louie' ), get_the_title() ); ?>
				</h2>

			<?php endwhile; wp_reset_postdata(); ?>

            <p>
				<?php echo do_shortcode( '[give_form id="' . $instance['give_form'] . '" show_content="false" show_title="false"]' ); ?>
            </p>

        <?php endif;
        
        echo $args['after_widget'];
        
    }

    /**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
    public function form( $instance ) {
        
        $give_form = ! empty( $instance['give_form'] ) ? $instance['give_form'] : '';

		// All Forms
		$give_forms = new WP_Query( array(
			'post_type' => 'give_forms',
			'posts_per_page' => -1,
			'orderby' => 'post_title',
			'order' => 'ASC',
		) );
		
		$give_forms = wp_list_pluck( $give_forms->posts, 'post_title', 'ID' );
        
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'give_form' ); ?>"><?php echo _x( 'Give Donation Form:', 'Give Widget Label', 'love-from-louie' ); ?></label> 
			
			<select id="<?php echo $this->get_field_id( 'give_form' ); ?>" name="<?php echo $this->get_field_name( 'give_form' ); ?>">
				
				<option value="" disabled="true"<?php echo ( $give_form == '' ) ? ' selected' : ''; ?>>
					<?php echo _x( '-- Chose a Donation Form--', 'Give Donation Form default option', 'love-from-louie' ); ?>
				</option>
				
				<?php foreach ( $give_forms as $id => $form_title ) : ?>
				
					<option value="<?php echo $id; ?>"<?php echo ( $id == $give_form ) ? ' selected' : ''; ?>>
						<?php echo $form_title; ?>
					</option>
				
				<?php endforeach; ?>
				
			</select>
        </p>

    <?php 
    }

    /**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
    public function update( $new_instance, $old_instance ) {
        
        $instance = array();
        $instance['give_form'] = ( ! empty( $new_instance['give_form'] ) ) ? strip_tags( $new_instance['give_form'] ) : '';

        return $instance;
        
    }

}