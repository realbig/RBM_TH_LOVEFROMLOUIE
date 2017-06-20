<?php
/**
 * Home extra meta.
 *
 * @since   1.0.0
 * @package Love_From_Louie
 * @subpackage  Love_From_Louie/admin/extra-meta
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Remove unneeded Default Meta/Supports for the Home Page
add_action( 'init', 'lfl_remove_home_supports' );
add_action( 'do_meta_boxes', 'lfl_remove_home_metaboxes' );

// Add the Metaboxes that we want for the Home Page
add_action( 'add_meta_boxes', 'lfl_add_home_metaboxes' );

/**
 * Remove Supports from the Home Page
 * 
 * @since       1.0.0
 * @return      void
 */
function lfl_remove_home_supports() {
    
    if ( is_admin() && isset( $_REQUEST['post'] ) && $_REQUEST['post'] == get_option( 'page_on_front' ) ) {

        remove_post_type_support( 'page', 'thumbnail' );
        remove_post_type_support( 'page', 'editor' );
        
    }
    
}

/**
 * Needs to be called at do_meta_boxes since it is created at a different time than Supports Metaboxes
 * 
 * @since       1.0.0
 * @return      void
 */
function lfl_remove_home_metaboxes() {
    
    if ( is_admin() && isset( $_REQUEST['post'] ) && $_REQUEST['post'] == get_option( 'page_on_front' ) ) {
    
        // "Attributes" Meta Box
        remove_meta_box( 'pageparentdiv', 'page', 'side' );
        
    }
    
}

/**
 * Create Metaboxes for the Home Page
 * 
 * @since       1.0.0
 * @return      void
 */
function lfl_add_home_metaboxes() {
    
    if ( is_admin() && isset( $_REQUEST['post'] ) && $_REQUEST['post'] == get_option( 'page_on_front' ) ) {
		
		add_meta_box(
            'pat-home-hero',
            _x( 'Hero Section', 'Home Hero Metabox Title', 'love-from-louie' ),
            'lfl_home_hero_metabox_content',
            'page',
            'normal'
        );
		
		add_meta_box(
            'pat-home-graph',
            _x( 'Graph Section', 'Home Graph Metabox Title', 'love-from-louie' ),
            'lfl_home_graph_metabox_content',
            'page',
            'normal'
        );
		
		add_meta_box(
            'pat-home-blog',
            _x( 'Stories Section', 'Home Stories Metabox Title', 'love-from-louie' ),
            'lfl_home_blog_metabox_content',
            'page',
            'normal'
        );
		
		add_meta_box(
            'pat-home-partners',
            _x( 'Partners Section', 'Home Partners Metabox Title', 'love-from-louie' ),
            'lfl_home_partner_metabox_content',
            'page',
            'normal'
        );
		
		add_meta_box(
            'pat-home-book',
            _x( 'Book Section', 'Home Book Metabox Title', 'love-from-louie' ),
            'lfl_home_book_metabox_content',
            'page',
            'normal'
        );
        
    }
    
}

/**
 * Put fields in the Hero Metabox
 * 
 * @since       1.0.0
 * @return      void
 */
function lfl_home_hero_metabox_content() {
	
	rbm_do_field_text(
		'lfl_home_hero_title',
		_x( 'Hero Section Title', 'Home Hero Section Title Label', 'love-from-louie' ),
		false,
		array(
			'input_atts' => array(
			),
		)
	);
	
	// All Forms
	$give_forms = new WP_Query( array(
		'post_type' => 'give_forms',
		'posts_per_page' => -1,
		'orderby' => 'post_title',
		'order' => 'ASC',
	) );

	$give_forms = wp_list_pluck( $give_forms->posts, 'post_title', 'ID' );
	
	rbm_do_field_select(
		'lfl_home_hero_give_form',
		_x( 'Hero Section Donation Form', 'Home Hero Section Give Form Label', 'love-from-louie' ),
		false,
		array(
			'option_none' => _x( '-- Select a Donation Form --', 'Home Hero Section Give Form None Label', 'love-from-louie' ),
			'options' => $give_forms,
		)
	);
	
	rbm_do_field_media(
		'lfl_home_hero_image',
		_x( 'Hero Section Image', 'Home Hero Section Image Label', 'love-from-louie' ),
		false,
		array(
			'button_text' => _x( 'Upload/Choose Hero Image', 'Home Hero Section Image Button Text', 'love-from-louie' ),
			'button_remove_text' => _x( 'Remove Hero Image', 'Home Hero Section Image Remove Button Text', 'love-from-louie' ),
			'type' => 'image',
			'window_title' => _x( 'Choose Hero Image', 'Home Hero Section Image Window Title', 'love-from-louie' ),
			'window_button_text' => _x( 'Use Hero Image', 'Home Hero Section Image Window Button Text', 'love-from-louie' ),
		)
	);
    
}

