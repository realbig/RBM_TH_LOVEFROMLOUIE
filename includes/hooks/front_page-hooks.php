<?php
/**
 * Adds Hooks into the Home Page
 *
 * @since   1.0.0
 * @package Love_From_Louie
 * @subpackage  Love_From_Louie/includes/hooks
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// This should never have had to happen. git gud, plugin developer
lfl_remove_class_filter( 'the_content', 'MR_Social_Sharing_Toolkit', 'share' );