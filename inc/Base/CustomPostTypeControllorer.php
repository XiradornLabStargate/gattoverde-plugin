<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class CustomPostTypeControllorer extends BaseController
{
	public $subpages = array();
	public $callbacks;

	public function register()
	{
		// check if is active inside dashboard
		$option = get_option( 'gattoverde_plugin' );
		$active = isset( $option['cpt_manager'] ) ? $option['cpt_manager'] : false;
		if ( !$active ) return;

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();

		$this->setSubPages();

		$this->settings->addSubPages( $this->subpages )->register();

		add_action( 'init', array( $this, 'activate' ) );
	}

	public function setSubPages()
	{

		$this->subpages = array(
			array(
				'parent_slug' 	=> 'gattoverde_plugin', 
				'page_title' 	=> 'Custom Post Type', 
				'menu_title' 	=> 'CPT Manager', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_cpt', 
				'callback' 		=> array( $this->callbacks, 'adminCpt' ),
			),
		);
	}

	public function activate()
	{
		$args = array(
			'labels' 		=> array(
				'name'				=> 'Broccoletti',
				'singular_name'		=> 'broccoletti',
			),
			'public' 		=> true,
			'has_archive' 	=> true,
		);
		
		register_post_type( 'slug', $args );
		
	}
}