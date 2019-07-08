<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Pages;

// the initial \ meaning look inside the root plugin
use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController
{
	public $settings;

	public $pages = array();
	
	public function __construct() {
		$this->settings = new SettingsApi();

		// add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
		$this->pages = array(
			array(
				'page_title' 	=> 'GattoVerde Plugin', 
				'menu_title' 	=> 'GattoVerde', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_plugin', 
				'callback' 		=> function() { echo "<h1>GattoVerde Plugin</h1>"; }, 
				'icon_url' 		=> 'dashicons-store', 
				'position' 		=> 110
			),
			array(
				'page_title' 	=> 'GattoVerde Plugin 1', 
				'menu_title' 	=> 'GattoVerde1', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_plugin_1', 
				'callback' 		=> function() { echo "<h1>GattoVerde Plugin 1</h1>"; }, 
				'icon_url' 		=> 'dashicons-external', 
				'position' 		=> 10
			)
		);
	}

	// used for registering the services inside a special class
	public function register() 
	{
		// add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
		
		// i can add pages into the constructor
		// $pages = [
		// 	[
		// 		'page_title' 	=> 'GattoVerde Plugin', 
		// 		'menu_title' 	=> 'GattoVerde', 
		// 		'capability' 	=> 'manage_options', 
		// 		'menu_slug' 	=> 'gattoverde_plugin', 
		// 		'callback' 		=> function() { echo "<h1>GattoVerde Plugin</h1>"; }, 
		// 		'icon_url' 		=> 'dashicons-store', 
		// 		'position' 		=> 110
		// 	],
		// 	[
		// 		'page_title' 	=> 'GattoVerde Plugin 1', 
		// 		'menu_title' 	=> 'GattoVerde', 
		// 		'capability' 	=> 'manage_options', 
		// 		'menu_slug' 	=> 'gattoverde_plugin_1', 
		// 		'callback' 		=> function() { echo "<h1>GattoVerde Plugin 1</h1>"; }, 
		// 		'icon_url' 		=> 'dashicons-extrenal', 
		// 		'position' 		=> 11
		// 	]
		// ];

		// $this->settings->addPages( $pages )->register();
		$this->settings->addPages( $this->pages )->register();
	}

	// public function add_admin_pages() 
	// {
	// 	add_menu_page( 'GattoVerde Plugin', 'GattoVerde', 'manage_options', 'gattoverde_plugin', array($this, 'admin_index'), 'dashicons-store', 110 );
	// }

	// public function admin_index() 
	// {
	// 	// require template
	// 	require_once $this->plugin_path . 'templates/admin.php';
	// }

}