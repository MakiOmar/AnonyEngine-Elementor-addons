<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * Main AnonyEngine Elements Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class ANOEL_Elements_Loader {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var ANOEL_Elements The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return ANOEL_Elements An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, '_scripts' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, '_scripts' ] );
		add_action( 'elementor/editor/before_enqueue_styles', [ $this, '_styles' ] );
		add_action( 'elementor/frontend/after_register_styles', [ $this, '_styles' ] );
	}
	
	
	/**
	 * Register widgets style
	 */
	public function _styles(){
			
		$styles = array(
			'owl-menu' => 'owl-menu',
			'posts-grid' => 'posts-grid',
			'slick-vtext' => 'slick-vtext-slider.min',
			'animated-icon-list' => 'animated-icon-list',
			'skew-carousel' => 'skew-carousel',
		);
			
		$styles_libs = [
			'circle' => 'circle',
			'slick' => 'slick',
			'heapshot' => 'heapshot',
			'owl.carousel' => 'owl.carousel.min',
			'font-awesome-5-all' => 'all',
		];
		
		$styles = array_merge($styles, $styles_libs);

		foreach($styles as $style => $file_name){
			
			$handle = in_array($style, array_keys($styles_libs)) ? $style : 'anoel-' . $style;
			
			wp_register_style( 
				$handle, 
				ANOEL_URI . 'assets/css/'.$file_name.'.css', 
				false,
				filemtime(
					wp_normalize_path(ANOEL_DIR . 'assets/css/'.$file_name.'.css' )
				) 
			);
		}

	}
	
	/**
	 * Register widgets scripts
	 */
	public function _scripts(){
		
		wp_enqueue_script( 'jquery' );
		
		$scripts = array(
			'slick-vtext' => 'slick-vtext-slider.min',
			'headpshot-init' => 'headpshot-init',
			'animated-icon-list' => 'animated-icon-list',
			'skew-carousel' => 'skew-carousel',
		);
		
		$libs_scripts = [
			'circle' => 'circle',
			'slick' => 'slick.min',
			'heapshot' => 'jquery.heapshot',
			'imagesloaded' => 'jquery.imagesloaded.min',
			'jQueryRotate' => 'jQueryRotate.min',
			'owl.carousel' => 'owl.carousel.min'
		];
		
		$scripts = array_merge($scripts, $libs_scripts);

		foreach($scripts as $script => $file_name){

			
			$handle = in_array($script, array_keys($libs_scripts) ) ? $script : 'anoel-' . $script;
			
			if ($script == 'slick-vtext') {
				$deps = ['jquery', 'slick'];
			}else{
				$deps = ['jquery'];
			}
			$registered = wp_enqueue_script( 
				$handle , 
				ANOEL_URI . 'assets/js/'.$file_name.'.js' ,
				$deps,
				filemtime(
					wp_normalize_path(ANOEL_DIR . 'assets/js/'.$file_name.'.js' )
				), 
				true 
			);
			
			
		}
		
		
	}
	

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( ANOEL_TEXTDOM );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'missingMainPlugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'minimumElementorVersion' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'minimumPhpVersion' ] );
			return;
		}
		

		// Add Plugin actions
		add_action( 'elementor/elements/categories_registered', [ $this, 'widgetsCategories' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
	}
	
	/**
	 * Add custome category
	 * @param object $elements_manager 
	 */
	public function widgetsCategories( $elements_manager ) {

		$elements_manager->add_category(
			'anonyengine',
			[
				'title' => __( 'AnonyEngine', ANOEL_TEXTDOM ),
				'icon' => 'fa fa-gear',
			]
		);

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function missingMainPlugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', ANOEL_TEXTDOM ),
			'<strong>' . esc_html__( 'AnonyEngine Elements', ANOEL_TEXTDOM ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', ANOEL_TEXTDOM ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function minimumElementorVersion() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', ANOEL_TEXTDOM ),
			'<strong>' . esc_html__( 'AnonyEngine Elements', ANOEL_TEXTDOM ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', ANOEL_TEXTDOM ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function minimumPhpVersion() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', ANOEL_TEXTDOM ),
			'<strong>' . esc_html__( 'AnonyEngine Elements', ANOEL_TEXTDOM ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', ANOEL_TEXTDOM ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {
		

		$widgets = [
		
		//'ANOEL_Oembed',
		'ANOEL_Terms_Dropdown',
		'ANOEL_Animated_Icon_List',
		'ANOEL_Vertical_Text_Slider',
		'ANOEL_Skew_Carousel'
			
		
		];
		
		foreach ($widgets as $widget) {
			if (class_exists($widget)) {
				
				// Register widget
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $widget() );
			}
		}
		

	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_controls() {

		/*// Include Control files
		require_once( ANOEL_CONTROLS_CLASSES . '/test.php' );

		// Register control
		\Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \ANOEL_Elements_Control() );
		*/

	}

}