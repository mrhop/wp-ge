<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package east-common
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>
<?php
global $post;
$post_slug = $post->post_name;
?>
<body <?php body_class(); ?> id="<?php echo $post_slug; ?>">
<div id="page" class="site">
    <div class="header container-fluid">
        <?php
        $site_logo = get_theme_mod('site_logo');
        if (!empty($site_logo)) {
            ?>
            <div class="container top-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo $site_logo ?>"></a>
            </div>
        <?php } ?>
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-1',
                        'menu_id' => 'primary-menu',
                    ));
                    ?>
                </div>
            </div>
        </nav><!-- #site-navigation -->
    </div><!-- #masthead -->
    <?php
    $slider_args = array(
        'post_type' => 'shanyue-p-sections',
        'meta_key' => '_group_slug',
        'meta_value' => 'home-slider',
        'orderby' => 'menu-order',
        'order' => 'asc'
    );
    $slider_query = new   wp_Query($slider_args);
    if ($slider_query->have_posts()) {
    ?>
    <section class="top-slider ">
        <ul class="swiper-container">
            <ul class="swiper-wrapper">
                <?php
                while ($slider_query->have_posts()) {
                    $slider_query->the_post();
                    $ps_meta = get_post_meta($post->ID, '_shanyue_page_sections_data', true);
                    $ps_file_link_id = (!empty($ps_meta['fileLinkId'])) ? $ps_meta['fileLinkId'] : '';
                    // Get the image src
                    if ($ps_file_link_id !== '') {
                        $slider_img_src = wp_get_attachment_image_src($ps_file_link_id, 'full');
                    }
                    if ($ps_file_link_id !== '') {
                        ?>
                        <li class="swiper-slide">
                            <div class="caption">
                                <h1><?php the_content(); ?></h1>
                            </div>
                            <a href="<?php the_permalink($ps_meta['pageRelated']); ?>">
                                <img src="<?php echo $slider_img_src[0]; ?>" style="width: 100%"/></a>
                        </li>
                        <?php
                    }
                    wp_reset_postdata();
                }
                ?>
            </ul>
            <!-- Add Arrows -->
            <div class="fa fa-3x swiper-button fa-chevron-right swiper-button-next">
            </div>
            <div class="fa fa-3x swiper-button fa-chevron-left swiper-button-prev">
            </div>
</div>
<?php
}
?>
<div id="content" class="site-content">
