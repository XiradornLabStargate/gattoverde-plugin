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
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// the activation and deactivation must be external end not inside a recall classes
// use Inc\Base\Activate;
// use Inc\Base\Deactivate;
// we can call directly

function activate_gattoverde_plugin() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_gattoverde_plugin' );

function deactivate_gattoverde_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_activation_hook( __FILE__, 'deactivate_gattoverde_plugin' );

if ( class_exists( 'Inc\\Init' ) ) {
	// Int\Init::class; if you want use directly the class
	// or better we can use the REGISTER SERVICES
	Inc\Init::register_services();
}
