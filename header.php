<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package THEMENAME
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="web_author" content="Digitoimisto Dude Oy, moro@dude.fi" />

<title><?php wp_title('&#124;', true, 'right'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/icon-ipad.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/icon-retina.png">

<!-- HTML5 Shim and Respond.js - IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

<div class="header-container">

	<div class="container">

		<header class="site-header navslide">
	
				<div class="logoarea">

					<div class="nav-toggle">
            			<a href="#" class="nav-toggle navslide" id="navToggle"><span class="burger-icon"></span></a>
            		</div>

				<div class="site-branding">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
					<p class="site-description screen-reader-text"><?php bloginfo( 'description' ); ?></p>
				</div><!-- .site-branding -->

				</div>
	
		</header>

	        <?php
    		wp_nav_menu( array(
    		    'menu'              => 'primary',
    		    'theme_location'    => 'primary',
    		    'container'       	=> 'nav',
    		    'depth'             => 2,
    		    'container_class'   => 'navslide nav nav-collapse',
    		    'menu_class'        => 'menu',
                'menu_id' 			=> 'menu',
                'echo'            	=> true,
    		    'fallback_cb'       => 'wp_page_menu',
    		    // breakpointin pitää olla sama kuin layout.scss:n $responsivenav!
    		    'items_wrap'      	=> '<ul class="%2$s" id="%1$s" data-breakpoint="872">%3$s</ul>',
    		    'walker'            => new dude_navwalker())
    		);
            ?>

	</div><!--/.container-->
	
</div><!--/.header-container-->

<div class="content site-content navslide">