<?php
/**
 * The theme's header file that appears on EVERY page.
 *
 * @since   0.1.0
 * @package Love_From_Louie
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width">

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <!--[if lt IE 9]>
            <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/vendor/js/html5.js"></script>
        <![endif]-->

        <?php wp_head(); ?>

    </head>

    <body <?php body_class( 'off-canvas-wrapper' ); ?>>

        <div id="wrapper" class = "off-canvass-wrapper-inner" data-off-canvas-wrapper>

            <div class="off-canvas position-left nav-menu" id="offCanvasLeft" data-off-canvas>

                <?php
                wp_nav_menu( array(
                    'container' => false,
                    'menu' => __( 'Primary Menu', 'love-from-louie' ),
                    'menu_class' => 'menu',
                    'theme_location' => 'primary-menu',
                    'items_wrap' => '<ul id="%1$s" class="vertical %2$s">%3$s</ul>',
                    'fallback_cb' => false,
                    'walker' => new Foundation_Nav_Walker(),
                ) );
                ?>

            </div>

            <div class="off-canvas-content" data-off-canvas-content>

                <header id="site-header">
                    
                    <?php if ( is_front_page() ) : ?>
                    
                        <?php locate_template( 'partials/static/header-logo.php', true ); ?>
                    
                    <?php endif; ?>

                    <div class="top-bar">

                        <div class="top-bar-left top-bar-band row expanded">
							
							<div class="small-12 top-bar-band-container columns">
                            
								<div class="show-for-small-only menu-icon-container" data-responsive-toggle="responsive-menu" data-hide-for="medium">
									<button type="button" data-open="offCanvasLeft">
										<span class="menu-icon"></span>
										<div class="menu-icon-text">
											<?php echo _x( 'Menu', 'Hamburger Button Label', 'love-from-louie' ); ?>
										</div>
									</button>
								</div>

								<div class="top-bar-right hide-for-small-only nav-menu">
									<?php
									wp_nav_menu( array(
										'container' => false,
										'menu' => __( 'Primary Menu', 'love-from-louie' ),
										'menu_class' => 'dropdown menu',
										'theme_location' => 'primary-menu',
										'items_wrap'      => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
										'fallback_cb' => false,
										'walker' => new Foundation_Nav_Walker(),
									) );
									?>
								</div>
						
								<div class="top-bar-right top-bar-logo-no-overlap show-for-small-only">

									<a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
										<img src="<?php echo get_site_icon_url( 30 ); ?>" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
									</a>

								</div>
								
							</div>

                        </div>
						
						<div class="top-bar-left top-bar-logo hide-for-small-only">
						
							<a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
								<img src="<?php echo get_site_icon_url( 175 ); ?>" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
							</a>
							
						</div>

                    </div>

                </header>

                <section id="site-content">
                    
                    <?php if ( ! is_front_page() ) : ?>
                    
                        <div class="row">
                            <div class="small-12 columns">
                                <?php lfl_custom_breadcrumbs(); ?>
                            </div>
                        </div>
                    
                    <?php endif; ?>