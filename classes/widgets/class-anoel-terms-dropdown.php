<?php
/**
 * Elementor terms dropdown widget
 *
 * PHP version 7.3 Or Later
 *
 * @package  AnonyEngine elements
 * @author   Makiomar <info@makior.com>
 * @license  https://makiomar.com AnonyEngine Licence
 * @link     https://makiomar.com/anonyengine_elements
 */

use Elementor\Utils;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Elementor terms dropdown widget class.
 *
 * @since 1.0.0
 *
 * @package    Elementor Widgets
 * @author     Makiomar <info@makior.com>
 * @license    https://makiomar.com AnonyEngine Licence
 * @link       https://makiomar.com
 */
class ANOEL_Terms_Dropdown extends \Elementor\Widget_Base {


	/**
	 * Get widget name.
	 *
	 * Retrieve terms dropdown widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'terms-dropdown';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve terms dropdown widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Terms dropdown', 'anonyengine-elements' );
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'dropdown', 'menu', 'categories' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve terms dropdown widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa-folder';
	}


	/**
	 * Get scripts dependancies.
	 *
	 * @return array Array of script dependancies.
	 */
	public function get_script_depends() {

		return array();
	}

	/**
	 * Get style dependancies.
	 *
	 * @return array Array of style dependancies.
	 */
	public function get_style_depends() {

		return array();
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the terms dropdown widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'anonyengine' );
	}

	/**
	 * Register terms dropdown widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Settings', 'anonyengine-elements' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

			$this->add_control(
				'post_type',
				array(
					'label'   => esc_html__( 'Post type', 'anonyengine-elements' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'options' => get_post_types( array( 'public' => true ) ),
					'default' => 'post',

				)
			);

			$this->add_control(
				'taxonomy',
				array(
					'label'   => esc_html__( 'Taxonomy', 'anonyengine-elements' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'options' => get_taxonomies( array( 'public' => true ) ),
					'default' => 'category',

				)
			);

			$this->add_control(
				'terms',
				array(
					'label'       => esc_html__( 'Terms', 'anonyengine-elements' ),
					'label_block' => true,
					'type'        => \Elementor\Controls_Manager::SELECT2,
					'multiple'    => true,
					'options'     => array(
						'title'       => __( 'Title', 'plugin-domain' ),
						'description' => __( 'Description', 'plugin-domain' ),
						'button'      => __( 'Button', 'plugin-domain' ),
					),
					'default'     => array( 'title', 'description' ),

				)
			);

		$this->end_controls_section();

		$this->style_tab();

	}

	/**
	 * Widget styles.
	 *
	 * @access private
	 *
	 * @return void
	 */
	private function style_tab() {

	}

	/**
	 * Render terms dropdown widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		?>



		<?php
	}


	/**
	 * Render terms dropdown widget output on the backend editor.
	 *
	 * Written in js and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {

		?>


		<?php
	}
}
