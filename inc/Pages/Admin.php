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

	public $subpages = array();
	
	public function __construct() {
		$this->settings = new SettingsApi();

		$this->pages = array(
			array(
				'page_title' 	=> 'GattoVerde Plugin', 
				'menu_title' 	=> 'GattoVerde', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_plugin', 
				'callback' 		=> function() { echo "<h1>GattoVerde Plugin</h1>"; }, 
				'icon_url' 		=> 'dashicons-store', 
				'position' 		=> 110
			)
		);

		$this->subpages = array(
			array(
				'parent_slug' 	=> 'gattoverde_plugin', 
				'page_title' 	=> 'Custom Post Type', 
				'menu_title' 	=> 'CPT', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_cpt', 
				'callback' 		=> function() { echo "<h1>GattoVerde CPT</h1>"; },
			),
			array(
				'parent_slug' 	=> 'gattoverde_plugin', 
				'page_title' 	=> 'GattoVerde Taxonomies', 
				'menu_title' 	=> 'Taxonomies', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_taxonomies', 
				'callback' 		=> function() { echo "<h1>GattoVerde CPT</h1>"; },
			),
			array(
				'parent_slug' 	=> 'gattoverde_plugin', 
				'page_title' 	=> 'GattoVerde Widgets', 
				'menu_title' 	=> 'Widgets', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_widgets', 
				'callback' 		=> function() { echo "<h1>GattoVerde CPT</h1>"; },
			),
		);
	}

	// used for registering the services inside a special class
	public function register() 
	{
		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
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