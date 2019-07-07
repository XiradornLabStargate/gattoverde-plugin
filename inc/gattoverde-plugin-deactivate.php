<?php
/**
 * @package GattoVerdePlugin
 */

class GattoVerdePluginDeactivate
{
	public static function deactivate() {
		flush_rewrite_rules();
	}
}