<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

if (!function_exists('nvd')) {
	function nvd($arr){
		echo '<pre dir="ltr">';
			var_dump($arr);
		echo '</pre>';
	}
}


/**
 * Holds plugin's URI
 * @const
 */ 
define('ANOEL_URI', plugin_dir_url( __FILE__ ));

/**
 * Holds plugin's text domain
 * @const
 */
define('ANOEL_TEXTDOM', 'anonyengine-elements');

/**
 * Holds plugin's classes
 * @const
 */
define('ANOEL_ClASSES', ANOEL_DIR . 'classes');

/**
 * Holds plugin's Widgets' classes
 * @const
 */
define('ANOEL_WIDGETS_ClASSES', ANOEL_DIR . 'classes/widgets');

/**
 * Holds plugin's Widgets' controls
 * @const
 */
define('ANOEL_CONTROLS_ClASSES', ANOEL_DIR . 'classes/controls');



define('ANOEL_AUTOLOADS' ,serialize(array(
	ANOEL_ClASSES,
	ANOEL_WIDGETS_ClASSES,
	ANOEL_CONTROLS_ClASSES
)));

/*
*Classes Auto loader
*/
spl_autoload_register( function ( $class_name ) {

	if ( false !== strpos( $class_name, 'ANONY_Extension_' )) {

		$class_name = preg_replace('/ANONY_Extension_/', '', $class_name);

		$class_name  = strtolower(str_replace('_', '-', $class_name));
		
		$class_file = $class_name .'.php';

		if(file_exists($class_file)){

			require_once($class_file);
		}else{
			foreach(unserialize( ANOEL_AUTOLOADS ) as $path){

				$class_file = wp_normalize_path($path).'/' .$class_name . '.php';				

				if(file_exists($class_file)){

					require_once($class_file);
				}else{

					$class_file = wp_normalize_path($path) .$class_name .'/' .$class_name . '.php';

					if(file_exists($class_file)){

						require_once($class_file);
					}
				}
			}
		}
		
	}
} );