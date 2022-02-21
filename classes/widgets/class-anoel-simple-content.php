<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * Elementor Simple content Widget.
 *
 * Elementor widget that inserts simple content into the page.
 *
 * @since 1.0.0
 */
class ANOEL_Simple_Content extends \Elementor\Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Simple content widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'simple-content';
	}
	
	/**
	 * Get widget title.
	 *
	 * Retrieve Simple content widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Simple content', 'anonyengine-elements' );
	}
	
	/**
	 * Get widget icon.
	 *
	 * Retrieve Simple content widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-text';
	}
	
	
	/**
	 * Get scripts dependancies
	 * @return type
	 */
	public function get_script_depends(){
		
		return [];
	}
	
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Simple content widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'anonyengine' ];
	}
	
	/**
	 * Register Simple content widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_label',
			[
				'label' => __( 'Your content', 'anonyengine-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'more_options',
			[
				'label' => __( 'Additional Options', 'anonyengine-elements' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'content_heading',
			[
				'label' => __( 'Heading', 'anonyengine-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Add your heading', 'anonyengine-elements' ),
			]
		);
		
		
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'anonyengine-elements' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		
		$this->add_control(
			'show_image_link',
			[
				'label' => __( 'Show image url', 'anonyengine-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		
		$this->add_control(
			'image_link',
			[
				'label' => __( 'Image URL', 'anonyengine-elements' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'anonyengine-elements' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'condition' => [
					'show_image_link' => 'yes'
				]
			]
		);
		

		$this->end_controls_section();
		
		
		$this->style_tab();

	}
	
	
	private function style_tab(){
		
		$this->start_controls_section(
			'image_style',
			[
				'label' => __( 'Image', 'anonyengine-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
			$this->add_responsive_control(
				'image_width',
				[
					'label' => __( 'Width', 'plugin-domain' ),
					'type' =>  \Elementor\Controls_Manager::SLIDER,
					'description' =>  esc_html__( 'Default 100%', 'anonyengine-elements' ),
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => 100,
					],
					'selectors' => [
						'{{WRAPPER}} .test-width' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_responsive_control(
				'image_margin',
				[
					'label' => __( 'Margin', 'plugin-domain' ),
					'type' =>  \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [ 
					
						'top' => 0,
						'right' => 0,
						'bottom' => 0,
						'left' => 0,
						
					 ],
					'selectors' => [
						'{{WRAPPER}} .test-width' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		
			$this->add_control(
				'image_border',
				[
					'label' => esc_html__( 'Border', 'anonyengine-elements' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
		// Image style state
			$this->start_controls_tabs(
				'image_style_state_tabs'
			);
				
				
				//Normal state
				$this->start_controls_tab(
					'image_style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'anonyengine-elements' ),
					]
				);
					
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'normal-border',
							'label' => esc_html__( 'Border', 'anonyengine-elements' ),
							'selector' => '{{WRAPPER}} .test-width',
						]
					);
					
				$this->end_controls_tab();
				
				//Hover state
				$this->start_controls_tab(
					'image_style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'anonyengine-elements' ),
					]
				);
				
					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'hover-border',
							'label' => esc_html__( 'Border', 'anonyengine-elements' ),
							'selector' => '{{WRAPPER}} .test-width:hover',
						]
					);
				
				$this->end_controls_tab();
				
				
			$this->end_controls_tabs();
		$this->end_controls_section();
		
	}

	/**
	 * Render Simple content widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		
		$this->add_inline_editing_attributes('content_heading', 'basic');
		
		$this->add_render_attribute(
		
			'content_heading',
			
			[
				'class' => ['simple_content_heading']
			]
		
		);
		$show_image_link = $settings['show_image_link'];
		$target = '';
		$nofollow = '';
		
		if(isset($settings['image_link'])){
			$target = $settings['image_link']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $settings['image_link']['nofollow'] ? ' rel="nofollow"' : '';
			$image_link = $settings['image_link']['url'];
		}

		$heading = $settings['content_heading'];
		
		$image = $settings['image']['url'];
		
		?>

		<div class="simple-content-elementor-widget">

			<p <?= $this->get_render_attribute_string('content_heading') ?>><?= $heading ?></p>
			
			<?php if($show_image_link == 'yes') :  ?>
			
			<a href="<?= $image_link ?>"<?= $target ?><?= $nofollow ?>><img class="test-width" src="<?= $image ?>"></a>
			
			<?php else : ?>
				
				<img class="test-width">  src="<?= $image ?>">
				
			<?php endif ?>

		</div>

	<?php }
	
	
	/**
	 * Render Simple content widget output on the backend editor.
	 *
	 * Written in js and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {

		?>
		
		<#
		
		view.addInlineEditingAttributes('content_heading', 'basic');
		
		view.addRenderAttribute(
		
			'content_heading',
			
			{
				'class' : ['simple_content_heading'],
			}
			
		
		);
		
		var target = settings.image_link.is_external ? ' target="_blank"' : '';
		var nofollow = settings.image_link.nofollow ? ' rel="nofollow"' : '';
		#>

		<div class="simple-content-elementor-widget">
			
			

			<p {{ view.getRenderAttributeString('content_heading') }}>{{ settings.content_heading }}</p>
			<# if(settings.show_image_link == 'yes') { #>
			
				<a href="{{ settings.image_link.url }}  ?>"{{ target + nofollow }}><img src="{{ settings.image.url }}"></a>
			
			<# }else{ #>
			
				<img class="test-width" src="{{ settings.image.url }}">
				
			<# } #>
		</div>

	<?php }
}