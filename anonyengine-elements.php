<?php
/**
 * Plugin Name: AnonyEngine Elements
 * Plugin URI: https://makiomar.com
 * Description: An AnonyEngine extension for elementor plugin
 * Version: 1.0.0
 * Author: Mohammad Omar
 * Author URI: https://makiomar.com
 * Text Domain: anonyengine-elements
 * License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.


/**
 * Holds plugin's PATH
 * @const
 */ 
define('ANOEL_DIR', wp_normalize_path(plugin_dir_path( __FILE__ )));

require_once( ANOEL_DIR . 'config.php');

ANONY_Extension_Elements::instance();

