<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Base;

class SettingsLinks
{
	public static function register() {
		add_filter( "plugin_action_links_" . PLUGIN, array( $this, 'settings_links' ) );
	}

	public function settings_links( $links ) {
		// add custom settings link
		$settings_link = '<a href="admin.php?page=gattoverde_plugin">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}
}