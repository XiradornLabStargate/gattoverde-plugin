<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class TestimonialControllorer extends BaseController
{
	public $subpages = array();
	public $callbacks;

	public function register()
	{
		// check if is active inside dashboard
		$option = get_option( 'gattoverde_plugin' );
		$active = isset( $option['testimonial_manager'] ) ? $option['testimonial_manager'] : false;
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
				'page_title' 	=> 'Testimonial Manager', 
				'menu_title' 	=> 'Testimonial Manager', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_testimonial', 
				// 'callback' 		=> array( $this->callbacks, 'adminTaxonomies' ),
			),
		);
	}
}