<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Api\Callbacks;

// the initial \ meaning look inside the root plugin
use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once ("$this->plugin_path/templates/admin.php" );
	}
}