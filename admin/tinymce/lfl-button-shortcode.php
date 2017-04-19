<?php
/**
 * Add a TinyMCE button to create [lfl_button] Shortcodes
 *
 * @since   1.0.0
 * @package Love_From_Louie
 * @subpackage  Love_From_Louie/admin/tinymce
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Add Button Shortcode to TinyMCE
 *
 * @since       1.0.0
 * @return      void
 */
add_action( 'admin_init', 'add_lfl_button_tinymce_filters' );
function add_lfl_button_tinymce_filters() {
    
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
        
        add_filter( 'mce_buttons', function( $buttons ) {
            array_push( $buttons, 'lfl_button_shortcode' );
            return $buttons;
        } );
        
        // Attach script to the button rather than enqueueing it
        add_filter( 'mce_external_plugins', function( $plugin_array ) {
            $plugin_array['lfl_button_shortcode_script'] = get_stylesheet_directory_uri() . '/assets/js/tinymce/button-shortcode.js';
            return $plugin_array;
        } );
        
    }
    
}

/**
 * Add Localized Text for our TinyMCE Button
 *
 * @since       1.0.0
 * @return      Array Localized Text
 */
add_filter( 'lfl_tinymce_l10n', 'lfl_tinymce_l10n' );
function lfl_tinymce_l10n( $l10n ) {
    
    $l10n['lfl_button_shortcode'] = array(
        'tinymce_title' => _x( 'Add Button', 'Button Shortcode TinyMCE Button Text', 'love-from-louie' ),
        'button_text' => array(
            'label' => _x( 'Button Text', "Button's Text", 'love-from-louie' ),
        ),
        'button_url' => array(
            'label' => _x( 'Button Link', 'Link for the Button', 'love-from-louie' ),
        ),
        'colors' => array(
            'label' => _x( 'Color', 'Button Color Selection Label', 'love-from-louie' ),
            'default' => 'primary',
            'choices' => array(
                'primary' => _x( 'Green', 'Primary Theme Color', 'love-from-louie' ),
                'secondary' => _x( 'Light Green', 'Secondary Theme Color', 'love-from-louie' ),
				'tertiary' => _x( 'Blue-Green', 'Tertiary Theme Color', 'love-from-louie' ),
            ),
        ),
        'size' => array(
            'label' => _x( 'Size', 'Button Size Selection Lable', 'love-from-louie' ),
            'default' => 'small',
            'choices' => array(
                'tiny' => _x( 'Tiny', 'Tiny Button Size', 'love-from-louie' ),
                'small' => _x( 'Small', 'Small Button Size', 'love-from-louie' ),
                'medium' => _x( 'Medium', 'Medium Button Size', 'love-from-louie' ),
                'large' => _x( 'Large', 'Large Button Size', 'love-from-louie' ),
            ),
        ),
        'hollow' => array(
            'label' => _x( 'Hollow/"Ghost" Button?', 'Hollow Button Style', 'love-from-louie' ),
        ),
        'expand' => array(
            'label' => _x( 'Full Width?', 'Full Width Button', 'love-from-louie' ),
        ),
        'new_tab' => array(
            'label' => __( 'Open Link in a New Tab?', 'love-from-louie' ),
        ),
    );
    
    return $l10n;
    
}