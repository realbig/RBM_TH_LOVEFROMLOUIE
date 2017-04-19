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
            _x( 'Blog Section', 'Home Blog Metabox Title', 'love-from-louie' ),
            'lfl_home_blog_metabox_content',
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
	
	rbm_do_field_text(
		'lfl_home_hero_button_text',
		_x( 'Hero Section Button Text', 'Home Hero Section Button Text Label', 'love-from-louie' ),
		false,
		array(
			'input_atts' => array(
			),
		)
	);
	
	rbm_do_field_text(
		'lfl_home_hero_button_url',
		_x( 'Hero Section Button URL', 'Home Hero Section Button URL Label', 'love-from-louie' ),
		false,
		array(
			'input_atts' => array(
				'placeholder' => 'http://'
			),
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
 * Put fields in the Blog Metabox
 * 
 * @since       1.0.0
 * @return      void
 */
function lfl_home_blog_metabox_content() {
	
	rbm_do_field_text(
		'lfl_home_blog_title',
		_x( 'Blog Section Title', 'Home Blog Section Title Label', 'love-from-louie' ),
		false,
		array(
			'input_atts' => array(
			),
		)
	);
	
	rbm_do_field_number(
		'lfl_home_blog_posts_per_page',
		_x( 'Number of Blog Posts to Show', 'Home Blog Section Posts Per Page', 'love-from-louie' ),
		false,
		array(
			'min' => '1',
		)
	);
    
}