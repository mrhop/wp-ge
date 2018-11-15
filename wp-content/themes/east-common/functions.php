<?php
/**
 * east-common functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package east-common
 */

if (!function_exists('east_common_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function east_common_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on east-common, use a find and replace
         * to change 'east-common' to the name of your theme in all the template files.
         */
        load_theme_textdomain('east-common', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'east-common'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('east_common_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'east_common_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function east_common_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('east_common_content_width', 640);
}

add_action('after_setup_theme', 'east_common_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

// short code

function wpb_list_child_pages()
{
    global $post;
    if (is_page() && $post->post_parent) {
        $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0');
    } else {
        $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0');
    }
    if ($childpages) {
        $string = '<ul class="child-pages">' . $childpages . '</ul>';
    }
    return $string;
}


function register_shortcodes()
{
    add_shortcode('wpb_childpages', 'wpb_list_child_pages');
}

add_action('init', 'register_shortcodes');

function east_common_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'east-common'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'east-common'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}


add_action('widgets_init', 'east_common_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function east_common_scripts()
{

    $east_common_site_id = get_theme_mod('site_id');
    wp_enqueue_style('east-animate-style', get_template_directory_uri() . '/assets/css/animate.min.css');
    wp_enqueue_style('east-swiper-style', get_template_directory_uri() . '/assets/css/swiper.min.css');
    wp_enqueue_style('east-flexslider-style', get_template_directory_uri() . '/assets/css/flexslider.css');

    if (!empty($east_common_site_id)) {
        wp_enqueue_style('east-' . $east_common_site_id . '-style', get_template_directory_uri() . '/assets/css/common-' . $east_common_site_id . '.css');
    }


    wp_enqueue_script('east-common-jquery', get_template_directory_uri() . '/assets/js/jquery-2.2.4.min.js', array(), false, true);
    wp_enqueue_script('east-common-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), false, true);
    wp_enqueue_script('east-common-swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', array(), false, true);
    wp_enqueue_script('east-common-flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array(), false, true);
    if (!empty($east_common_site_id)) {
        // special here
        if (strcmp($east_common_site_id, 'gmp') == 0) {
            // when gmp site here
            wp_enqueue_script('east-common-imageMapResizer', get_template_directory_uri() . '/assets/js/imageMapResizer.min.js', array(), false, true);
            wp_enqueue_script('east-common-scrollMonitor', get_template_directory_uri() . '/assets/js/scrollMonitor.js', array(), false, true);
            wp_enqueue_script('east-common-maphilight', get_template_directory_uri() . '/assets/js/jquery.maphilight.min.js', array(), false, true);

        }
        wp_enqueue_script('east-common-' . $east_common_site_id, get_template_directory_uri() . '/assets/js/common-' . $east_common_site_id . '.js', array(), false, true);

    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'east_common_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

