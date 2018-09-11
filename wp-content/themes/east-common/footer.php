<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package east-common
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <div class="site-info">
        <?php
        $feature_args = array(
            'post_type' => 'shanyue-p-sections',
            'meta_key' => '_group_slug',
            'meta_value' => 'footer-common_' . get_locale(),
            'orderby' => 'menu-order',
            'order' => 'asc'
        );
        $feature_query = new   wp_Query($feature_args);
        if (!$feature_query->have_posts()) {
            $feature_args = array(
                'post_type' => 'shanyue-p-sections',
                'meta_key' => '_group_slug',
                'meta_value' => 'footer-common',
                'orderby' => 'menu-order',
                'order' => 'asc'
            );
            $feature_query = new wp_Query($feature_args);
        }
        if ($feature_query->have_posts()) {
            $feature_query->the_post();
            the_content();
            wp_reset_postdata();
        }
        ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
