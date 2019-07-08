<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Pages;

// the initial \ meaning look inside the root plugin
use \Inc\Base\BaseController;

class Admin extends BaseController
{

	// used for registering the services inside a special class
	public function register() 
	{
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
	}

	public function add_admin_pages() 
	{
		add_menu_page( 'GattoVerde Plugin', 'GattoVerde', 'manage_options', 'gattoverde_plugin', array($this, 'admin_index'), 'dashicons-store', 110 );
	}

	public function admin_index() 
	{
		// require template
		require_once $this->plugin_path . 'templates/admin.php';
	}

}