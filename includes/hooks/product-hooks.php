<?php
/**
 * Adds Hooks into the Products Pages
 *
 * @since   1.0.0
 * @package Love_From_Louie
 * @subpackage  Love_From_Louie/includes/hooks
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Yeah, no. We have our own Breadcrumbs
function woocommerce_breadcrumb() {
	
}

// WooCommerce comes with its own Wrapper for the Content which EXCLUDES the Sidebar
// There's also no way to include your own Wrapping Elements in their Switch statement as it is hardcoded for WP Default Themes
// So, bye-bye!
function woocommerce_output_content_wrapper() {
	
}

function woocommerce_output_content_wrapper_end() {
	
}

// WooCommerce calls to a non-existant "Shop" sidebar, which breaks stuff
function woocommerce_get_sidebar() {
	dynamic_sidebar( 'sidebar-main' );
}

add_action( 'woocommerce_before_main_content', 'lfl_woocommerce_add_row' );

function lfl_woocommerce_add_row() {
	echo '<div class="row">';
}

// Fires right after adding our Row
add_action( 'woocommerce_before_main_content', 'lfl_woocommerce_add_content_column', 11 );

function lfl_woocommerce_add_content_column() {
	
	$medium_class = 'medium-9';
	
	echo '<div class="small-12 ' . $medium_class . ' columns">';
	
}

// Hooks right before the Sidebar is actually added
add_action( 'woocommerce_sidebar', 'lfl_woocommerce_add_sidebar_column', 9 );

function lfl_woocommerce_add_sidebar_column() {
	
	$medium_class = 'medium-3';
	
	echo '<div class="small-12 ' . $medium_class . ' columns">';
	
}

// Close out our Columns
add_action( 'woocommerce_after_main_content', 'lfl_woocommerce_after_column' );
add_action( 'woocommerce_sidebar', 'lfl_woocommerce_after_column', 998 );

function lfl_woocommerce_after_column() {
	echo '</div>';
}

// Close out our Row
add_action( 'woocommerce_sidebar', 'lfl_woocommerce_after_row', 999 );

function lfl_woocommerce_after_row() {
	echo '</div>';
}