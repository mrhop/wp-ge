<?php
/**
 * Footer Main Manager
 *
 * @package Hestia
 */

/**
 * Class Hestia_Footer
 */
class Hestia_Footer extends Hestia_Abstract_Main
{

    /**
     * Initialization of the feature.
     */
    public function init()
    {
        add_action('hestia_do_footer', array($this, 'the_footer_content'));
        add_filter('wp_nav_menu_args', array($this, 'modify_footer_menu_classes'));
        add_action('hestia_do_bottom_footer_top_content', array($this, 'bottom_footer_top_content'));
        add_action('hestia_do_bottom_footer_content', array($this, 'bottom_footer_content'));
    }

    /**
     * Get an array of footer sidevars slugs.
     *
     * @return array
     */
    private function get_footer_sidebars()
    {
        $footer_sidebars_array = array(
            'footer-one-widgets',
            'footer-two-widgets',
            'footer-three-widgets',
            'footer-four-widgets',
        );
        $number_of_sidebars = get_theme_mod('hestia_nr_footer_widgets', '3');
        $footer_sidebars_array = array_slice($footer_sidebars_array, 0, $number_of_sidebars);

        return $footer_sidebars_array;
    }

    /**
     * Render the footer sidebars.
     */
    private function render_footer_sidebars()
    {
        if (!$this->does_footer_have_widgets()) {
            return;
        }

        $sidebars = $this->get_footer_sidebars();
        if (empty($sidebars)) {
            return;
        } ?>

        <div class="content">
            <div class="row">
                <?php
                foreach ($sidebars as $footer_sidebar) {
                    if (is_active_sidebar($footer_sidebar)) {
                        echo '<div class="' . esc_attr($this->the_sidebars_class()) . '">';
                        dynamic_sidebar($footer_sidebar);
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <hr/>
        <?php
    }

    /**
     * Function to display footer content.
     *
     * @since  1.1.24
     * @access public
     */
    public function the_footer_content()
    {
        hestia_before_footer_trigger();

        ?>
        <footer class="footer <?php echo esc_attr($this->the_footer_class()); ?> footer-big">
            <?php hestia_before_footer_content_trigger(); ?>
            <?php $this->wrapped_bottom_footer_top_content(); ?>
            <div class="container footer-bottom">
                <?php hestia_before_footer_widgets_trigger(); ?>
                <?php $this->render_footer_sidebars(); ?>
                <?php hestia_after_footer_widgets_trigger(); ?>
                <?php $this->wrapped_bottom_footer_content(); ?>
            </div>
            <?php hestia_after_footer_content_trigger(); ?>
        </footer>
        <?php
        hestia_after_footer_trigger();
    }

    /**
     * Filter footer menu classes to account for alignment.
     *
     * @param string $classes the footer classes.
     *
     * @return mixed
     */
    public function modify_footer_menu_classes($classes)
    {
        if ('footer' !== $classes['theme_location']) {
            return $classes;
        }
        $classes['menu_class'] .= ' ' . $this->add_footer_menu_alignment_class();

        return $classes;
    }


    /**
     * Function to display footer top content.
     */
    public function wrapped_bottom_footer_top_content()
    {
        $hide_section = get_theme_mod('hestia_footer_top_hide', false);
        if (!$hide_section) {
            echo '<div class="footer-top">';
            do_action('hestia_do_bottom_footer_top_content');
            echo '</div>';
        }
    }

    /**
     * Function to display footer top content.
     */
    public function bottom_footer_top_content()
    {
        $title = get_theme_mod('hestia_foot_top_title');
        $subtitle = get_theme_mod('hestia_foot_top_subtitle');
        $background = get_theme_mod('hestia_foot_top_background');
        $linkPageId = get_theme_mod('hestia_foot_top_link_page');
        if ($linkPageId == 0) {
            $linkPage = '#';
        } else {
            $linkPage = get_the_permalink($linkPageId);
        }
        ?>
        <div style="background-image:url('<?php echo $background ?>');">
            <div class="container hestia-east">
                <h2>
                    <?php
                    //echo wp_kses_post( $hestia_general_credits );
                    echo $title
                    ?>
                </h2>
                <a class="btn btn-primary h5" href="<?php echo $linkPage ?>">
                    <?php
                    //echo wp_kses_post( $hestia_general_credits );
                    echo $subtitle
                    ?>
                </a>
            </div>
        </div>
        <?php
    }


    /**
     * Function to display footer copyright and footer menu.
     */
    private function wrapped_bottom_footer_content()
    {
        echo '<div class="hestia-bottom-footer-content">';
        do_action('hestia_do_bottom_footer_content');
        echo '</div>';
    }

    /**
     * Function to display footer copyright and footer menu.
     * Also used as callback for selective refresh.
     */
    public function bottom_footer_content()
    {
        $hestia_general_credits = get_theme_mod(
            'hestia_general_credits',
            sprintf(
            /* translators: %1$s is Theme Name, %2$s is WordPress */
                esc_html__('%1$s | Developed by %2$s', 'hestia'),
                esc_html__('Hestia', 'hestia'),
                /* translators: %1$s is URL, %2$s is WordPress */
                sprintf(
                    '<a href="%1$s" rel="nofollow">%2$s</a>',
                    esc_url(__('https://themeisle.com', 'hestia')),
                    'ThemeIsle'
                )
            )
        );

//		wp_nav_menu(
//			array(
//				'theme_location' => 'footer',
//				'depth'          => 1,
//				'container'      => 'ul',
//				'menu_class'     => 'footer-menu',
//			)
//		);
        ?>
        <?php if (!empty($hestia_general_credits) || is_customize_preview()) : ?>
        <div class="copyright <?php echo esc_attr($this->add_footer_copyright_alignment_class()); ?>">
            <?php
            //echo wp_kses_post( $hestia_general_credits );
            echo '© Copyright 2018 EUTECC. All Rights Reserved'
            ?>
        </div>
        <div class="social <?php echo esc_attr($this->add_footer_social_alignment_class()); ?>">
            <?php
            echo '<a><i class="fa fa-facebook-f"></i></a><a><i class="fa fa-twitter"></i></a><a><i class="fa fa-linkedin"></i></a><a><i class="fa fa-instagram"></i></a>'
            ?>
        </div>
    <?php
    endif;
    }

    /**
     * Add the footer copyright alignment class.
     *
     * @return string
     */
    private function add_footer_copyright_alignment_class()
    {
//		$hestia_copyright_alignment = get_theme_mod( 'hestia_copyright_alignment', 'right' );
        $hestia_copyright_alignment = get_theme_mod('hestia_copyright_alignment', 'left');
        if ($hestia_copyright_alignment === 'left') {
            return 'pull-left';
        }
        if ($hestia_copyright_alignment === 'center') {
            return 'hestia-center';
        }

        return 'pull-left';
    }

    private function add_footer_social_alignment_class()
    {
        $hestia_social_alignment = get_theme_mod('hestia_social_alignment', 'right');
        if ($hestia_social_alignment === 'left') {
            return 'pull-left';
        }
        if ($hestia_social_alignment === 'center') {
            return 'hestia-center';
        }

        return 'pull-right';
    }

    /**
     * Add the footer menu alignment class.
     *
     * @return string
     */
    private function add_footer_menu_alignment_class()
    {
        $hestia_copyright_alignment = get_theme_mod('hestia_copyright_alignment', 'right');
        if ($hestia_copyright_alignment === 'left') {
            return 'pull-right';
        }
        if ($hestia_copyright_alignment === 'center') {
            return 'hestia-center';
        }

        return 'pull-left';
    }

    /**
     * Utility to get the footer class for color changes.
     */
    private function the_footer_class()
    {
        $footer_style = get_theme_mod('hestia_alternative_footer_style', 'black_footer');
        $class = 'footer-black';

        if ($footer_style === 'white_footer') {
            $class = '';
        }

        return $class;
    }

    /**
     * Get the sidebars class.
     *
     * @return string the sidebar class
     */
    private function the_sidebars_class()
    {
        $number_of_sidebars = get_theme_mod('hestia_nr_footer_widgets', '3');

        if (empty($number_of_sidebars)) {
            return 'col-md-4';
        }

        $suffix = abs(12 / $number_of_sidebars);
        $class = 'col-md-' . $suffix;

        return $class;
    }

    /**
     * Utility to check if any of the footer sidebars have widgets.
     *
     * @return bool
     */
    private function does_footer_have_widgets()
    {
        $sidebars = $this->get_footer_sidebars();
        if (empty($sidebars)) {
            return false;
        }

        foreach ($sidebars as $footer_sidebar) {
            $has_widgets = is_active_sidebar($footer_sidebar);
            if ($has_widgets) {
                return true;
            }
        }

        return false;
    }

}
