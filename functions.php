<?php
/**
 * The theme's functions file that loads on EVERY page, used for uniform functionality.
 *
 * @since   1.0.0
 * @package Love_From_Louie
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Make sure PHP version is correct
if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
	wp_die( 'ERROR in Love From Louie - Theme 2017 theme: PHP version 5.3 or greater is required.' );
}

// Make sure no theme constants are already defined (realistically, there should be no conflicts)
if ( defined( 'THEME_VER' ) ||
	defined( 'THEME_URL' ) ||
	defined( 'THEME_DIR' ) ||
	defined( 'THEME_FILE' ) ||
	isset( $theme_fonts ) ) {
	wp_die( 'ERROR in Love From Louie - Theme 2017 theme: There is a conflicting constant. Please either find the conflict or rename the constant.' );
}

/**
 * Define Constants based on our Stylesheet Header. Update things only once!
 */
$theme_header = wp_get_theme();

define( 'THEME_VER', $theme_header->get( 'Version' ) );
define( 'THEME_URL', get_template_directory_uri() );
define( 'THEME_DIR', get_template_directory() );

/**
 * Fonts for the theme. Must be hosted font (Google fonts for example).
 */
$theme_fonts = array(
	'open-sans' => '//fonts.googleapis.com/css?family=Open+Sans:300italic,700,300,800',
	'droid-sans' => '//fonts.googleapis.com/css?family=Droid+Sans:regular,bold',
	'lobster' => '//fonts.googleapis.com/css?family=Lobster',
	'font-awesome' => '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
);

/**
 * Register theme files.
 *
 * @since 1.0.0
 */
add_action( 'init', function () {

	global $theme_fonts;

	// Theme styles
	wp_register_style(
		'love-from-louie',
		THEME_URL . '/style.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VER
	);

	// Theme script
	wp_register_script(
		'love-from-louie',
		THEME_URL . '/assets/js/script.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VER,
		true
	);

	// Theme fonts
	if ( ! empty( $theme_fonts ) ) {
		foreach ( $theme_fonts as $ID => $link ) {
			wp_register_style(
				'love-from-louie' . "-font-$ID",
				$link
			);
		}
	}
} );

/**
 * Enqueue theme files.
 *
 * @since 1.0.0
 */
add_action( 'wp_enqueue_scripts', function () {

	global $theme_fonts;

	// Theme styles
	wp_enqueue_style( 'love-from-louie' );

	// Theme script
	wp_enqueue_script( 'love-from-louie' );

	// Theme fonts
	if ( ! empty( $theme_fonts ) ) {
		foreach ( $theme_fonts as $ID => $link ) {
			wp_enqueue_style( 'love-from-louie' . "-font-$ID" );
		}
	}
	
} );

/**
 * Register nav menus.
 *
 * @since 1.0.0
 */
add_action( 'after_setup_theme', function () {
	
	register_nav_menu( 'primary-menu', __( 'Primary Menu', 'love-from-louie' ) );
	
} );

/**
 * Register sidebars.
 *
 * @since 1.0.0
 */
add_action( 'widgets_init', function () {
    
    // Main Sidebar
    register_sidebar( array(
    	'name' => __( 'Main Sidebar', 'love-from-louie' ),
    	'id' => 'sidebar-main',
    	'description' => __( 'Displays on Interior Pages.', 'love-from-louie' ),
    ) );
	
	register_sidebar( array(
    	'name' => __( 'Footer Left', 'love-from-louie' ),
    	'id' => 'footer-left',
    	'description' => __( 'Footer Left.', 'love-from-louie' ),
    ) );
	
	register_sidebar( array(
    	'name' => __( 'Footer Center', 'love-from-louie' ),
    	'id' => 'footer-center',
    	'description' => __( 'Footer Center.', 'love-from-louie' ),
    ) );
	
	register_sidebar( array(
    	'name' => __( 'Footer Right', 'love-from-louie' ),
    	'id' => 'footer-right',
    	'description' => __( 'Footer Right.', 'love-from-louie' ),
    ) );
    
} );

