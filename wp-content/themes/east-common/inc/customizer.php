<?php
/**
 * east-common Theme Customizer
 *
 * @package east-common
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function east_common_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    $wp_customize->add_setting('site_id', array(
        'default' => '',
        'type' => 'theme_mod',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('site_id', array(
        'label' => __('Site Id', 'east-common'),
        'section' => 'title_tagline',
        'priority' => 1
    ));

    $wp_customize->add_setting('site_logo', array(
        'default' => '',
        'type' => 'theme_mod',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'site_logo',
        array(
            'label' => __('Site Logo', 'east-common'),
            'section' => 'title_tagline',
            'priority' => 1
        )
    ));

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector' => '.site-title a',
            'render_callback' => 'east_common_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector' => '.site-description',
            'render_callback' => 'east_common_customize_partial_blogdescription',
        ));
    }
}

add_action('customize_register', 'east_common_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function east_common_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function east_common_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function east_common_customize_preview_js()
{
    wp_enqueue_script('east-common-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}

add_action('customize_preview_init', 'east_common_customize_preview_js');
