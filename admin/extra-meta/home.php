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
            'pat-home-graph',
            _x( 'Graph Section', 'Home Graph Metabox Title', 'love_from_louie' ),
            'lfl_home_graph_metabox_content',
            'page',
            'normal'
        );
        
    }
    
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
		_x( 'Graph Section Title', 'Home Graph Section Title Label', 'love_from_louie' ),
		false,
		array(
			'input_atts' => array(
			),
		)
	);
	
	rbm_do_field_wysiwyg(
		'lfl_home_graph_text',
		_x( 'Graph Section Content', 'Home Graph Section Content Label', 'love_from_louie' ),
		false,
		array(
			'input_atts' => array(
			),
		)
	);
    
    rbm_do_field_repeater(
        'lfl_home_graph_data',
        _x( 'Pie Chart Settings', 'Home Graph Title', 'love_from_louie' ),
        array(
			'label' => array(
				'type' => 'text',
				'label' => _x( 'Label', 'Home Graph Label Text', 'love_from_louie' ),
				'args' => array(
					'input_atts' => array(),
				),
			),
			'percentage' => array(
				'type' => 'number',
				'label' => _x( 'Percentage', 'Home Graph Percentage Label', 'love_from_louie' ),
				'args' => array(
					'min' => '1',
					'max' => '100',
					'postfix' => '%',
				),
			),
			'color' => array(
				'type' => 'colorpicker',
				'label' => _x( 'Color of this section of the Chart', 'Home Graph Color Label', 'love_from_louie' ),
				'args' => array(
					'default' => '#58DE78', // Secondary Color
				),
			),
		),
        false
    );
    
}