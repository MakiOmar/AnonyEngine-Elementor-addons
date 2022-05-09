<?php
use Elementor\Utils;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * Elementor Vertical text slider Widget.
 *
 * Elementor widget that inserts simple content into the page.
 *
 * @since 1.0.0
 */
class ANOEL_Skew_Carousel extends \Elementor\Widget_Base {
	
	
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
		return 'skew-carousel';
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
		return __( 'Skew carousel', 'anonyengine-elements' );
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
		return [ 'slider', 'carousel' ];
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
		return 'fa-sliders';
	}
	
	
	/**
	 * Get scripts dependancies
	 * @return type
	 */
	public function get_script_depends(){
		
		return ['anoel-skew-carousel'];
	}
	
	/**
	 * Get style dependancies
	 * @return type
	 */
	public function get_style_depends(){
		
		return ['anoel-skew-carousel'];
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
		return [ 'anonyengine' ];
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
			[
				'label' => esc_html__( 'Content', 'anonyengine-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
			$repeater = new \Elementor\Repeater();
			
			
			$repeater->add_control(
				'item_image_1', [
					'label' => esc_html__( 'Main image', 'anonyengine-elements' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
					'show_label' => true,
				]
			);
			
			$repeater->add_control(
				'item_image_2', [
					'label' => esc_html__( 'Hover image', 'anonyengine-elements' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
					'show_label' => true,
				]
			);
			
			$repeater->add_control(
				'item_description', [
					'label' => esc_html__( 'Description', 'anonyengine-elements' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => '<p>' . __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ) . '</p>',
					'show_label' => true,
				]
			);
			
			$this->add_control(
				'skew_carousel_content',
				[
					'label' => esc_html__( 'Skew carousel content', 'anonyengine-elements' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'item_description' => '<p>' . __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ) . '</p>',
							'item_image' => \Elementor\Utils::get_placeholder_image_src()
						],
						
						[
							'item_description' => '<p>' . __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ) . '</p>',
							'item_image' => \Elementor\Utils::get_placeholder_image_src()
						],
						
						[
							'item_description' => '<p>' . __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ) . '</p>',
							'item_image' => \Elementor\Utils::get_placeholder_image_src()
						],
						
					],
					
				]
			);
			
			

		
		$this->end_controls_section();
		
		$this->style_tab();

	}
	
	
	private function style_tab(){
		
		$this->start_controls_section(
			'section_slide_style',
			[
				'label' => esc_html__( 'Slide', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			
			$this->add_control(
				'overlay_color',
				[
					'label' => esc_html__( 'Overlay Color', 'anonyengine-elements' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-img-2:before' => 'background-color: {{VALUE}}'
					],
				]
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Css_Filter::get_type(),
				[
					'name' => 'css_filters',
					'selector' => '{{WRAPPER}} .item-img-loaded',
				]
			);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_description_style',
			[
				'label' => esc_html__( 'Description', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			
			$this->add_control(
				'description_color',
				[
					'label' => esc_html__( 'Color', 'elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .image-text p' => 'color: {{VALUE}}'
					],
				]
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'description_typography',
					'label' => esc_html__( 'Typography', 'elementor' ),
					'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .image-text p',
				]
			);
			
			$this->add_responsive_control(
				'align',
				[
					'label' => __( 'Alignment', 'elementor' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'elementor' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'elementor' ),
							'icon' => 'eicon-text-align-right',
						],
						
						'justify' => [
							'title' => __( 'Justified', 'elementor' ),
							'icon' => 'eicon-text-align-justify',
						]
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .image-text p' => 'text-align: {{VALUE}};',
					],
				]
			);
		
		$this->end_controls_section();
	}

	/**
	 * Render Vertical text slider widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		if ( $settings['skew_carousel_content'] && !empty($settings['skew_carousel_content']) ) {
			
			$data = [];
			
			foreach ($settings['skew_carousel_content'] as $index => $item) {
				
				$temp['img1_url'] = $item['item_image_1']['url'];
				$temp['img2_url'] = $item['item_image_2']['url'];
				
				$temp['description'] = $item['item_description'];
				
				$data[] = $temp;
				
			}
			
			if(empty($data)){
				esc_html_e( 'Please add some items' );
				
				return;
			}
			
			include wp_normalize_path( ANOEL_DIR . 'templates/skew-carousel.php' );
		}
		
		
		
	?>
	
	

	<?php }
	
	
	/**
	 * Render Vertical text slider widget output on the backend editor.
	 *
	 * Written in js and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {

		?>
		
		<section id="slider">
			<div class="slider-content">
				
				<# _.each( settings.skew_carousel_content, function( item, index ) {
				
				
					if(index == 0){
						view.addRenderAttribute( 'image_class', 'class', 'image image-first' );
					}else if(index == settings.skew_carousel_content.length - 1 ){
						view.addRenderAttribute( 'image_class', 'class', 'image image-last' );
					}else{
					
						view.addRenderAttribute( 'image_class', 'class', 'image' );
					}
					
					
				
				 #>
			
					<div {{{ view.getRenderAttributeString( 'image_class' ) }}} data-href="#" data-click="0">
						<div class="slider-item">
							<div class="item-img-1" data-src="{{{ item.item_image_1.url }}}"></div>
							<div class="item-img-2" data-src="{{{ item.item_image_2.url }}}"></div>
						</div>
						<div class="image-text">{{{ item.item_description }}}</div>
					</div>
			
				<# } ); #>
		
			</div>
		</section>
		

	<?php }
}