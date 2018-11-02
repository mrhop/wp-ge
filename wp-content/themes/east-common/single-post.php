<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package east-common
 */

get_header();
$east_common_site_id = get_theme_mod('site_id');
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
            while (have_posts()) :
                the_post();
                if ($east_common_site_id == 'eutecc') {
                    $category = get_the_category();
                    $categorySlug = $category[0]->slug
                    ?>
                    <div class="container">
                        <div class="title">
                            <span class="triangle-bottomright"></span>
                            <?php if ($categorySlug == 'events') { ?>
                                <span class="h3"><?php echo __('EVENTS SUPPORTED BY EUTECC', 'east-common') ?></span>
                            <?php } ?>
                        </div>
                        <?php
                        get_template_part('eutecc/post', $categorySlug);
                        ?>
                    </div>
                <?php } else if ($east_common_site_id == 'huande') {
                $category = get_the_category();
                $categorySlug = $category[0]->slug
                ?>
                <div class="container">
                    <?php
                    get_template_part('huande/post', $categorySlug);
                    ?>
                </div>
            <?php } else {
                    get_template_part('template-parts/content', get_post_type());
                    the_post_navigation();
                }
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
            endwhile; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
