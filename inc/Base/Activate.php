<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Base;

class Activate
{
	public static function activate() 
	{
		flush_rewrite_rules();

		// prevent false override
		if ( get_option( 'gattoverde_plugin' ) ) {
			return;
		}

		// default array for zero stuff on first activation
		$default_ary = array();
		update_option( 'gattoverde_plugin', $default_ary );
	}
}