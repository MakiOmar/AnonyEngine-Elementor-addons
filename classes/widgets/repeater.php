<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * Elementor Repeater Widget.
 *
 * Elementor widget that inserts simple content into the page.
 *
 * @since 1.0.0
 */
class ANONY_Extension_Repeater extends \Elementor\Widget_Base {
	
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Repeater widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'repeater';
	}
	
	/**
	 * Get widget title.
	 *
	 * Retrieve Repeater widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Repeater', ANOEL_TEXTDOM );
	}
	
	/**
	 * Get widget icon.
	 *
	 * Retrieve Repeater widget icon.
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
	 * @return type
	 */
	public function get_script_depends(){
		
		return ['slick','anoel-slick-vtext'];
	}
	
	/**
	 * Get style dependancies
	 * @return type
	 */
	public function get_style_depends(){
		
		return ['slick','anoel-slick-vtext'];
	}
	
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Repeater widget belongs to.
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
	 * Register Repeater widget controls.
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
				'label' => __( 'Content', ANOEL_TEXTDOM ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
			$repeater = new \Elementor\Repeater();
			
			$repeater->add_control(
				'list_title', [
					'label' => __( 'Title', 'plugin-domain' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'List Title' , 'plugin-domain' ),
					'label_block' => true,
					'dynamic' => [
						'active' => true,
					],
				]
			);
			
			
			$repeater->add_control(
				'list_content', [
					'label' => __( 'Content', 'plugin-domain' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => __( 'List Content' , 'plugin-domain' ),
					'show_label' => false,
					'dynamic' => [
						'active' => true,
					],
				]
			);
			
			
			$repeater->add_control(
				'list_color',
				[
					'label' => __( 'Color', 'plugin-domain' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
					],
				]
			);
			
			
			$repeater->add_control(
				'icon',
				[
					'label' => __( 'Icon', ANOEL_TEXTDOM ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-star',
						'library' => 'solid',
					],
				]
			);

			
			
			$this->add_control(
				'list',
				[
					'label' => __( 'Repeater List', 'plugin-domain' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'list_title' => __( 'Title #1', 'plugin-domain' ),
							'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
						],
						[
							'list_title' => __( 'Title #2', 'plugin-domain' ),
							'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
						],
					],
					'title_field' => '{{{ list_title }}}',
				]
			);
		
		$this->end_controls_section();
		
		$this->style_tab();

	}
	
	
	private function style_tab(){
		
	}

	/**
	 * Render Repeater widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		if ( $settings['list'] ) { ?>
			
			<ul class="anoshc-slick-vtext">
				
				<li><i class="fa fa-cc-visa" aria-hidden="true"></i><?= esc_html__( ' Secure payment', ANOEL_TEXTDOM ) ?></li>
				<li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><?= esc_html__( ' 100% Authentic Products', ANOEL_TEXTDOM ) ?></li>
				<li><i class="fa fa-truck" aria-hidden="true"></i><?= esc_html__( ' Express delivery available from 8 am to 12:30 am', ANOEL_TEXTDOM ) ?></li>
				<li><i class="fa fa-gift" aria-hidden="true"></i><?= esc_html__( ' Free Delivery Within 6 business days', ANOEL_TEXTDOM ) ?></li>
				<li><i class="fa fa-usd" aria-hidden="true"></i><?= esc_html__( ' Limited Time Exclusive Offers', ANOEL_TEXTDOM ) ?></li>
				
			</ul>
			
		<?php }
		
	?>
	
	

	<?php }
	
	
	/**
	 * Render Repeater widget output on the backend editor.
	 *
	 * Written in js and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {

		?>
		
		<# if ( settings.list.length ) { #>
			<ul class="anoshc-slick-vtext">
	
				<li><i class="fa fa-cc-visa" aria-hidden="true"></i>kkkkkkkkkkkkkkkkkkkkkkkk</li>
				<li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>hhhhhhhhhhhhhhhhhhhhhhh</li>
				<li><i class="fa fa-truck" aria-hidden="true"></i>kjjjjjjjjjjjjjjjjjjjjjjjjj</li>
				<li><i class="fa fa-gift" aria-hidden="true"></i>oooooooooooooooooooooooo</li>
				<li><i class="fa fa-usd" aria-hidden="true"></i>ppppppppppppppppppppppppp</li>
				
			</ul>
		<# } #>
		

	<?php }
}