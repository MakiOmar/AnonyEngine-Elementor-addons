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

		return array('anoel-terms-dropdown');
	}

	/**
	 * Get style dependancies.
	 *
	 * @return array Array of style dependancies.
	 */
	public function get_style_depends() {

		return array('anoel-terms-dropdown');
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
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Settings', 'anonyengine-elements' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

			$this->add_control(
				'anoeltd_taxonomy',
				array(
					'label'   => esc_html__( 'Taxonomy', 'anonyengine-elements' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'options' => get_taxonomies( array( 'public' => true ) ),
					'default' => 'category',

				)
			);

			$this->add_control(
				'anoeltd_closed_icon',
				[
					'label' => esc_html__( 'Closed icon', 'anonyengine-elements' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-plus',
						'library' => 'solid',
					],
				]
			);

			$this->add_control(
				'anoeltd_opened_icon',
				[
					'label' => esc_html__( 'Opened icon', 'anonyengine-elements' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-minus',
						'library' => 'solid',
					],
				]
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

		$this->container_styles();
		$this->icon_styles();
		$this->list_styles();
	}

	/**
	 * Container's styles.
	 *
	 * @access private
	 *
	 * @return void
	 */
	private function container_styles() {
		$this->start_controls_section(
			'anoeltd_section_container_style',
			array(
				'label' => esc_html__( 'Container', 'anonyengine-elements' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'anoeltd_container_background',
					'label' => esc_html__( 'Background', 'anonyengine-elements' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'selector' => '{{WRAPPER}} #anony-cat-list',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'anoeltd_container_border',
					'label' => esc_html__( 'Border', 'anonyengine-elements' ),
					'selector' => '{{WRAPPER}} #anony-cat-list li',
				]
			);

			$this->add_control(
				'anoeltd_container_border_radius',
				[
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'label' => esc_html__( 'Border radius', 'elementor' ),
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} #anony-cat-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'anoeltd_container_padding',
				[
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'label' => esc_html__( 'Padding', 'elementor' ),
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} #anony-cat-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'anoeltd_container_margin',
				[
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'label' => esc_html__( 'Margin', 'elementor' ),
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} #anony-cat-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'anoeltd_container_box_shadow',
					'label' => esc_html__( 'Box Shadow', 'elementor' ),
					'selector' => '{{WRAPPER}} #anony-cat-list',
				]
			);

		$this->end_controls_section();
	}

	/**
	 * Icon's styles.
	 *
	 * @access private
	 *
	 * @return void
	 */
	private function icon_styles() {
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => esc_html__( 'Icon', 'elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

			$this->add_control(
				'icon_color',
				array(
					'label'     => esc_html__( 'Color', 'anonyengine-elements' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} #anony-cat-list .toggle-category i' => 'color: {{VALUE}}',
					),
				)
			);


			$this->add_responsive_control(
				'icon_size',
				array(
					'label'     => esc_html__( 'Size', 'elementor' ),
					'type'      => \Elementor\Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'min' => 6,
							'max' => 300,
						),
					),
					'selectors' => array(
						'{{WRAPPER}} #anony-cat-list .toggle-category i' => 'font-size: {{SIZE}}{{UNIT}};',
					),
				)
			);

		$this->end_controls_section();
	}

	/**
	 * List's styles.
	 *
	 * @access private
	 *
	 * @return void
	 */
	private function list_styles() {

		$this->start_controls_section(
			'section_list_style',
			array(
				'label' => esc_html__( 'List', 'anonyengine-elements' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				array(
					'name'     => 'anoeltd_list_typography',
					'label'    => esc_html__( 'Typography', 'elementor' ),
					'scheme'   => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} #anony-cat-list li a',
				)
			);

			$this->add_control(
				'anoeltd_text_color',
				array(
					'label'     => esc_html__( 'Color', 'anonyengine-elements' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} #anony-cat-list li a' => 'color: {{VALUE}}',
					),
				)
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'anoeltd_list_border',
					'label' => esc_html__( 'Border', 'anonyengine-elements' ),
					'selector' => '{{WRAPPER}} #anony-cat-list li',
				]
			);

			$this->add_control(
				'anoeltd_list_border_radius',
				[
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'label' => esc_html__( 'Border radius', 'elementor' ),
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} #anony-cat-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'anoeltd_list_padding',
				[
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'label' => esc_html__( 'Padding', 'elementor' ),
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} #anony-cat-list li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'anoeltd_list_margin',
				[
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'label' => esc_html__( 'Margin', 'elementor' ),
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} #anony-cat-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

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

		echo '<ul id="anony-cat-list">';

		wp_list_categories(
			array(
				'hide_empty' => 0,
				'title_li'   => '',
				'order'      => 'DESC',
				'taxonomy'   => $settings[ 'anoeltd_taxonomy' ],
				'walker'     => new ANOEL_Cats_Walk( $settings ),
			)
		);

		echo '</ul>';

	}
}
