<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc;

final class Init
{
	/**
	 * Store all classes inside an array
	 * @return array List of classes
	 */
	public static function get_services() {
		return [
			Base\Enqueue::class,
			Pages\Dashboard::class,
			Base\SettingsLinks::class,
			Base\CustomPostTypeControllorer::class,
		];
	}
	
	/**
	 * Loop through classes and instanciate theme.
	 * Call also register() method if exist
	 * @return 
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instanciate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  class $class 	class from get services
	 * @return class instance 	new instance of the class
	 */
	private static function instanciate( $class ) {
		$service = new $class();

		return $service;
	}
}


// sort of includion based on file name and autoload
// use Inc\Base\Activate;
// use Inc\Base\Deactivate;

// use Inc\Pages\Admin;

// if ( !class_exists( 'GattoVerdePlugin' ) ) {

// 	class GattoVerdePlugin
// 	{
// 		public $plugin;

// 		public function __construct() {
// 			$this->plugin = plugin_basename( __FILE__ );
// 		}

// 		function register() {
// 			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

// 			add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

// 			// add a filter for include some link into plugins page
// 			add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
// 		}

// 		public function settings_link( $links ) {
// 			// add custom settings link
// 			$settings_link = '<a href="admin.php?page=gattoverde_plugin">Settings</a>';

// 			array_push( $links, $settings_link );

// 			return $links;
// 		}

// 		public function add_admin_pages() {
// 			add_menu_page( 'GattoVerde Plugin', 'GattoVerde', 'manage_options', 'gattoverde_plugin', array($this, 'admin_index'), 'dashicons-store', 110 );
// 		}

// 		public function admin_index() {
// 			// require template
// 			require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
// 		}

// 		protected function create_post_type() {
// 			add_action( 'init', array( $this, 'custom_post_type' ) );
// 		}

// 		// create a custom post type
// 		function custom_post_type() {
// 			register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
// 		}

// 		function enqueue() {
// 			// enqueue all scripts
// 			wp_enqueue_style( 'gattoverdestyle', plugins_url( 'assets/mystyles.css', __FILE__) );
// 			wp_enqueue_script( 'gattoverdescript', plugins_url( 'assets/myscripts.js', __FILE__) );
// 		}

// 		function activate() {
// 			// require_once plugin_dir_path( __FILE__ ) . 'inc/gattoverde-plugin-activate.php';
// 			// GattoVerdePluginActivate::activate();
// 			Activate::activate();		
// 		}

// 	}

// 	$gattoVerde = new GattoVerdePlugin();
// 	$gattoVerde->register();

// 	// activation hook
// 	register_activation_hook( __FILE__, array( $gattoVerde, 'activate' ) );

// 	// deactivation 
// 	// require_once plugin_dir_path( __FILE__ ) . 'inc/gattoverde-plugin-deactivate.php';
// 	// register_deactivation_hook( __FILE__, array( 'GattoVerdePluginDeactivate', 'deactivate' ) );
// 	register_deactivation_hook( __FILE__, array( 'Deactivate', 'deactivate' ) );

// }