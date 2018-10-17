<?php
/*
Template Name: Eutecc Index page
*/
?>
<?php
get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="container">
                <div class="title">
                    <span class="triangle-bottomright"></span>
                    <span class="h3"><?php echo __('EVENTS', 'east-common') ?></span>
                </div>
                <ul class="events">
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
                        <li class="row">
                            <div class="col col-md-6"><img src=" <?php echo $large_image_url[0] ?>"/></div>
                            <div class="col col-md-6">
                                <p class="title h4"><?php the_title() ?></p>
                                <?php the_excerpt() ?>
                                <a href="<?php the_permalink() ?>"
                                   class="btn btn-default"><?php echo __('READ MORE') ?></a>
                            </div>
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
