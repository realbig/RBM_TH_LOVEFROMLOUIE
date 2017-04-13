<?php
/**
 * The theme's admin file for providing additional admin-related functionality.
 *
 * @since   1.0.0
 * @package Love_From_Louie
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Run if RBM CPTs is active
if ( class_exists( 'RBM_CPTS' ) ) {
    
}
else {
    
    add_action( 'admin_notices', 'lfl_rbm_cpts_inactive' );
    
}

// Run if RBM Field Helpers is active
if ( class_exists( 'RBM_FieldHelpers' ) ) {
    
}
else {
    
    add_action( 'admin_notices', 'lfl_rbm_fh_inactive' );
    
}

require_once __DIR__ . '/tinymce/localization.php';
require_once __DIR__ . '/tinymce/lfl-button-shortcode.php';

function lfl_rbm_cpts_inactive() { ?>
    
    <div class="error">
        <?php echo apply_filters( 'the_content', sprintf( 
            _x( 'This theme requires %s to be installed!', 'Missing Theme Dependency Error', 'love-from-louie' ),
            '<a href="//github.com/realbig/rbm-cpts" target="_blank"><strong>RBM Custom Post Types</strong></a>'
        ) ); ?>
    </div>
    
<?php
}

function lfl_rbm_fh_inactive() { ?>
    
    <div class="error">
        <?php echo apply_filters( 'the_content', sprintf( 
            _x( 'This theme requires %s to be installed!', 'Missing Theme Dependency Error', 'love-from-louie' ),
            '<a href="//github.com/realbig/rbm-field-helpers" target="_blank"><strong>RBM Field Helpers</strong></a>'
        ) ); ?>
    </div>
    
<?php
}