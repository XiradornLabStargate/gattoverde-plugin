<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Base;

class BaseController
{
	
	public $plugin_path;
	public $plugin_url;
	public $plugin;

	public $managers = array();

	public function __construct() 
	{
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/gattoverde-plugin.php';

		$this->managers = [
			'cpt_manager' 			=> 'Activate CPT Manager',
			'taxonomy_manager' 		=> 'Activate Taxonomy Manager',
			'media_widget' 			=> 'Activate Media Widget',
			'gallery_manager' 		=> 'Activate Gallery Manager',
			'testimonial_manager' 	=> 'Activate Testimonial Manager',
			'login_manager' 		=> 'Activate Ajax Login/Signup Manager',
			'membership_manager' 	=> 'Activate Memebership Manager',
			'templates_manager' 	=> 'Activate Templates Manager',
			'chatsystem_manager' 	=> 'Activate Chat System Manager'
		];
	}

}

// define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
// define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
// define( 'PLUGIN', plugin_basename( __FILE__ ) );