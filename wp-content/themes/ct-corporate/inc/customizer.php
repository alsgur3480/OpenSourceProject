<?php
/**
 * CT Corporate Theme Customizer
 *
 * @package CT Corporate
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('ct_corporate_customize_register')) :
    function ct_corporate_customize_register($wp_customize)
    {
        $wp_customize->get_setting('blogname')->transport = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
        //$wp_customize->get_setting( 'display_header_text' )->transport = 'postMessage';

        if (isset($wp_customize->selective_refresh)) {
            $wp_customize->selective_refresh->add_partial('blogname', array(
                'selector' => '.site-title a',
                'render_callback' => 'ct_corporate_customize_partial_blogname',
            ));
            $wp_customize->selective_refresh->add_partial('blogdescription', array(
                'selector' => '.site-description',
                'render_callback' => 'ct_corporate_customize_partial_blogdescription',
            ));
        }

    }

    add_action('customize_register', 'ct_corporate_customize_register');
endif;

function ct_corporate_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 *
 * @return void
 */
function ct_corporate_customize_partial_blogdescription()
{
    bloginfo('description');
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if (!function_exists('ct_corporate_customize_preview_js')) :
    function ct_corporate_customize_preview_js()
    {
        wp_enqueue_script('ct-corporate-customizer-js', trailingslashit(get_template_directory_uri()) . 'js/customizer.js');

    }

    add_action('customize_preview_init', 'ct_corporate_customize_preview_js');
endif;

function ct_corporate_customize_main_js()
{
    wp_enqueue_script('ct-corporate-customizer-main-js', trailingslashit(get_template_directory_uri()) . 'js/customizer-main.js');
    wp_localize_script('ct-corporate-customizer-main-js', 'objectL10n', array(
        'response' => esc_html__('You can select upto 3 pages only', 'ct-corporate'),
    ));
}

add_action('customize_controls_enqueue_scripts', 'ct_corporate_customize_main_js');

/**
 *
 * Panel for customizers
 *
 **/
get_template_part('/inc/ct-corporate-customize-control');

if (!function_exists('ct_corporate_customizer_panels')) :
    function ct_corporate_customizer_panels($wp_customize)
    {

        $wp_customize->add_panel('CTCorporate_theme_panel', array(
            'priority' => 25,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __('Theme Options', 'ct-corporate'),
            'description' => '',
        ));
    }

    add_action('customize_register', 'ct_corporate_customizer_panels');
endif;

/************************************************/
/*           Section For Header Logo           */
/***********************************************/
if (!function_exists('ct_corporate_header_section')) :
    function ct_corporate_header_section($wp_customize)
    {

        // New Layout and Design

        $wp_customize->add_section('section_layout_design', array(
                'title' => __('Layout and design', 'ct-corporate'),
                'label' => __('Layout and design. ', 'ct-corporate'),
                'panel' => 'CTCorporate_theme_panel',
                'priority' => 1,
            )
        );

        $wp_customize->add_setting('layout_control', array(
                'default' => 'boxed',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'ct_corporate_sanitize_select',
            )
        );
        $wp_customize->add_control('layout_control', array(
                'label' => __('Choose Layout', 'ct-corporate'),
                'section' => 'section_layout_design',
                'type' => 'radio',
                'choices' => array(
                    'boxed' => __('Boxed', 'ct-corporate'),
                    'fullwidth' => __('Full Width', 'ct-corporate'),
                ),
                'priority' => 5,
            )
        );

        $wp_customize->add_setting('layout_picker', array(
                'default' => "3",
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(new ct_corporate_Layout_Picker_Custom_Control($wp_customize, 'layout_picker', array(
                    'label' => __('Layout picker', 'ct-corporate'),
                    'section' => 'section_layout_design',
                    'settings' => 'layout_picker',
                    'priority' => 6,
                )
            )
        );
    }

    add_action('customize_register', 'ct_corporate_header_section');
endif;
/****************************************************************************/
/*                Section For Footer Testimonial                            */
/****************************************************************************/
if (!function_exists('ct_corporate_footer_testimonial_customizer')) :
    function ct_corporate_footer_testimonial_customizer($wp_customize)
    {
        $wp_customize->add_section('testimonial_section', array(
                'title' => __('Testimonial', 'ct-corporate'),
                'description' => __('This is a section for Testimonial of Clients', 'ct-corporate'),
                'panel' => 'CTCorporate_theme_panel',
                'priority' => 6,
            )
        );

        $wp_customize->add_setting('author_name', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control('author_name', array(
                'label' => __('Name of The Person', 'ct-corporate'),
                'section' => 'testimonial_section',
                'type' => 'text',
                'priority' => 1,
            )
        );

        $wp_customize->add_setting('testimonial_content', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_textarea_field'
        ));

        $wp_customize->add_control('testimonial_content', array(
                'label' => __('The Content for the Testimonial', 'ct-corporate'),
                'section' => 'testimonial_section',
                'settings' => 'testimonial_content',
                'type' => 'textarea',
                'priority' => 2,
            )

        );
    }

    add_action('customize_register', 'ct_corporate_footer_testimonial_customizer');
endif;

/**
 *
 * Customizer for the footer page
 *
 **/
if (!function_exists('ct_corporate_front_page_customize')) {
    function ct_corporate_front_page_customize($wp_customize)
    {

        /****************************************************************************/
        /* General Setting for Footer Content  */
        /****************************************************************************/

        $wp_customize->add_section('footer_section', array(
                'title' => __('Call To Action', 'ct-corporate'),
                'description' => __('This is a section for Call to Action of the site above the testimonial.', 'ct-corporate'),
                'panel' => 'CTCorporate_theme_panel',
                'priority' => 5,
            )
        );

        $wp_customize->add_setting('cta_heading', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control('cta_heading', array(
                'label' => __('Call To Action Title', 'ct-corporate'),
                'section' => 'footer_section',
                'type' => 'text',
                'priority' => 1,
            )
        );

        $wp_customize->add_setting('cta_content_text', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_textarea_field',
        ));

        $wp_customize->add_control('cta_content_text', array(
                'label' => __('The Content for the Call To Action Section', 'ct-corporate'),
                'section' => 'footer_section',
                'settings' => 'cta_content_text',
                'priority' => 2,
                'type' => 'textarea',

            )
        );

        $wp_customize->add_setting('cta_link_url', array(
                'default' => '#',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );
        $wp_customize->add_control('cta_link_url', array(
                'label' => __('Button URL', 'ct-corporate'),
                'section' => 'footer_section',
                'type' => 'url',
                'priority' => 3,
            )
        );
        $wp_customize->add_setting('cta_link_text', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control('cta_link_text', array(
                'label' => __('Button Text', 'ct-corporate'),
                'section' => 'footer_section',
                'type' => 'text',
                'priority' => 4,
            )
        );
        $wp_customize->add_setting('section_background', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'section_background', array(
                    'label' => __('Background Image', 'ct-corporate'),
                    'section' => 'footer_section',
                    'settings' => 'section_background',
                    'priority' => 5,
                )
            )
        );

        /***********************************/
        /*** Slider *****/
        /**********************************/

        $wp_customize->add_section('CTCorporate_front_page', array(
            'title' => __('Slider Options', 'ct-corporate'),
            'panel' => 'CTCorporate_theme_panel',
            'priority' => 2,
        ));

        $wp_customize->add_setting('featured_post', array(
            'default' => 'none',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'ct_corporate_text_sanitize',
        ));

        $wp_customize->add_control(new ct_corporate_Page_Dropdown_control($wp_customize, 'featured_post', array(
            'label' => __('Select a Page for slider', 'ct-corporate'),
            'section' => 'CTCorporate_front_page',
            'priority' => 1,
        )));

        /******************************/
        /***** Posts below slider *****/
        /******************************/

        $wp_customize->add_section('CTCorporate_callout', array(
            'title' => __('Call Out Options', 'ct-corporate'),
            'panel' => 'CTCorporate_theme_panel',
            'priority' => 3,
        ));

        $wp_customize->add_setting('first_post_title', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('first_post_title', array(
            'label' => __('Section Title', 'ct-corporate'),
            'section' => 'CTCorporate_callout',
            'priority' => 2,
        ));

        $wp_customize->add_setting('first_post', array(
            'default' => 'none',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'ct_corporate_text_sanitize',
        ));
        $wp_customize->add_control(new ct_corporate_Page_Dropdown_control($wp_customize, 'first_post', array(
            'label' => __('Select 3 Pages To Show Below Slider', 'ct-corporate'),
            'description' => __('Select a category to display post below the slider', 'ct-corporate'),
            'section' => 'CTCorporate_callout',
            'priority' => 3,

        )));

        // title for portfolio section

        $wp_customize->add_section('CTCorporate_portfolio', array(
            'title' => __('Portfolio Options', 'ct-corporate'),
            'panel' => 'CTCorporate_theme_panel',
            'priority' => 4,
        ));

        $wp_customize->add_setting('portfolio_post_title', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('portfolio_post_title', array(
            'label' => __('Title for Portfolio Section', 'ct-corporate'),
            'section' => 'CTCorporate_portfolio',
            'priority' => 4,
        ));


        /**********************************************/
        /*** From the blog ***/
        /*******************************************/

        $wp_customize->add_section('CTCorporate_blog', array(
            'title' => __('Blog Options', 'ct-corporate'),
            'panel' => 'CTCorporate_theme_panel',
            'priority' => 5,
        ));

        $wp_customize->add_setting('excerpt_length', array(
                'default' => 20,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control('excerpt_length', array(
                'label' => __('Excerpt Length', 'ct-corporate'),
                'section' => 'CTCorporate_blog',
                'type' => 'text',
            )
        );

        $wp_customize->add_setting('show_blog_meta', array(
            'default' => 1,
            'sanitize_callback' => 'ct_corporate_sanitize_checkbox'
        ));

        $wp_customize->add_control('show_blog_meta', array(
            'label' => esc_attr(__('Show Meta In Blog?', 'ct-corporate')),
            'section' => 'CTCorporate_blog',
            'settings' => 'show_blog_meta',
            'type' => 'checkbox'
        ));
    }
}
add_action('customize_register', 'ct_corporate_front_page_customize');

/******************************************************************/
/*              Social Media Section                              */
/******************************************************************/
if (!function_exists('ct_corporate_social_media_section')) :
    function ct_corporate_social_media_section($wp_customize)
    {

        $wp_customize->add_section('social_media_section', array(
                'title' => __('Social Media Options', 'ct-corporate'),
                'panel' => 'CTCorporate_theme_panel',
                'priority' => 8,
            )

        );

        $wp_customize->add_setting('site_facebook_link', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control('site_facebook_link', array(
                'label' => __('Facebook Link', 'ct-corporate'),
                'section' => 'social_media_section',
                'type' => 'url',
                'priority' => 3,
            )
        );

        $wp_customize->add_setting('site_twitter_link', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control('site_twitter_link', array(
                'label' => __('Twitter Link', 'ct-corporate'),
                'section' => 'social_media_section',
                'type' => 'url',
                'priority' => 4,
            )
        );

        $wp_customize->add_setting('site_gplus_link', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control('site_gplus_link', array(
                'label' => __('Google Plus Link', 'ct-corporate'),
                'section' => 'social_media_section',
                'type' => 'url',
                'priority' => 5,
            )
        );

        $wp_customize->add_setting('site_youtube_link', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control('site_youtube_link', array(
                'label' => __('YouTube Link', 'ct-corporate'),
                'section' => 'social_media_section',
                'type' => 'url',
                'priority' => 6,
            )
        );

        $wp_customize->add_setting('site_instagram_url', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control('site_instagram_url', array(
                'label' => __('Instagram Link', 'ct-corporate'),
                'section' => 'social_media_section',
                'type' => 'url',
                'priority' => 7,
            )
        );

        $wp_customize->add_setting('linkedin_url', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control('linkedin_url', array(
                'label' => __('Linkedin URL', 'ct-corporate'),
                'section' => 'social_media_section',
                'type' => 'url',
                'priority' => 8,
            )
        );

        $wp_customize->add_setting('site_pinterest_link', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control('site_pinterest_link', array(
                'label' => __('Pinterest Link', 'ct-corporate'),
                'section' => 'social_media_section',
                'type' => 'url',
                'priority' => 9,
            )
        );

        $wp_customize->add_setting('site_dribble_link', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control('site_dribble_link', array(
                'label' => __('Dribble Link', 'ct-corporate'),
                'section' => 'social_media_section',
                'type' => 'url',
                'priority' => 10,
            )
        );

        $wp_customize->add_setting('site_email_address', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_email',
            )
        );

        $wp_customize->add_control('site_email_address', array(
                'label' => __('Email Address', 'ct-corporate'),
                'section' => 'social_media_section',
                'type' => 'email',
                'priority' => 11,
            )
        );

        $wp_customize->add_setting('site_skype_address', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control('site_skype_address', array(
                'label' => __('Skype/Phone', 'ct-corporate'),
                'section' => 'social_media_section',
                'type' => 'url',
                'priority' => 12,
            )
        );


        /***************************************/
        /* Social Media Background */
        /**************************************/

        $wp_customize->add_setting('social_media_title', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control('social_media_title', array(
                'label' => __('Title for social media section.', 'ct-corporate'),
                'section' => 'social_media_section',
                'settings' => 'social_media_title',
                'priority' => 1,
            )
        );

        $wp_customize->add_setting('social_media_background', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control(new WP_Customize_Image_Control ($wp_customize, 'social_media_background', array(
                    'label' => __('Social Media Background Image', 'ct-corporate'),
                    'description' => __('Upload an background image for "Social Media" section', 'ct-corporate'),
                    'section' => 'social_media_section',
                    'priority' => 2,
                )
            )
        );

        //ADD/CHANGE CSS
        $version_wp = get_bloginfo('version');
        if ($version_wp < 4.7) {
            $wp_customize->add_section(
                'change_css',
                array(
                    'title' => __('Custom CSS', 'ct-corporate'),
                    'description' => __('Here you can customize Your theme\'s css', 'ct-corporate'),
                    'panel' => 'CTCorporate_theme_panel',
                    'capability' => 'edit_theme_options',
                    'priority' => 40,
                )
            );
            $wp_customize->add_setting(
                'css_change',
                array(
                    'default' => '',
                    'sanitize_callback' => 'sanitize_textarea_field',
                    'capability' => 'edit_theme_options',
                )
            );
            $wp_customize->add_control('ct-corporate_css_change', array(
                'label' => __('Add CSS', 'ct-corporate'),
                'type' => 'textarea',
                'section' => 'change_css',
                'settings' => 'css_change',
            ));
        }

        $wp_customize->add_section(
            'documentation',
            array(
                'title' => __('Documentation and Support', 'ct-corporate'),
                'capability' => 'edit_theme_options',
                'priority' => 1,
            )
        );
        $wp_customize->add_setting(
            'doc_supp',
            array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
                'capability' => 'edit_theme_options',
            )
        );

        $wp_customize->add_control(new ct_corporate_documentation_Custom_Text_Control($wp_customize, 'doc_supp', array(
                'section' => 'documentation',
                'type' => 'customtext',
                'extra' => __('Font settings available in Pro version. Buy Pro Version', 'ct-corporate'),
            ))
        );


    }

    add_action('customize_register', 'ct_corporate_social_media_section');
endif;

get_template_part('inc/customizer', 'sanitization');