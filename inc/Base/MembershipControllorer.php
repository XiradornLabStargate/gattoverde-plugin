<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class MembershipControllorer extends BaseController
{
	public $subpages = array();
	public $callbacks;

	public function register()
	{
		// check if is active inside dashboard
		$option = get_option( 'gattoverde_plugin' );
		$active = isset( $option['membership_manager'] ) ? $option['membership_manager'] : false;
		if ( !$active ) return;

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();

		$this->setSubPages();

		$this->settings->addSubPages( $this->subpages )->register();

	}

	public function setSubPages()
	{

		$this->subpages = array(
			array(
				'parent_slug' 	=> 'gattoverde_plugin', 
				'page_title' 	=> 'Membership Manager', 
				'menu_title' 	=> 'Membership Manager', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_membership', 
				// 'callback' 		=> array( $this->callbacks, 'adminTaxonomies' ),
			),
		);
	}
}