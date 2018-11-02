<?php
/*
Template Name: Huande Events page
*/
?>
<?php
get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="container">
                <div class="title">
                    <span class="h3"><?php echo __('COMPANY EVENTS', 'east-common') ?></span>
                </div>
                <ul class="events row">
                    <?php
                    $event_args = array(
                        'post_type' => 'post',
                        'nopaging' => true,
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
                        <li class="col col-md-3 col-sm-6">
                            <img src=" <?php echo $large_image_url[0] ?>"/>
                            <div class="center-block">
                                <p class="sub-title"><?php the_title() ?></p>
                            </div>
                            <p><?php the_time('M j, Y') ?> <a
                                        href="<?php the_permalink() ?>">&gt;&nbsp;<?php echo __('More', 'east-common') ?></a>
                            </p>
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
