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

	public function adminCpt()
	{
		return require_once ("$this->plugin_path/templates/cpt.php" );
	}

	public function adminTaxonomies()
	{
		return require_once ("$this->plugin_path/templates/taxonomies.php" );
	}

	public function adminWidgets()
	{
		return require_once ("$this->plugin_path/templates/widgets.php" );
	}

	//////////////
	/// for the forms
	/// 
	// public function gattoverdeOptionsGroup( $input )
	// {
	// 	return $input;
	// }

	// public function gattoverdeAdminSection()
	// {
	// 	return "Super Awesome";
	// }

	// public function gattoverdeExample()
	// {
	// 	$value = esc_attr( get_option( "example" ) );
	// 	echo "<input type=\"text\" class=\"regular-text\" name=\"example\" value=\"$value\" placeholder=\"Scrivi\" >";
	// }

	// public function gattoverdeFirstName()
	// {
	// 	$value = esc_attr( get_option( "first_name" ) );
	// 	echo "<input type=\"text\" class=\"regular-text\" name=\"first_name\" value=\"$value\" placeholder=\"Scrivi\" >";
	// }
}