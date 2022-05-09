<?php
/**
 * Elementor Vertical text slider Widget
 *
 * PHP version 7.3 Or Later
 *
 * @package  AnonyEngine elements
 * @author   Makiomar <info@makior.com>
 * @license  https://makiomar.com AnonyEngine Licence
 * @link     https://makiomar.com/anonyengine_elements
 */

defined( 'ABSPATH' ) || die(); // Exit if accessed direct.

/**
 * Elementor vertical text slider widget class.
 *
 * @package    Elementor Widgets
 * @author     Makiomar <info@makior.com>
 * @license    https://makiomar.com AnonyEngine Licence
 * @link       https://makiomar.com
 */
class ANOEL_Vertical_Text_Slider extends \Elementor\Widget_Base {


	/**
	 * Get widget name.
	 *
	 * Retrieve Vertical text slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'vertical-text-slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Vertical text slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Vertical text slider', 'anonyengine-elements' );
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
		return array( 'slider' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Vertical text slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-bars';
	}


	/**
	 * Get scripts dependancies
	 *
	 * @return type
	 */
	public function get_script_depends() {

		return array( 'slick', 'anoel-slick-vtext' );
	}

	/**
	 * Get style dependancies
	 *
	 * @return type
	 */
	public function get_style_depends() {

		return array( 'slick', 'anoel-slick-vtext', 'elementor-icons-fa-solid', 'elementor-icons-shared-0' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Vertical text slider widget belongs to.
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
	 * Register Vertical text slider widget controls.
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
				'label' => esc_html__( 'Content', 'anonyengine-elements' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'content_icon',
				array(
					'label'   => esc_html__( 'Icon', 'anonyengine-elements' ),
					'type'    => \Elementor\Controls_Manager::ICONS,
					'default' => array(
						'value'   => 'fas fa-star',
						'library' => 'solid',
					),
				)
			);

			$repeater->add_control(
				'item_content',
				array(
					'label'      => esc_html__( 'Content', 'anonyengine-elements' ),
					'type'       => \Elementor\Controls_Manager::TEXT,
					'default'    => esc_html__( 'Add your content here', 'anonyengine-elements' ),
					'show_label' => false,
					'dynamic'    => array(
						'active' => true,
					),
				)
			);

			$this->add_control(
				'vertical_slider_list',
				array(
					'label'       => esc_html__( 'Vertical text slider List', 'anonyengine-elements' ),
					'type'        => \Elementor\Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default'     => array(
						array(
							'item_content' => esc_html__( 'Item content #1', 'anonyengine-elements' ),
							'content_icon' => array(
								'value'   => 'fas fa-check',
								'library' => 'fa-solid',
							),
						),
						array(
							'item_content' => esc_html__( 'Item content #2', 'anonyengine-elements' ),
							'content_icon' => array(
								'value'   => 'fas fa-times',
								'library' => 'fa-solid',
							),
						),

						array(
							'item_content' => esc_html__( 'Item content #3', 'anonyengine-elements' ),
							'content_icon' => array(
								'value'   => 'fas fa-dot-circle',
								'library' => 'fa-solid',
							),
						),
					),
					'title_field' => '{{{ elementor.helpers.renderIcon( this, content_icon, {}, "i", "panel" ) || \'<i class="{{ content_icon }}" aria-hidden="true"></i>\' }}} {{{ item_content }}}',
				)
			);

			$this->add_responsive_control(
				'align',
				array(
					'label'     => __( 'Alignment', 'elementor' ),
					'type'      => \Elementor\Controls_Manager::CHOOSE,
					'options'   => array(
						'left'   => array(
							'title' => __( 'Left', 'elementor' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center' => array(
							'title' => __( 'Center', 'elementor' ),
							'icon'  => 'eicon-text-align-center',
						),
						'right'  => array(
							'title' => __( 'Right', 'elementor' ),
							'icon'  => 'eicon-text-align-right',
						),
					),
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} span.slick-slide' => 'justify-content: {{VALUE}};',
					),
				)
			);

