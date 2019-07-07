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

if ( !class_exists( 'GattoVerdePlugin' ) ) {

	class GattoVerdePlugin
	{
		public $plugin;

		public function __construct() {
			$this->plugin = plugin_basename( __FILE__ );
		}

		function register() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

			add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

			// add a filter for include some link into plugins page
			add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
		}

		public function settings_link( $links ) {
			// add custom settings link
			$settings_link = '<a href="admin.php?page=gattoverde_plugin">Settings</a>';

			array_push( $links, $settings_link );

			return $links;
		}

		public function add_admin_pages() {
			add_menu_page( 'GattoVerde Plugin', 'GattoVerde', 'manage_options', 'gattoverde_plugin', array($this, 'admin_index'), 'dashicons-store', 110 );
		}

		public function admin_index() {
			// require template
			require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
		}

		protected function create_post_type() {
			add_action( 'init', array( $this, 'custom_post_type' ) );
		}

		// create a custom post type
		function custom_post_type() {
			register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
		}

		function enqueue() {
			// enqueue all scripts
			wp_enqueue_style( 'gattoverdestyle', plugins_url( 'assets/mystyles.css', __FILE__) );
			wp_enqueue_script( 'gattoverdescript', plugins_url( 'assets/myscripts.js', __FILE__) );
		}

		function activate() {
			require_once plugin_dir_path( __FILE__ ) . 'inc/gattoverde-plugin-activate.php';
			GattoVerdePluginActivate::activate();		
		}

		// function for deactivation
		function deactivate() {
			// flush revrite rules
			flush_rewrite_rules();
		}
	}

	if ( class_exists( 'GattoVerdePlugin' ) ) {
		$gattoVerde = new GattoVerdePlugin();
		$gattoVerde->register();
	}

	// activation hook
	register_activation_hook( __FILE__, array( $gattoVerde, 'activate' ) );

	// deactivation 
	require_once plugin_dir_path( __FILE__ ) . 'inc/gattoverde-plugin-deactivate.php';
	register_deactivation_hook( __FILE__, array( 'GattoVerdePluginDeactivate', 'deactivate' ) );

}

// LESSONS 1-8
// if ( !class_exists( 'GattoVerdePlugin' ) ) {

// 	class GattoVerdePlugin
// 	{
// 		static function register() {
// 			add_action( 'admin_enqueue_scripts', array( 'GattoVerdePlugin', 'enqueue' ) );
// 		}

// 		protected function create_post_type() {
// 			add_action( 'init', array( $this, 'custom_post_type' ) );
// 		}

// 		// function for activation plugin
// 		// function activate() {
// 		// 	// gereate a CPT
// 		// 	// flush rewrite rules
// 		// 	$this->create_post_type();
// 		// 	flush_rewrite_rules();
// 		// }

// 		function activate() {
// 			require_once plugin_dir_path( __FILE__ ) . 'inc/gattoverde-plugin-activate.php';
// 			GattoVerdePluginActivate::activate();		
// 		}

// 		// function for deactivation
// 		function deactivate() {
// 			// flush revrite rules
// 			flush_rewrite_rules();
// 		}

// 		// function for unistall
// 		// function unistall() {
// 		//     // delete CPT
// 		//     // flush revrite rules
// 		//     flush_rewrite_rules();
// 		// }

// 		// create a custom post type
// 		function custom_post_type() {
// 			register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
// 		}

// 		static function enqueue() {
// 			// enqueue all scripts
// 			wp_enqueue_style( 'gattoverdestyle', plugins_url( 'assets/mystyles.css', __FILE__) );
// 			wp_enqueue_script( 'gattoverdescript', plugins_url( 'assets/myscripts.js', __FILE__) );
// 		}
// 	}

// 	if ( class_exists( 'GattoVerdeplugin' ) ) {
// 		$gattoVerde = new GattoVerdePlugin();
// 		$gattoVerde->register();
// 		// GattoVerdeplugin::register();
// 	}

// 	// activation hook
// 	require_once plugin_dir_path( __FILE__ ) . 'inc/gattoverde-plugin-activate.php';
// 	// register_activation_hook( __FILE__, array( 'GattoVerdePluginActivate', 'activate' ) );
// 	register_activation_hook( __FILE__, array( $gattoVerde, 'activate' ) );

// 	// deactivation 
// 	require_once plugin_dir_path( __FILE__ ) . 'inc/gattoverde-plugin-deactivate.php';
// 	register_deactivation_hook( __FILE__, array( 'GattoVerdePluginDeactivate', 'deactivate' ) );

// }