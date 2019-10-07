<?php
/**
 * CT Corporate Theme functions and definitions
 *
 * @package CT Corporate
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 640; /* pixels */
}

if ( ! function_exists( 'ct_corporate_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ct_corporate_setup() {

    /**
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on CT Corporate Theme, use a find and replace
     * to change'ct-corporate' to the name of your theme in all the template files
     */
    load_theme_textdomain('ct-corporate', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'title-tag' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'custom-logo' );

    // add_theme_support( 'custom-header', array(
    //      'video' => true,
    //     ) );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    load_theme_textdomain('ct-corporate', get_template_directory() . '/languages/');


    add_image_size( 'ct_corporate_post_size', 800, 500, true );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary'   => __( 'Header Menu','ct-corporate' ),
        ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ) );

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'ct_corporate_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
        'default-repeat'=> 'repeat',
        ) ) );

    //Site logo from jetpack
    $args = array(
        'header-text' => array(
            'site-title',
            'site-description',
            ),
        'size' => 'medium',
        );
    add_theme_support( 'site-logo', $args );

}
endif; // ct_corporate_setup
add_action( 'after_setup_theme', 'ct_corporate_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
if (! function_exists('ct_corporate_widgets_init') ) {
    function ct_corporate_widgets_init() {
        register_sidebar( array(
            'name'          => __( 'Sidebar','ct-corporate' ),
            'id'            => 'sidebar-1',
            'description'   => __( 'CT Corporate Sidebar','ct-corporate' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            ) );

        register_sidebar( array(
            'name'          => __( 'Footer 1','ct-corporate' ),
            'id'            => 'footer-1',
            'description'   => __( 'Footer 1','ct-corporate' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            ) );

        register_sidebar( array(
            'name'          => __( 'Footer 2','ct-corporate' ),
            'id'            => 'footer-2',
            'description'   => __( 'Footer 2','ct-corporate' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            ) );

        register_sidebar( array(
            'name'          => __( 'Footer 3','ct-corporate' ),
            'id'            => 'footer-3',
            'description'   => __( 'Footer 3','ct-corporate' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            ) );
    }
    add_action( 'widgets_init', 'ct_corporate_widgets_init' );
}

if (! function_exists('ct_corporate_add_editor_styles') ) {
    function ct_corporate_add_editor_styles() {
        add_editor_style( 'css/editor-style.css' );
    }
    add_action( 'admin_init', 'ct_corporate_add_editor_styles' );
}

if ( ! function_exists( 'CT_Corporate_fonts_url' ) ) :
    function CT_Corporate_fonts_url() {
        $fonts_url = '';
        $fonts     = array();

        if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'ct-corporate' ) ) {
            $fonts[] = 'Montserrat:300,400';
        }

        if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'ct-corporate' ) ) {
            $fonts[] = 'Poppins';
        }
        if ( 'off' !== _x( 'on', 'Alex Brush font: on or off', 'ct-corporate' ) ) {
            $fonts[] = 'Alex Brush';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
            ), '//fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;


/**
 * Enqueue scripts and styles.
 */

if(! function_exists('ct_corporate_scripts')){
	function ct_corporate_scripts() {
        wp_enqueue_style( 'ct-corporate-lite-fonts', CT_Corporate_fonts_url() , array(), null);
        wp_enqueue_style( 'ct-corporate-style', get_template_directory_uri() );
		wp_enqueue_style( 'ct-corporate-css', get_template_directory_uri() . '/css/ct-corporate.css' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script( 'mmenu-js', get_template_directory_uri() . '/js/vendor/mmenu.min.js', array( 'jquery' ), 'v5.4.0', true );
		wp_enqueue_script( 'ct-corporate-functions-js', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), 'v3.3.2', true );
		wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.js', array( 'jquery' ), 'v3.3.2', true );
        wp_enqueue_script( 'ct-corporate-vendor-js', get_template_directory_uri() . '/js/vendor.js');
        wp_localize_script('slick-js', 'custom_localize', array(
            'prev' => esc_html__('Previous', 'ct-corporate'),
            'next' => esc_html__('Next', 'ct-corporate'),
        ));

		$social_media_background = ( esc_attr( get_theme_mod('social_media_background' ) ) ) ? esc_attr( get_theme_mod('social_media_background' ) ) : '';
		$maxContainerWidth = '1170';
		$bg_color_404 =   esc_attr( get_theme_mod('background_color') );
		$width = '';
        $version_wp = get_bloginfo('version');
        if($version_wp < 4.7){
            $site_css_change = ( get_theme_mod( 'css_change' ) ) ? get_theme_mod( 'css_change' ) : '';
        }
        else{
            $site_css_change = "";
        }


	    if ( get_theme_mod('max_width') != '' ) {
	    	$containerWidth = '100';
	        $maxContainerWidth = get_theme_mod('max_width');
	        $width = "width: {$containerWidth}%";
	    }

	    $minContainerWidth = '1170';
		$min_width = '';
		$header_text_color = get_header_textcolor();
		$desc_color =  $header_text_color;
        $custom_css = "
    		@media (min-width: 1200px){
				.container {
					max-width: {$maxContainerWidth}px;
					".$width."
				}
			}
            .image-404{
                background-color: #{$bg_color_404} ;
            }

	        .site-title a{ color: {$desc_color}  ;}

			.social-section{
			    background-image: url($social_media_background);
			}
                $site_css_change

            ";
        wp_add_inline_style( 'ct-corporate-css', $custom_css );
	}
	add_action( 'wp_enqueue_scripts', 'ct_corporate_scripts' );

}

/**
*
* Layout functions
*
**/
if(! function_exists('ct_corporate_boxedornot')){
    function ct_corporate_boxedornot() {
        $boxedornot = 'boxed';
        if ( get_theme_mod('layout_control') != '' ) {
            $boxedornot = esc_attr( get_theme_mod('layout_control') );
        }
        return $boxedornot;
    }
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/custom-header.php';


/**
 * Customizer additions.
 */

get_template_part('inc/customizer');

/**
 * Breadcrumb Option.
 */
require get_template_directory() . '/inc/custom-breadcrumb.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Bootstrap integration
*/
require get_template_directory() . '/inc/functions-strap.php';

if(! function_exists('ct_corporate_trim_excerpt')){
    function ct_corporate_trim_excerpt( $text ) {
        global $post;
        if ( '' == $text ) {
            $text = get_the_content('');
            $text = apply_filters( 'the_content', $text );
            $text = str_replace( '\]\]\>', ']]&gt;', $text );
            $alllowed_tags = '<iframe>,<script>,<cite>,<div>,<video>,<audio>,<caption>';
            $text = strip_tags( $text, $alllowed_tags );
            $excerpt_length = 55;
            $words = explode( ' ', $text, $excerpt_length + 1 );
            if ( count( $words )> $excerpt_length ) {
                array_pop( $words );
                array_push( $words, '<p><a class="readmore" href="'. esc_url( get_permalink( get_the_ID() ) ) . '">' . __('Read More','ct-corporate') . '<span class="meta-nav"><i class="fa fa-long-arrow-right fa-btn"></i></span></a></p>' );
                $text = implode( ' ', $words );
            }
        }
        return $text;
    }
    add_filter( 'get_the_excerpt', 'ct_corporate_trim_excerpt', 10, 1 );
}

if(! function_exists('ct_corporate_localize_jetpack')){
    function ct_corporate_localize_jetpack() {
    $active_plugins = get_option( 'active_plugins' );
    $jetpack_plugin = 'jetpack/jetpack.php';
    if ( in_array( $jetpack_plugin, $active_plugins ) && wp_script_is( 'jetpack-carousel', 'enqueued' ) ) {
    $jetpack = 1;
    } else {
    $jetpack = 0;
    }
    return $jetpack;
    }
}

if(! function_exists('ct_corporate_woocommerce_support')){
    add_action( 'after_setup_theme', 'ct_corporate_woocommerce_support' );
    function ct_corporate_woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }
}

// Disqus Mods
/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Shorten title
if ( ! function_exists( 'ct_corporate_limit_title' ) ) {
    function ct_corporate_limit_title($text, $chars_limit){
        // Change to the number of characters you want to display
        $chars_text = strlen($text);
        $text = $text." ";
        $text = substr($text,0,$chars_limit);
        $text = substr($text,0,strrpos($text,' '));
                // If the text has more characters that your limit,
                //add ... so the user knows the text is actually longer
        if ($chars_text > $chars_limit)
        {
            $text = $text."...";
        }
        return $text;
    }
}
/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part('plugin', 'activation');

if (!  function_exists('ct_corporate_register_required_plugins') ) {
  add_action( 'tgmpa_register', 'ct_corporate_register_required_plugins' );
  /**
   * Register the required plugins for this theme.
   *
   * In this example, we register five plugins:
   * - one included with the TGMPA library
   * - two from an external source, one from an arbitrary source, one from a GitHub repository
   * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
   *
   * The variable passed to tgmpa_register_plugins() should be an array of plugin
   * arrays.
   *
   * This function is hooked into tgmpa_init, which is fired within the
   * TGM_Plugin_Activation class constructor.
   */
  function ct_corporate_register_required_plugins() {
          /*
           * Array of plugin arrays. Required keys are name and slug.
           * If the source is NOT from the .org repo, then source is also required.
           */
          $plugins = array(

            array(
                'name'      => 'Jetpack',
                'slug'      => 'jetpack',
                'required'  => false,
                ),

          );

          /*
           * Array of configuration settings. Amend each line as needed.
           *
           * TGMPA will start providing localized text strings soon. If you already have translations of our standard
           * strings available, please help us make TGMPA even better by giving us access to these translations or by
           * sending in a pull-request with .po file(s) with the translations.
           *
           * Only uncomment the strings in the config array if you want to customize the strings.
           */
          $config = array(
            'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'themes.php',            // Parent menu slug.
            'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.

          );

          tgmpa( $plugins, $config );
        }
}

if ( ! function_exists( 'ct_corporate_the_featured_video' ) ) {
    function ct_corporate_the_featured_video( $content ) {
        $ori_url = explode( "\n", $content );
        $url = $ori_url[0];

        $w = get_option( 'embed_size_w' );
        if ( !is_single() )
            $url = str_replace( '448', $w, $url );
        if ( 0 === strpos( $url, 'https://' ) ) {

            echo apply_filters( 'the_content', $url );
            $content = trim( str_replace( $url, '', $content ) );
        }
        elseif ( preg_match ( '#^<(script|iframe|embed|object)#i', $url ) ) {
            $h = get_option( 'embed_size_h' );
            echo esc_url($url);
            if ( !empty( $h ) ) {

                if ( $w === $h ) $h = ceil( $w * 0.75 );
                $url = preg_replace(
                    array( '#height="[0-9]+?"#i', '#height=[0-9]+?#i' ),
                    array( sprintf( 'height="%d"', $h ), sprintf( 'height=%d', $h ) ),
                    $url
                    );
                echo esc_url($url);
            }

            $content = trim( str_replace( $url, '', $content ) );

        }
    }
}

if(!function_exists('ct_corporate_strip_url_content')){
    function ct_corporate_strip_url_content($posttype, $content_length){
        $strip = explode( ' ' , strip_shortcodes(wp_trim_words( $posttype->post_content  , $content_length )) );
        foreach($strip as $key => $single){
            if (!filter_var($single, FILTER_VALIDATE_URL) === false) {
                unset($strip[$key]);
            }
        }
        return implode( ' ', $strip );
    }
}

if ( function_exists( 'wp_update_custom_css_post' ) ) {
    $custom_css = ( get_theme_mod( 'css_change' )  ? get_theme_mod( 'css_change' ) : '');
    $core_css = wp_get_custom_css();
    if ( !empty($custom_css)  && empty($core_css)  ) {
        $return = wp_update_custom_css_post( $core_css . $custom_css );
    }
}

if ( function_exists( 'ct_corporate_excerpt_more_link' ) ) {
    /* add read more link to post excerpt */
    function ct_corporate_excerpt_more_link( $excerpt ){
        $post = get_post();
        $excerpt .= '<a>'.esc_html__('Read More', 'ct-corporate').'</a>';
        return $excerpt;
    }
    add_filter( 'the_excerpt', 'ct_corporate_excerpt_more_link', 21 );
}

if(!function_exists('ct_corporate_check_sidebar')){
    function ct_corporate_check_sidebar() {

        $check_sidebar = wp_get_sidebars_widgets();
        $sidebar_layout = get_theme_mod('layout_picker');

                if( $sidebar_layout == 1){
                    $sidebar_class = 'no-sidebar';
                }
                else if( $sidebar_layout == 2 && !empty($check_sidebar['sidebar-1'])){
                    $sidebar_class = 'pull-left';
                }
                else if( $sidebar_layout == 3 && !empty($check_sidebar['sidebar-1'])){
                    $sidebar_class = 'pull-right';
                }
                else {
                    $sidebar_class = 'no-selection';
                }
            return $sidebar_class;
    }
}