			$this->add_responsive_control(
				'icon_position',
				array(
					'label'     => __( 'Icon position', 'elementor' ),
					'type'      => \Elementor\Controls_Manager::CHOOSE,
					'options'   => array(
						'row'         => array(
							'title' => __( 'Left', 'elementor' ),
							'icon'  => 'eicon-text-align-left',
						),

						'row-reverse' => array(
							'title' => __( 'Right', 'elementor' ),
							'icon'  => 'eicon-text-align-right',
						),

					),
					'default'   => 'row',
					'selectors' => array(
						'{{WRAPPER}} span.slick-slide' => 'display: flex; flex-direction: {{VALUE}}',
					),
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

		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => esc_html__( 'Content', 'elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

			$this->add_control(
				'text_color_heading',
				array(
					'label'     => esc_html__( 'Text', 'anonyengine-elements' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				)
			);

			$this->add_control(
				'content_color',
				array(
					'label'     => esc_html__( 'Color', 'anonyengine-elements' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .anoshc-slick-vtext span:not(i)' => 'color: {{VALUE}}',
					),
				)
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				array(
					'name'     => 'text_typography',
					'label'    => esc_html__( 'Typography', 'elementor' ),
					'scheme'   => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .anoshc-slick-vtext span:not(i)',
				)
			);

			$this->add_control(
				'icon_color_heading',
				array(
					'label'     => esc_html__( 'Icon', 'anonyengine-elements' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				)
			);

			$this->add_control(
				'icon_color',
				array(
					'label'     => esc_html__( 'Color', 'anonyengine-elements' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .anoshc-slick-vtext span > i' => 'color: {{VALUE}}',
					),
				)
			);

			$this->add_responsive_control(
				'size',
				array(
					'label'     => __( 'Size', 'elementor' ),
					'type'      => \Elementor\Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'min' => 6,
							'max' => 300,
						),
					),
					'selectors' => array(
						'{{WRAPPER}} span.slick-slide i' => 'font-size: {{SIZE}}{{UNIT}};',
					),
				)
			);

			$this->add_responsive_control(
				'space_between',
				array(
					'label'     => __( 'Space Between', 'elementor' ),
					'type'      => \Elementor\Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max' => 50,
						),
					),
					'selectors' => array(

						'body.rtl {{WRAPPER}} span.slick-slide i' => 'margin-left: {{SIZE}}{{UNIT}}',
						'body:not(.rtl) {{WRAPPER}} span.slick-slide i' => 'margin-right: {{SIZE}}{{UNIT}}',
					),
				)
			);

		$this->end_controls_section();
	}

	/**
	 * Render Vertical text slider widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'vertical_slider_list', 'class', 'anoshc-slick-vtext' );

		if ( 'row-reverse' === $settings['icon_position'] ) {
			$this->add_render_attribute( 'vertical_slider_list_item', 'class', 'row-reverse' );

		} else {
			$this->add_render_attribute( 'vertical_slider_list_item', 'class', 'row' );
		}

		$icon_position = $settings['icon_position'];

		if ( $settings['vertical_slider_list'] && ! empty( $settings['vertical_slider_list'] ) ) {

			$data = array();

			foreach ( $settings['vertical_slider_list'] as $index => $item ) {

				$temp['content']      = $item['item_content'];
				$temp['icon']         = $item['content_icon']['value'];
				$temp['content_icon'] = $item['content_icon'];

				$data[] = $temp;

			}

			if ( empty( $data ) ) {
				esc_html_e( 'Please add some items', 'anonyengine-elements' );

				return;
			}

			include wp_normalize_path( ANOEL_DIR . 'templates/vertical-text-slider.php' );
		}
	}


	/**
	 * Render Vertical text slider widget output on the backend editor.
	 *
	 * Written in js and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() { ?>

		<# 
			view.addRenderAttribute( 'vertical_slider_list', 'class', 'anoshc-slick-vtext' );

			if ( 'row-reverse' == settings.icon_position ) {
				view.addRenderAttribute( 'vertical_slider_list_item', 'class', 'row-reverse' );
			}

			var iconsHTML = {},
				migrated = {};
		#>

		<div {{{ view.getRenderAttributeString( 'vertical_slider_list' ) }}}>

			<# _.each( settings.vertical_slider_list, function( item, index ) {

				iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.content_icon, { 'aria-hidden': true }, 'i', 'object' );

			#>

				<span {{{ view.getRenderAttributeString( 'vertical_slider_list_item' ) }}}>{{{ iconsHTML[ index ].value }}}{{{ item.item_content }}}</span>

			<# } ); #>

		</div>
		<?php
	}
}