/**
 * Setup theme properties and stuff
 * 
 * @since 1.0.0
 * @return void
 */
add_action( 'after_setup_theme', function () {

    // Add theme support
    require_once __DIR__ . '/core/theme-support.php';
	
	// Add theme functions
    require_once __DIR__ . '/includes/theme-functions.php';
	
	// Add Button Shortcode
    require_once __DIR__ . '/includes/shortcodes/lfl-button.php';
	
	// Nav Walker for Foundation
    require_once __DIR__ . '/includes/class-foundation-nav-walker.php';

    // Allow shortcodes in text widget
    add_filter( 'widget_text', 'do_shortcode' );
	
	// Create Hero Image Size
	add_image_size( 'lfl-hero', false, 600 );

} );

/**
 * Add Widgets
 *
 * @since 1.0.0
 */
add_action( 'widgets_init', function() {
    
	if ( class_exists( 'Give' ) ) {
	
		require_once __DIR__ . '/includes/widgets/class-recent-story-donation-widget.php';

		register_widget( 'LFL_Recent_Story_Donation_Widget' );
		
	}
    
} );

/**
 * Force WP Search to work across Post Types
 * 
 * @since 0.1.0
 */
add_filter( 'pre_get_posts', function( $query ) {
    
	if ( $query->is_search ) {
        
		$query->set( 'post_type', array(
			'post',
			'page',
			'lfl-story',
		) );
        
	}
    
	return $query;
    
} );

/**
 * Filter the_archive_title() to be less... robotic
 * 
 * @param       string Archive Title
 *
 * @since       1.0.0
 * @return      string Archive Title
 */
add_filter( 'get_the_archive_title', function( $title ) {
	
	if ( get_post_type() == 'lfl-story' ) {
		
		return _x( 'Our Stories', 'Stories Archive Title', 'love-from-louie' );
		
	}
	else {
    
		// Not really necessary
		return trim( str_replace( 'Archives:', '', $title ) );
		
	}
    
} );

/**
 * "Donation Total" sounds like Total Number of Donations. It isn't what this String actually means though.
 * 
 * @param		string $label Donation Total Label
 *                                      
 * @since		1.0.0
 * @return		string Donation Total Label
 */
add_filter( 'give_donation_total_label', function( $label ) {
	
	return _x( 'Donation Amount', 'Give Donation Total Replacement', 'love-from-louie' );
	
} );

/**
 * Add Localized "label" for the Donation Amount field at the top of Give Forms
 * 
 * @since		1.0.0
 * @return		void
 */
add_action( 'wp_head', function() { 
	
	?>

		<style type="text/css">
			
			.give-donation-amount:before {
				content: '<?php echo _x( 'Donation Amount:', 'Give Donation Total Replacement CSS Content Label Hack', 'love-from-louie' ); ?>' !important;
			}
			
		</style>

	<?php
	
} );

/**
 * Add a dynamic "My Account" Link which has different text for logged and and out users
 * 
 * @param		string $items HTML Representation of Nav Menu Items
 * @param		object $args  WP Nav Menu Object
 *                                   
 * @since		1.0.0
 * @return		string HTML Representation of Nav Menu Items
 */
add_filter( 'wp_nav_menu_items', function( $items, $args ) {
	
	if ( $args->theme_location == 'primary-menu' ) {
		
		$my_account_page_id = get_option( 'woocommerce_myaccount_page_id' );
		
		if ( is_user_logged_in() ) {
			$my_account_link_text = _x( 'My Account', 'My Account Link - Logged in Users', 'love-from-louie' );
		}
		else {
			$my_account_link_text = _x( 'Login', 'My Account Link - Logged Out Users', 'love-from-louie' );
		}
		
		$items .= '<li class="main-menu-item  menu-item-even menu-item-depth-0 menu-item"><a id="my-account-link" href="' . get_permalink( $my_account_page_id ) . '">' . $my_account_link_text . '</a></li>';
		
	}
	
	return $items;
	
}, 10, 2 );

require_once __DIR__ . '/admin/admin.php';