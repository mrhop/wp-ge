<?php
/**
 * Handle Footer Controls.
 *
 * @package Hestia
 */

/**
 * Class Hestia_Footer_Controls
 */
class Hestia_Footer_Controls extends Hestia_Register_Customizer_Controls
{
    /**
     * Add the customizer controls.
     */
    public function add_controls()
    {
        $this->add_sections();
        $this->add_panel(
            new Hestia_Customizer_Panel(
                'hestia_footer_options',
                array(
                    'priority' => 40,
                    'title' => esc_html__('Footer Options', 'hestia'),
                )
            )
        );
        $this->add_top_section_controls();
        $this->add_bottom_section_controls();


    }

    private function add_top_section_controls()
    {
        // hide section control
        $this->add_control(
            new Hestia_Customizer_Control(
                'hestia_footer_top_hide',
                array(
                    'sanitize_callback' => 'hestia_sanitize_checkbox',
                    'default' => false,
                ),
                array(
                    'type' => 'checkbox',
                    'label' => esc_html__('Disable section', 'hestia'),
                    'section' => 'hestia_footer_top',
                    'priority' => 1,
                )
            )
        );

        //Add the Section Title
        $this->add_control(
            new Hestia_Customizer_Control(
                'hestia_foot_top_title',
                array(
                    'sanitize_callback' => 'wp_kses_post',
                    'transport' => $this->selective_refresh,
                    'default' => 'Big Title',
                ), array(
                'label' => esc_html__('Section Title', 'hestia'),
                'section' => 'hestia_footer_top',
                'priority' => 5,
            ),
                null,
                array(
                    'selector' => '.footer .footer-top',
                    'settings' => 'hestia_foot_top_title',
                    'render_callback' => array($this, 'footer_top_content_callback'),
                )
            )
        );
        //Add the Section Title.
        $this->add_control(
            new Hestia_Customizer_Control(
                'hestia_foot_top_subtitle',
                array(
                    'sanitize_callback' => 'wp_kses_post',
                    'transport' => $this->selective_refresh,
                    'default' => 'Click me',
                ),
                array(
                    'label' => esc_html__('Section Subtitle', 'hestia'),
                    'section' => 'hestia_footer_top',
                    'priority' => 6,
                ),
                null,
                array(
                    'selector' => '.footer .footer-top',
                    'settings' => 'hestia_foot_top_subtitle',
                    'render_callback' => array($this, 'footer_top_content_callback'),
                )
            )
        );
        //Add the Section link
        $this->add_control(
            new Hestia_Customizer_Control(
                'hestia_foot_top_link_page',
                array(
                    'sanitize_callback' => 'absint',
                    'transport' => $this->selective_refresh,
                    'default' => '0',
                ),
                array(
                    'label' => esc_html__('Link to Page', 'hestia'),
                    'section' => 'hestia_footer_top',
                    'priority' => 7,
                    'type' => 'select',
                    'choices' => $this->getPageOptions(),
                ),
                null,
                array(
                    'selector' => '.footer .footer-top',
                    'settings' => 'hestia_foot_top_link_page',
                    'render_callback' => array($this, 'footer_top_content_callback'),
                )
            )
        );
        // Add background control.
        $this->add_control(
            new Hestia_Customizer_Control(
                'hestia_foot_top_background',
                array(
                    'sanitize_callback' => 'esc_url_raw',
                    'transport' => $this->selective_refresh,
                    'default' => get_template_directory_uri() . '/assets/img/about.jpg',
                ),
                array(
                    'label' => esc_html__('Background Image', 'hestia'),
                    'section' => 'hestia_footer_top',
                    'priority' => 10,
                ),
                'WP_Customize_Image_Control',
                array(
                    'selector' => '.footer .footer-top',
                    'settings' => 'hestia_foot_top_background',
                    'render_callback' => array($this, 'footer_top_content_callback'),
                )
            )
        );
    }

    private function add_bottom_section_controls()
    {
        //Add the copyright
        $this->add_control(
            new Hestia_Customizer_Control(
                'hestia_foot_bottom_copyright',
                array(
                    'sanitize_callback' => 'wp_kses_post',
                    'transport' => $this->selective_refresh,
                    'default' => 'Copyright',
                ), array(
                'label' => esc_html__('Copyright', 'hestia'),
                'section' => 'hestia_footer_bottom',
                'priority' => 5,
            ), null,
                array(
                    'selector' => '.footer .hestia-bottom-footer-content',
                    'settings' => 'hestia_foot_bottom_copyright',
                    'render_callback' => array($this, 'footer_bottom_content_callback'),
                )
            )
        );

        //Add the copyright
        $this->add_control(
            new Hestia_Customizer_Control(
                'hestia_foot_bottom_social',
                array(
                    'sanitize_callback' => 'wp_kses_post',
                    'transport' => $this->selective_refresh,
                    'default' => 'Social Links',
                ), array(
                'label' => esc_html__('Social Links', 'hestia'),
                'section' => 'hestia_footer_bottom',
                'priority' => 6,
            ),
                'Hestia_East_Editor',
                array(
                    'selector' => '.footer .hestia-bottom-footer-content',
                    'settings' => 'hestia_foot_bottom_social',
                    'render_callback' => array($this, 'footer_bottom_content_callback'),
                )
            )
        );
    }

    /**
     * Render callback function of top
     * 继续实现一个view section，然后给出实现，并关联到footer中
     */
    public function footer_top_content_callback()
    {
        $Hestia_Footer = new Hestia_Footer();
        $Hestia_Footer->bottom_footer_top_content();
    }

    /**
     * Render callback function of top
     * 继续实现一个view section，然后给出实现，并关联到footer中
     */
    public function footer_bottom_content_callback()
    {
        $Hestia_Footer = new Hestia_Footer();
         $Hestia_Footer->bottom_footer_content();
    }

    private function getPageOptions()
    {
        $pages = get_pages();
        $page_options = array('0' => 'Choose from below');
        foreach ($pages as $page) {
            $page_options[$page->ID] = get_the_title($page);
        }
        return $page_options;
    }

    /**
     * Add sections.
     */
    private function add_sections()
    {
        $this->add_section(
            new Hestia_Customizer_Section(
                'hestia_footer_top',
                array(
                    'title' => esc_html__('Footer top', 'hestia'),
                    'panel' => 'hestia_footer_options',
                    'priority' => 10,
                )
            )
        );
        $this->add_section(
            new Hestia_Customizer_Section(
                'hestia_footer_center_left',
                array(
                    'title' => esc_html__('Footer center left', 'hestia'),
                    'panel' => 'hestia_footer_options',
                    'priority' => 15,
                )
            )
        );
        $this->add_section(
            new Hestia_Customizer_Section(
                'hestia_footer_center_middle',
                array(
                    'title' => esc_html__('Footer center middle', 'hestia'),
                    'panel' => 'hestia_footer_options',
                    'priority' => 20,
                )
            )
        );
        $this->add_section(
            new Hestia_Customizer_Section(
                'hestia_footer_center_right',
                array(
                    'title' => esc_html__('Footer center right', 'hestia'),
                    'panel' => 'hestia_footer_options',
                    'priority' => 25,
                )
            )
        );
        $this->add_section(
            new Hestia_Customizer_Section(
                'hestia_footer_bottom',
                array(
                    'title' => esc_html__('Footer footer bottom', 'hestia'),
                    'panel' => 'hestia_footer_options',
                    'priority' => 30,
                )
            )
        );
    }
}
