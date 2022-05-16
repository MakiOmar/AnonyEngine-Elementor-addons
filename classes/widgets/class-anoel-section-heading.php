<?php
/**
 * Elementor Seaction heading Widget
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
 * Elementor Seaction heading Widget class.
 *
 * @package    Elementor Widgets
 * @author     Makiomar <info@makior.com>
 * @license    https://makiomar.com AnonyEngine Licence
 * @link       https://makiomar.com
 */
class ANOEL_Section_Heading extends \Elementor\Widget_Base {


	/**
	 * Get widget name.
	 *
	 * Retrieve section heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'anoel-section-heading';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve section heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Section heading', 'anonyengine-elements' );
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
		return array( 'heading', 'title' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve section heading widget icon.
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

		return array();
	}

	/**
	 * Get style dependancies
	 *
	 * @return type
	 */
	public function get_style_depends() {

		return array( 'anoel-section-heading' );
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the section heading widget belongs to.
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
	 * Register section heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'anoelsh_content_section',
			array(
				'label' => esc_html__( 'Content', 'anonyengine-elements' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

			$this->add_control(
				'anoelsh_heading_text',
				array(
					'label'   => __( 'Heading', 'anonyengine-elements' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Add your heading', 'anonyengine-elements' ),
				)
			);

			$this->add_control(
				'is_linked_title',
				array(
					'label'        => esc_html__( 'Is linked heading', 'anonyengine-elements' ),
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'anonyengine-elements' ),
					'label_off'    => esc_html__( 'No', 'anonyengine-elements' ),
					'return_value' => 'yes',
					'default'      => 'no',
				)
			);

			$this->add_control(
				'heading_link',
				array(
					'label'         => __( 'heading URL', 'anonyengine-elements' ),
					'type'          => \Elementor\Controls_Manager::URL,
					'placeholder'   => esc_html__( 'https://your-link.com', 'anonyengine-elements' ),
					'show_external' => true,
					'default'       => array(
						'url'         => '',
						'is_external' => true,
						'nofollow'    => true,
					),
					'condition'     => array(
						'is_linked_title' => 'yes',
					),
				)
			);

		$this->end_controls_section();

		$this->style_tab();
	}

	/**
	 * Widget general styles.
	 *
	 * @access private
	 *
	 * @return void
	 */
	private function general_styles() {

		$this->start_controls_section(
			'anoelsh_section_general_style',
			array(
				'label' => esc_html__( 'General', 'elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

						$this->add_group_control(
							\Elementor\Group_Control_Border::get_type(),
							array(
								'name'           => 'border',
								'label'          => esc_html__( 'Border', 'anonyengine-elements' ),
								'fields_options' => array(
									'border' => array(
										'default' => 'solid',
									),
									'width'  => array(
										'default' => array(
											'top'      => '5',
											'right'    => '0',
											'bottom'   => '0',
											'left'     => '0',
											'isLinked' => false,
										),
									),
									'color'  => array(
										'default' => '#000',
									),
								),
								'selector'       => '{{WRAPPER}} .anoel-section-heading',
							)
						);

			$this->add_responsive_control(
				'align',
				array(
					'label'   => esc_html__( 'Alignment', 'elementor' ),
					'type'    => \Elementor\Controls_Manager::CHOOSE,
					'options' => array(
						'left'   => array(
							'title' => esc_html__( 'Left', 'elementor' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center' => array(
							'title' => esc_html__( 'Center', 'elementor' ),
							'icon'  => 'eicon-text-align-center',
						),
						'right'  => array(
							'title' => esc_html__( 'Right', 'elementor' ),
							'icon'  => 'eicon-text-align-right',
						),
					),
					'default' => 'left',
				)
			);

			$this->add_responsive_control(
				'height',
				array(
					'label'      => esc_html__( 'Height', 'elementor' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array( 'px', '%' ),
					'range'      => array(
						'px' => array(
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						),
						'%'  => array(
							'min' => 0,
							'max' => 100,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 50,
					),
					'selectors'  => array(
						'{{WRAPPER}} .anoel-section-heading' => 'height: {{SIZE}}{{UNIT}};',
					),
				)
			);

			$this->add_responsive_control(
				'width',
				array(
					'label'      => esc_html__( 'Width', 'elementor' ),
					'type'       => \Elementor\Controls_Manager::SLIDER,
					'size_units' => array( 'px', '%' ),
					'range'      => array(
						'px' => array(
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						),
						'%'  => array(
							'min' => 0,
							'max' => 100,
						),
					),
					'default'    => array(
						'unit' => '%',
						'size' => 100,
					),
					'selectors'  => array(
						'{{WRAPPER}} .anoel-section-heading' => 'width: {{SIZE}}{{UNIT}};',
					),
				)
			);

		$this->end_controls_section();

	}

	/**
	 * Widget content styles.
	 *
	 * @access private
	 *
	 * @return void
	 */
	private function content_styles() {

		$this->start_controls_section(
			'anoelsh_section_content_style',
			array(
				'label' => esc_html__( 'Content', 'elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

			$this->add_control(
				'title_color',
				array(
					'label'     => esc_html__( 'text Color', 'anonyengine-elements' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .anoel-heading-text' => 'color: {{VALUE}}',
						'{{WRAPPER}} .anoel-heading-text a' => 'color: {{VALUE}}',
					),
				)
			);

			$this->add_control(
				'title_background',
				array(
					'label'     => esc_html__( 'Heading background', 'anonyengine-elements' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .anoel-heading-text' => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .anoel-skew-bg::before' => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .anoel-skew-bg::after' => 'background-color: {{VALUE}}',
					),
					'default'   => '#000',
				)
			);

		$this->end_controls_section();
	}
	/**
	 * Widget styles.
	 *
	 * @access private
	 *
	 * @return void
	 */
	private function style_tab() {

		$this->general_styles();
		$this->content_styles();

	}

	/**
	 * Render section heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( 'yes' === $settings['is_linked_title'] && isset( $settings['heading_link'] ) ) {

			$this->add_link_attributes( 'heading_link', $settings['heading_link'] );

			$link_attributes = $this->get_render_attribute_string( 'heading_link' );

			$text = sprintf(
				'<a %1$s>%2$s</a>',
				$link_attributes,
				$settings['anoelsh_heading_text']
			);

		} else {
			$text = $settings['anoelsh_heading_text'];
		}

		$this->add_render_attribute( 'anoel-section-heading', 'class', 'anoel-section-heading' );
		$this->add_render_attribute( 'anoel-section-heading', 'class', 'anoel-section-heading-' . esc_attr( $settings['align'] ) );

		?>

		<div <?php echo $this->get_render_attribute_string( 'anoel-section-heading' ); ?>>
			<div class="anoel-skew-bg">
				<h4 class="anoel-heading-text clearfix">
					<?php echo $text; ?>
				</h4>
			</div>
		</div>

		<?php
	}
}
