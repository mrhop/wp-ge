<?php
/**
 * Customizer functionality for the Blog settings panel.
 *
 * @package Hestia
 * @since Hestia 1.1.10
 */
if (!class_exists('WP_Customize_Control')) {
    return null;
}

/**
 * A customizer control to display text in customizer.
 *
 * @since Hestia 1.1.42
 */
class Hestia_East_Editor extends WP_Customize_Control
{
    /**
     * The control type.
     *
     * @access public
     * @var string
     */
    public $type = 'east-editor';

    public $id = '';


    public function __construct($manager, $id, $args = array())
    {
        parent::__construct($manager, $id, $args);
        $this->id = $id;
    }

    public function enqueue()
    {
        wp_enqueue_editor();
        wp_enqueue_script(
            'hestia_east_editor',
            get_template_directory_uri() . '/inc/customizer/controls/custom-controls/east-editor/js/hestia-east-editor.js',
            array(
                'jquery',
            ),
            HESTIA_VERSION,
            true
        );
    }

    public function render_content()
    {
        ?>
        <label>
            <span class="customize-text_editor"><?php echo esc_html($this->label); ?></span>

        </label>
        <?php
        $settings = array(
            'media_buttons' => false,
            'editor_height' => 200,
            teeny => true
        );
        $this->filter_editor_setting_link();
        wp_editor($this->value(), $this->id, $settings);
        if (!class_exists('_WP_Editors', false)) {
            require(ABSPATH . WPINC . '/class-wp-editor.php');
        }
        _WP_Editors::editor_js();
    }

    private function filter_editor_setting_link()
    {
        add_filter('the_editor', function ($output) {
            return preg_replace('/<textarea/', '<textarea ' . $this->get_link(), $output, 1);
        });
    }
}



