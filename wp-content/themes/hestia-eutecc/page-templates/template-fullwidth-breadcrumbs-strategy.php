<?php
/**
 * Template Name: Fullwidth Breadcrumbs strategy Template
 *
 * The template for the full-width page with breadcrumbs.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

get_header();

/**
 * Don't display page header if header layout is set as classic blog.
 */
do_action('hestia_before_single_page_wrapper'); ?>

<div class="<?php echo hestia_layout(); ?>">
    <?php
    $class_to_add = '';
    if (class_exists('WooCommerce') && !is_cart()) {
        $class_to_add = 'blog-post-wrapper';
    }
    ?>
    <div class="blog-post <?php echo esc_attr($class_to_add); ?> hestia-east strategy-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col col-md-8 col-md-offset-4">
                    <div class="breadcrumbs " typeof="BreadcrumbList" vocab="https://schema.org/">
                        <?php if (function_exists('bcn_display')) {
                            bcn_display();
                        } ?>
                    </div>
                </div>
            </div>
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content-fullwidth', 'page');
                endwhile;
            else :
                get_template_part('template-parts/content', 'none');
            endif;
            ?>
        </div>
    </div>

    <?php get_footer(); ?>
