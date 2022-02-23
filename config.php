<?php
/**
 * AnonyEngine elements configuration file
 *
 * PHP version 7.3 Or Later
 *
 * @package  AnonyEngine elements
 * @author   Makiomar <info@makior.com>
 * @license  https://makiomar.com AnonyEngine Licence
 * @link     https://makiomar.com/anonyengine_elements
 */

defined( 'ABSPATH' ) || die(); // Exit if accessed direct.

if ( ! function_exists( 'nvd' ) ) {
	/**
	 * Debug helper
	 *
	 * @param mixed $data Debug data.
	 *
	 * @return void
	 */
	function nvd( $data ) {
		echo '<pre dir="ltr">';
			var_dump( $data );
		echo '</pre>';
	}
}


/**
 * Holds plugin's URI
 *
 * @const
 */
define( 'ANOEL_URI', plugin_dir_url( __FILE__ ) );


/**
 * Holds plugin's classes
 *
 * @const
 */
define( 'ANOEL_CLASSES', ANOEL_DIR . 'classes' );

/**
 * Holds plugin's Widgets' classes
 *
 * @const
 */
define( 'ANOEL_WIDGETS_CLASSES', ANOEL_DIR . 'classes/widgets' );

/**
 * Holds plugin's Widgets' controls
 *
 * @const
 */
define( 'ANOEL_CONTROLS_CLASSES', ANOEL_DIR . 'classes/controls' );



define(
	'ANOEL_AUTOLOADS',
	wp_json_encode(
		array(
			ANOEL_CLASSES,
			ANOEL_WIDGETS_CLASSES,
			ANOEL_CONTROLS_CLASSES,
		)
	)
);

/**
 * Classes Auto loader
 */
spl_autoload_register(
	function ( $class_name ) {

		if ( false !== strpos( $class_name, 'ANOEL_' ) ) {

			$class_name = 'class-'. strtolower( str_replace( '_', '-', $class_name ) );

			$class_file = $class_name . '.php';

			if ( file_exists( $class_file ) ) {

				require_once $class_file;

			} else {
				
				foreach ( json_decode( ANOEL_AUTOLOADS ) as $path ) {

					$class_file = wp_normalize_path( $path ) . '/' . $class_name . '.php';

					if ( file_exists( $class_file ) ) {

						require_once $class_file;
					}
				}
			}
		}
	}
);
