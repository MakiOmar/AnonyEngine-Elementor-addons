<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * Elementor Animated icon list Widget.
 *
 * Elementor widget that inserts simple content into the page.
 *
 * @since 1.0.0
 */
class ANONY_Extension_Animated_Icon_List extends \Elementor\Widget_Base {
	
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Animated icon list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'animated-icon-list';
	}
	
	/**
	 * Get widget title.
	 *
	 * Retrieve Animated icon list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Animated icon list', ANOEL_TEXTDOM );
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
		return [ 'icon', 'list' ];
	}
	
	/**
	 * Get widget icon.
	 *
	 * Retrieve Animated icon list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-list';
	}
	
	
	/**
	 * Get scripts dependancies
	 * @return type
	 */
	public function get_script_depends(){
		
		return [];
	}
	
	/**
	 * Get style dependancies
	 * @return type
	 */
	public function get_style_depends(){
		
		return ['anoel-animated-icon-list', 'elementor-icons-fa-solid', 'elementor-icons-shared-0'];
	}
	
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Animated icon list widget belongs to.
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
	 * Register Animated icon list widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', ANOEL_TEXTDOM ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
			$repeater = new \Elementor\Repeater();
			
			$repeater->add_control(
				'content_number',
				[
					'label' => esc_html__( 'Number or text', ANOEL_TEXTDOM ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '01',
				]
			);
			
			$repeater->add_control(
				'content_icon',
				[
					'label' => esc_html__( 'Icon', ANOEL_TEXTDOM ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-star',
						'library' => 'solid',
					],
				]
			);
			
			
			$repeater->add_control(
				'item_content', [
					'label' => esc_html__( 'Title', ANOEL_TEXTDOM ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Add your title here' , ANOEL_TEXTDOM ),
					'show_label' => false,
					'dynamic' => [
						'active' => true,
					],
				]
			);
			
			$this->add_control(
				'animated_icon_list',
				[
					'label' => esc_html__( 'Animated icon list', ANOEL_TEXTDOM ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'item_content' => esc_html__( 'Item content #1', ANOEL_TEXTDOM ),
							'content_icon' => [
								'value' => 'fas fa-check',
								'library' => 'fa-solid',
							],
						],
						[
							'item_content' => esc_html__( 'Item content #2', ANOEL_TEXTDOM ),
							'content_icon' => [
								'value' => 'fas fa-times',
								'library' => 'fa-solid',
							],
						],
						
						[
							'item_content' => esc_html__( 'Item content #3', ANOEL_TEXTDOM ),
							'content_icon' => [
								'value' => 'fas fa-dot-circle',
								'library' => 'fa-solid',
							],
						],
					],
					'title_field' => '{{{ elementor.helpers.renderIcon( this, content_icon, {}, "i", "panel" ) || \'<i class="{{ content_icon }}" aria-hidden="true"></i>\' }}} {{{ item_content }}}',
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
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .anoshc-animated-icon-list' => 'justify-content: {{VALUE}};',
					],
				]
			);
			
			$this->add_responsive_control(
				'icon_position',
				[
					'label' => __( 'Icon position', 'elementor' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'row' => [
							'title' => __( 'Left', 'elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						
						'row-reverse' => [
							'title' => __( 'Right', 'elementor' ),
							'icon' => 'eicon-text-align-right',
						],
						
					],
					'default' => 'row',
					'selectors' => [
						'{{WRAPPER}} .anoshc-animated-icon-list' => 'display: flex; flex-direction: {{VALUE}}',
					],
				]
			);	
		
		$this->end_controls_section();
		
		$this->style_tab();

	}
	
	
	private function style_tab(){
		
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			
			$this->add_control(
				'text_color_heading',
				[
					'label' => esc_html__( 'Text', ANOEL_TEXTDOM ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			
			$this->add_control(
				'content_color',
				[
					'label' => esc_html__( 'Color', ANOEL_TEXTDOM ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .anoshc-animated-icon-list div:not(i)' => 'color: {{VALUE}}'
					],
				]
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'text_typography',
					'label' => esc_html__( 'Typography', 'elementor' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .anoshc-animated-icon-list div:not(i)',
				]
			);
			
			$this->add_control(
				'icon_color_heading',
				[
					'label' => esc_html__( 'Icon', ANOEL_TEXTDOM ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			
			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Color', ANOEL_TEXTDOM ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .anoshc-animated-icon-list div > i' => 'color: {{VALUE}}'
					],
				]
			);
			
			$this->add_responsive_control(
				'size',
				[
					'label' => __( 'Size', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 6,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .anoshc-animated-icon-list i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
			
			$this->add_responsive_control(
				'space_between',
				[
					'label' => __( 'Space Between', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'%' => [
							'min' => 0,
							'max' => 100,
						]
					],
					'default' => [
						'unit' => '%',
						'size' => 10,
					],
					'selectors' => [
						
						'body.rtl {{WRAPPER}} .anoshc-animated-icon-list .animated-icon-list-item' => 'margin-left: {{SIZE}}{{UNIT}}',
						'body:not(.rtl) {{WRAPPER}} .anoshc-animated-icon-list .animated-icon-list-item' => 'margin-right: {{SIZE}}{{UNIT}}',
					],
				]
			);

			
		
		
		$this->end_controls_section();
	}

	/**
	 * Render Animated icon list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		$this->add_render_attribute( 'animated_icon_list', 'class', 'anoshc-animated-icon-list' );
		
		if ( 'row-reverse' === $settings['icon_position'] ) {
			$this->add_render_attribute( 
				'animated_icon_list_item',
				[
					'class' => ['row-reverse', 'animated-icon-list-item']
				]
			);
			
		}else{
			$this->add_render_attribute( 'animated_icon_list_item', ['class' => ['row', 'animated-icon-list-item']] );
		}
		
		$icon_position = $settings['icon_position'];
		
		if ( $settings['animated_icon_list'] && !empty($settings['animated_icon_list']) ) {
			
			$data = [];
			
			foreach ($settings['animated_icon_list'] as $index => $item) {
				
				$temp['content'] = $item['item_content'];
				$temp['icon'] = $item['content_icon']['value'];
				$temp['content_icon'] = $item['content_icon'];
				$temp['content_number'] = $item['content_number'];
				
				$data[] = $temp;
				
			}
		
			if(empty($data)){
				esc_html_e( 'Please add some items' );
				
				return;
			}
			
			
			include wp_normalize_path( ANOEL_DIR . 'templates/animated-icon-list.php' );
		}
		
	?>
	
	

	<?php }
	
	
	/**
	 * Render Animated icon list widget output on the backend editor.
	 *
	 * Written in js and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {

		?>
		
		
		<# 
		
			view.addRenderAttribute( 'animated_icon_list', 'class', 'anoshc-animated-icon-list' );
		
			if ( 'row-reverse' == settings.icon_position ) {
				view.addRenderAttribute( 'animated_icon_list_item', 'class', 'row-reverse' );
			}
		
			var iconsHTML = {},
				migrated = {};
		
		#>
		
		<div {{{ view.getRenderAttributeString( 'animated_icon_list' ) }}}>
			
			<# _.each( settings.animated_icon_list, function( item, index ) {
				
				iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.content_icon, { 'aria-hidden': true }, 'i', 'object' );
			
			 #>
			
				<div {{{ view.getRenderAttributeString( 'animated_icon_list_item' ) }}}>
					<div class="anli-number">{{{item.content_number}}}</div>
					<div class="anli-icon">{{{ iconsHTML[ index ].value }}}</div>
					<div class="anli-content">{{{ item.item_content }}}</div>
				</div>
			
			<# } ); #>
			
		</div>
		

	<?php }
}