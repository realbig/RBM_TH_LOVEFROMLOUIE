<?php
/**
 * Adds the [lfl_button] shortcode
 *
 * @since   1.0.0
 * @package Love_From_Louie
 * @subpackage  Love_From_Louie/includes/shortcodes
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Add Button Shortcode
 *
 * @since       1.0.0
 * @return      HTML
 */
add_shortcode( 'lfl_button', 'add_lfl_button_shortcode' );
function add_lfl_button_shortcode( $atts, $content ) {
    
    $atts = shortcode_atts(
        array( // a few default values
            'url' => '#',
            'color' => 'primary',
            'size' => 'small',
            'hollow' => 'false',
            'expand' => 'false',
            'new_tab' => 'false',
        ),
        $atts,
        'lfl_button'
    );
    
    ob_start();
    
    if ( ( strpos( $atts['url'], '#' ) !== 0 ) && 
        ( strpos( $atts['url'], 'http' ) !== 0 ) && 
        ( strpos( $atts['url'], '/' ) !== 0 ) 
    ) :
        $atts['url'] = '//' . $atts['url'];
    endif;
    ?>

    <a href="<?php echo $atts['url']; ?>" class="<?php echo $atts['color'] . ' ' . $atts['size'] . ' button' . ( strtolower( $atts['hollow'] == 'true' ) ? ' hollow' : '' ) . ( strtolower( $atts['expand'] == 'true' ) ? ' expanded' : '' ); ?>" target="<?php echo ( strtolower( $atts['new_tab'] ) == 'true' ? '_blank' : '_self' ); ?>"><?php echo $content; ?></a>

    <?php
    
    $output = ob_get_contents();
    ob_end_clean();
    
    return html_entity_decode( $output );
    
}