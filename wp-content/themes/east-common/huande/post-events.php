<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package east-common
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    $eventsPage = get_page_by_path('events');
    if ($eventsPage != null) {
        $eventsPageUrl = get_the_permalink($eventsPage);
    }
    if (is_singular()) :
        {
            the_title('<h3 class="entry-title">', '</h1>');
            if ($eventsPageUrl != null) {
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'east-common') . '</span>','<a href="'.$eventsPageUrl.'">Events</a>'); // WPCS: XSS OK.
            }

        } else :
        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
    endif;
    ?>


    <div class="entry-content">
        <?php
        the_content(sprintf(
            wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'east-common'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php edit_post_link(
            sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'east-common'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        ); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
