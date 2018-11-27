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
class Hestia_East_Slider extends WP_Customize_Control
{
    /**
     * The control type.
     *
     * @access public
     * @var string
     */
    public $type = 'east-slider';

    public $id = '';

    public $name = 'slider3';

    public function __construct($manager, $id, $args = array())
    {
        parent::__construct($manager, $id, $args);
        $this->id = $id;
    }

    public function render_content()
    {
        if (class_exists('N2SmartsliderSlidersModel')) {
            $instance = array(
                'title' => '',
                'slider' => $this->value());
            $slidersModel = new N2SmartsliderSlidersModel();
            foreach ($slidersModel->getAll(0) AS $slider) {
                if ($slider['type'] == 'group') {

                    $subChoices = array();
                    if (!empty($slider['alias'])) {
                        $subChoices[$slider['alias']] = n2_('Whole group') . ' - ' . $slider['title'] . ' #Alias: ' . $slider['alias'];
                    }
                    $subChoices[$slider['id']] = n2_('Whole group') . ' - ' . $slider['title'] . ' #' . $slider['id'];
                    foreach ($slidersModel->getAll($slider['id']) AS $_slider) {
                        if (!empty($_slider['alias'])) {
                            $subChoices[$_slider['alias']] = $_slider['title'] . ' #Alias: ' . $_slider['alias'];
                        }
                        $subChoices[$_slider['id']] = $_slider['title'] . ' #' . $_slider['id'];
                    }

                    $choices[$slider['id']] = array(
                        'label' => $slider['title'] . ' #' . $slider['id'],
                        'choices' => $subChoices
                    );
                } else {
                    if (!empty($slider['alias'])) {
                        $choices[$slider['alias']] = $slider['title'] . ' #Alias: ' . $slider['alias'];
                    }
                    $choices[$slider['id']] = $slider['title'] . ' #' . $slider['id'];
                }

            }
            $value = $instance['slider'];
            $_title = '';
            $input_id = '_customize-input-' . $this->id;
            $link = $this->get_link();
            echo '<select class="widefat" ' . $link . ' name=' . $this->name . ' id=' . $input_id . ' >';
            echo '<option value="">' . n2_("None") . '</option>';
            foreach ($choices AS $id => $choice) {
                if (is_array($choice)) {
                    echo '<optgroup label=' . $choice["label"] . ' >';
                    foreach ($choice['choices'] AS $_id => $_choice) {
                        if ($id == $value) {
                            $_title = $choice;
                            echo '<option selected value="' . $id . '">' . $choice . '</option>';
                        } else {
                            echo '<option value="' . $id . '">' . $choice . '</option>';
                        }
                    }
                    echo '</optgroup>';
                } else {
                    if ($id == $value) {
                        $_title = $choice;
                        echo '<option selected value="' . $id . '">' . $choice . '</option>';
                    } else {
                        echo '<option value="' . $id . '">' . $choice . '</option>';
                    }
                }
            }
            echo '</select>';
        } else {
            echo 'Please enable the smart slider3 plugin!';
        }
    }
}



