<?php
/**
 * Elementor widgets loader
 *
 * PHP version 7.3 Or Later
 *
 * @package  Widgets
 * @author   Makiomar <info@makior.com>
 * @license  https://makiomar.com AnonyEngine Licence
 * @link     https://makiomar.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

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
	private static $instance = null;

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

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'scripts' ) );
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'scripts' ) );
		add_action( 'elementor/editor/before_enqueue_styles', array( $this, 'styles' ) );
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'styles' ) );
	}


	/**
	 * Register widgets style
	 */
	public function styles() {

		$styles = array(
			'owl-menu'           => 'owl-menu',
			'posts-grid'         => 'posts-grid',
			'slick-vtext'        => 'slick-vtext-slider.min',
			'animated-icon-list' => 'animated-icon-list',
			'skew-carousel'      => 'skew-carousel',
			'terms-dropdown'      => 'terms-dropdown.min',
			'section-heading' => 'section-heading',
		);

		$styles_libs = array(
			'circle'             => 'circle',
			'slick'              => 'slick',
			'heapshot'           => 'heapshot',
			'owl.carousel'       => 'owl.carousel.min',
			'font-awesome-5-all' => 'all',
		);

		$styles = array_merge( $styles, $styles_libs );

		foreach ( $styles as $style => $file_name ) {

			$handle = in_array( $style, array_keys( $styles_libs ), true ) ? $style : 'anoel-' . $style;

			wp_register_style(
				$handle,
				ANOEL_URI . 'assets/css/' . $file_name . '.css',
				false,
				filemtime(
					wp_normalize_path( ANOEL_DIR . 'assets/css/' . $file_name . '.css' )
				)
			);
		}

	}

	/**
	 * Register widgets scripts
	 */
	public function scripts() {

		wp_enqueue_script( 'jquery' );

		$scripts = array(
			'slick-vtext'        => 'slick-vtext-slider.min',
			'headpshot-init'     => 'headpshot-init',
			'animated-icon-list' => 'animated-icon-list',
			'skew-carousel'      => 'skew-carousel',
			'terms-dropdown'      => 'terms-dropdown.min',
		);

		$libs_scripts = array(
			'circle'       => 'circle',
			'slick'        => 'slick.min',
			'heapshot'     => 'jquery.heapshot',
			'imagesloaded' => 'jquery.imagesloaded.min',
			'jQueryRotate' => 'jQueryRotate.min',
			'owl.carousel' => 'owl.carousel.min',
		);

		$scripts = array_merge( $scripts, $libs_scripts );

		foreach ( $scripts as $script => $file_name ) {

			$handle = in_array( $script, array_keys( $libs_scripts ), true ) ? $script : 'anoel-' . $script;

			if ( 'slick-vtext' === $script ) {
				$deps = array( 'jquery', 'slick' );
			} else {
				$deps = array( 'jquery' );
			}
			$registered = wp_enqueue_script(
				$handle,
				ANOEL_URI . 'assets/js/' . $file_name . '.js',
				$deps,
				filemtime(
					wp_normalize_path( ANOEL_DIR . 'assets/js/' . $file_name . '.js' )
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

		load_plugin_textdomain( 'anonyengine-elements' );

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

		// Check if Elementor installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version.
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version.
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'minimum_php_version' ) );
			return;
		}

		// Add Plugin actions.
		add_action( 'elementor/elements/categories_registered', array( $this, 'widgets_categories' ) );
		add_action( 'elementor/widgets/register', array( $this, 'init_widgets' ) );
	}

	/**
	 * Add custome category
	 *
	 * @param object $elements_manager Elementor mangare object.
	 */
	public function widgets_categories( $elements_manager ) {

		$elements_manager->add_category(
			'anonyengine',
			array(
				'title' => __( 'AnonyEngine', 'anonyengine-elements' ),
				'icon'  => 'fa fa-gear',
			)
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
	public function missing_main_plugin() {

		deactivate_plugins( plugin_basename( ANONYENGINE_ELEMENTS ) );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			__( '"%1$s" requires "%2$s" to be installed and activated.', 'anonyengine-elements' ),
			'<strong>' . __( 'AnonyEngine Elements', 'anonyengine-elements' ) . '</strong>',
			'<strong>' . __( 'Elementor', 'anonyengine-elements' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses( $message, array( 'strong' => array() ) ) );

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
	public function minimum_elementor_version() {

		deactivate_plugins( plugin_basename( ANONYENGINE_ELEMENTS ) );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			__( '"%1$s" requires "%2$s" version %3$s or greater.', 'anonyengine-elements' ),
			'<strong>' . __( 'AnonyEngine Elements', 'anonyengine-elements' ) . '</strong>',
			'<strong>' . __( 'Elementor', 'anonyengine-elements' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses( $message, array( 'strong' => array() ) ) );

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
	public function minimum_php_version() {

		deactivate_plugins( plugin_basename( ANONYENGINE_ELEMENTS ) );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			__( '"%1$s" requires "%2$s" version %3$s or greater.', 'anonyengine-elements' ),
			'<strong>' . __( 'AnonyEngine Elements', 'anonyengine-elements' ) . '</strong>',
			'<strong>' . __( 'PHP', 'anonyengine-elements' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses( $message, array( 'strong' => array() ) ) );

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

		$widgets = array(

			// 'ANOEL_Oembed',
			'ANOEL_Terms_Dropdown',
			'ANOEL_Animated_Icon_List',
			'ANOEL_Vertical_Text_Slider',
			'ANOEL_Skew_Carousel',
			'ANOEL_Section_Heading',
			'ANOEL_Simple_Content',

		);

		foreach ( $widgets as $widget ) {
			if ( class_exists( $widget ) ) {

				// Register widget.
				\Elementor\Plugin::instance()->widgets_manager->register( new $widget() );
			}
		}

	}

}