/**
 * Put fields in the Graph Metabox
 * 
 * @since       1.0.0
 * @return      void
 */
function lfl_home_graph_metabox_content() {
	
	rbm_do_field_text(
		'lfl_home_graph_title',
		_x( 'Graph Section Title', 'Home Graph Section Title Label', 'love-from-louie' ),
		false,
		array(
			'input_atts' => array(
			),
		)
	);
	
	rbm_do_field_wysiwyg(
		'lfl_home_graph_text',
		_x( 'Graph Section Content', 'Home Graph Section Content Label', 'love-from-louie' ),
		false,
		array(
			'input_atts' => array(
			),
		)
	);
    
    rbm_do_field_repeater(
        'lfl_home_graph_data',
        _x( 'Pie Chart Settings', 'Home Graph Title', 'love-from-louie' ),
        array(
			'label' => array(
				'type' => 'text',
				'label' => _x( 'Label', 'Home Graph Label Text', 'love-from-louie' ),
				'args' => array(
					'input_atts' => array(),
				),
			),
			'percentage' => array(
				'type' => 'number',
				'label' => _x( 'Percentage', 'Home Graph Percentage Label', 'love-from-louie' ),
				'args' => array(
					'min' => '1',
					'max' => '100',
					'postfix' => '%',
				),
			),
			'color' => array(
				'type' => 'colorpicker',
				'label' => _x( 'Color of this section of the Chart', 'Home Graph Color Label', 'love-from-louie' ),
				'args' => array(
					'default' => '#58DE78', // Secondary Color
				),
			),
		),
        false
    );
    
}

/**
 * Put fields in the Stories Metabox
 * 
 * @since       1.0.0
 * @return      void
 */
function lfl_home_blog_metabox_content() {
	
	rbm_do_field_text(
		'lfl_home_blog_title',
		_x( 'Stories Section Title', 'Home Stories Section Title Label', 'love-from-louie' ),
		false,
		array(
			'input_atts' => array(
			),
		)
	);
    
}

/**
 * Put fields in the Partners Metabox
 * 
 * @since       1.0.0
 * @return      void
 */
function lfl_home_partner_metabox_content() {
	
	rbm_do_field_text(
		'lfl_home_partner_title',
		_x( 'Partners Section Title', 'Home Partners Section Title Label', 'love-from-louie' ),
		false,
		array(
			'input_atts' => array(
			),
		)
	);
    
}

/**
 * Put fields in the Book Metabox
 * 
 * @since       1.0.0
 * @return      void
 */
function lfl_home_book_metabox_content() {
	
	rbm_do_field_text(
		'lfl_home_book_text',
		_x( 'Book Section Text', 'Home Book Section Text Label', 'love-from-louie' ),
		false,
		array(
		)
	);
	
	rbm_do_field_text(
		'lfl_home_book_button_text',
		_x( 'Book Section Button Text', 'Home Book Section Button Text Label', 'love-from-louie' ),
		false,
		array(
		)
	);
	
	rbm_do_field_text(
		'lfl_home_book_button_url',
		_x( 'Book Section Button URL', 'Home Book Section Button URL Label', 'love-from-louie' ),
		false,
		array(
		)
	);
	
	rbm_do_field_media(
		'lfl_home_book_image',
		_x( 'Book Section Image', 'Home Book Section Image Label', 'love-from-louie' ),
		false,
		array(
			'button_text' => _x( 'Upload/Choose Book Image', 'Home Book Section Image Button Text', 'love-from-louie' ),
			'button_remove_text' => _x( 'Remove Book Image', 'Home Book Section Image Remove Button Text', 'love-from-louie' ),
			'type' => 'image',
			'window_title' => _x( 'Choose Book Image', 'Home Book Section Image Window Title', 'love-from-louie' ),
			'window_button_text' => _x( 'Use Book Image', 'Home Book Section Image Window Button Text', 'love-from-louie' ),
		)
	);
    
}