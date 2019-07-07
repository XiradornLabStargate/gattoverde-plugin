<?php
/**
 * @package GattoVerdePlugin
 */

/*
Plugin Name: Gatto Verde Plugin
Plugin URI: https://xiradorn.it
Description: Plugin Test
Version: 1.0.0
Author: Xiradorn
Author URI: https://xiradorn.it
License: GPLv3
Text Domain: gatto-verde
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'You can\'t!' );
}

// autoload 
if ( file_exists( dirname( __FILE__ ) . 'vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . 'vendor/autoload.php' );
}

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );

if ( class_exists( 'Inc\\Init' ) ) {
	// Int\Init::class; if you want use directly the class
	// or better we can use the REGISTER SERVICES
	Inc\Init::register_services();
}
