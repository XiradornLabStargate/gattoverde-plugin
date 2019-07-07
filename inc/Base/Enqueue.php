<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Base;

class Enqueue
{

	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	function enqueue() {
		// enqueue all scripts
		wp_enqueue_style( 'gattoverdestyle', PLUGIN_URL . 'assets/mystyles.css' );
		wp_enqueue_script( 'gattoverdescript', PLUGIN_URL . 'assets/myscripts.js' );
	}

}