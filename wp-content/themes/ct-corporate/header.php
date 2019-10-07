<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package CT Corporate
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<?php
    $boxedornot = ct_corporate_boxedornot();
    $pageclass = 'boxed-layout';
    if ($boxedornot == 'fullwidth') {
        $pageclass = 'fullwidth-layout';
    }
    else{
        $pageclass = 'boxed-layout container';
    }
    $bodyclass = array($pageclass);

?>
<body <?php body_class($bodyclass); ?>>

<div id="themenu" class="hide mobile-navigation">
      <?php
        $args = array(
          'theme_location' => 'primary',
          'depth'               => 4,
          );
        wp_nav_menu($args);
      ?>
  </div>
  <!-- Mobile Navigation -->

<div id="page" class="hfeed site site_wrapper thisismyheader">

    <?php do_action( 'before' ); ?>

    <header id="masthead" class="site-header" role="banner">
        <nav id="site-navigation" class="main-navigation navbar <?php if ($boxedornot == 'boxed') {?>container<?php }?>" role="navigation">

            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content','ct-corporate' ); ?></a>

            <?php if ($boxedornot == 'fullwidth') {?>
                <div class="container">
            <?php }?>

            <div class="navbar-header">

                <div class="site-branding navbar-brand">
                    <?php
                         if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                            echo ' <div class="site-brand text-center">';
                                the_custom_logo();
                            echo '</div>';
                        }
                        else { ?>

                        <!-- Remove the site title and desc if logo is specified -->
                        <div class="site-desc site-brand text-center">
                        	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        	<h5 class="site-description"><?php bloginfo( 'description' ); ?></h5>
                        </div>
                    <?php } ?>

                </div>
                <!-- End the Site Brand -->

                <a href="#themenu" type="button" class="navbar-toggle" role="button" id="hambar">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </a>

            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse-main">
                <?php

                    if (has_nav_menu('primary')) {
                        wp_nav_menu( array(
                                'theme_location'  => 'primary',
                                'container'       => false,
                                'depth'           => 4,
                                'menu_class'      => 'nav navbar-nav navbar-right main-site-nav',
                                'walker'          => new ct_corporate_bootstrap_nav_menu(),
                            ) );
                    } else {
                         wp_page_menu( array(
								'depth'       => -1,
								'menu_class'  => 'menu fallback_menu_default'
						 ));
                    }
                        ?>
            </div>
            <!-- End /.navbar-collapse -->

            <?php if ($boxedornot == 'fullwidth') {?>
                </div>
            <?php }?>

        </nav>
        <!-- End #site-navigation -->
	</header>
    <!-- End #masthead -->

	<div id="content-wrap" class="site-content">