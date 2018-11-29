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
class Hestia_East_Categories extends WP_Customize_Control
{
    /**
     * The control type.
     *
     * @access public
     * @var string
     */
    public $type = 'east-categories';


    public function __construct($manager, $id, $args = array())
    {
        parent::__construct($manager, $id, $args);
        $this->id = $id;
    }

    protected $dropdown_args = false;

    public function render_content()
    {
        ?><label><?php

        if (!empty($this->label)) :
            ?><span class="customize-control-title"><?php echo esc_html($this->label); ?></span><?php
        endif;

        if (!empty($this->description)) :
            ?><span class="description customize-control-description"><?php echo $this->description; ?></span><?php
        endif;

        $dropdown_args = wp_parse_args($this->dropdown_args, array(
            'taxonomy' => 'category',
            'selected' => $this->value(),
            'show_option_all' => '',
            'orderby' => 'id',
            'order' => 'ASC',
            'show_count' => 1,
            'hide_empty' => 1,
            'child_of' => 0,
            'exclude' => '',
            'hierarchical' => 1,
            'depth' => 0,
            'tab_index' => 0,
            'hide_if_empty' => false,
            'show_option_none' => 'Select from Below',
            'option_none_value' => '',
            'value_field' => 'term_id',
        ));

        $dropdown_args['echo'] = false;

        $dropdown = wp_dropdown_categories($dropdown_args);
        $dropdown = str_replace('<select', '<select multiple ' . $this->get_link(), $dropdown);
        echo $dropdown;

        ?></label><?php
    }
}



