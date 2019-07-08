<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{

	public function register() 
	{
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	function enqueue() 
	{
		// enqueue all scripts
		wp_enqueue_style( 'gattoverdestyle', $this->plugin_url . 'assets/mystyles.css' );
		wp_enqueue_script( 'gattoverdescript', $this->plugin_url . 'assets/myscripts.js' );
	}

}