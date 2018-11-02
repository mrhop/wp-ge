<?php
/*
Template Name: Huande Index page
*/
?>
<?php
get_header();
$eventsPage = get_page_by_path('events');
if ($eventsPage != null) {
    $eventsPageUrl = get_the_permalink($eventsPage);
}
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="container">
                <div class="title">
                    <span class="h3"><?php echo __('NEWS', 'east-common') ?></span>
                    <?php if ($eventsPageUrl != null) { ?>
                        <a href="<?php echo $eventsPageUrl ?>">>> More</a>
                    <?php
                    } ?>
                </div>
                <ul class="events row">
                    <?php
                    $event_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'category_name' => 'events',
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );
                    $event_query = new wp_Query($event_args);
                    while ($event_query->have_posts()) {
                        $event_query->the_post();
                        $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                        ?>
                        <li class="col col-md-4">
                            <a href="<?php the_permalink() ?>"><img src="<?php echo $large_image_url[0] ?>"/></a>
                            <h4><?php the_title() ?></h4>
                            <h5><?php the_time('M j, Y') ?></h5>
                        </li>
                    <?php }
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
            <?php
            while (have_posts()) :
                the_post();

                get_template_part('template-parts/content', 'page');

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
