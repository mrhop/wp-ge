<?php
/**
 * Customizer Control: east-slider.
 *
 * @package Hestia
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Buttonset control
 */
class Hestia_East_Slider extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'east-slider';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
	}

	/**
	 * Renders the control wrapper and calls $this->render_content() for the internals.
	 *
	 * @see WP_Customize_Control::render()
	 */
	protected function render() {
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function json() {
	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
        ?>
        <h4 class="hestia-customizer-heading">{{{ data.label }}}123</h4>
        <?php
	}
}
