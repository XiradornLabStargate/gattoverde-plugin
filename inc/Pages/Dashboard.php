<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Pages;

// order by lenght of string name PSR-2
use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{
	public $settings;

	public $callbacks;
	public $callbacks_mngr;

	public $pages = array();

	// public $subpages = array();

	// used for registering the services inside a special class
	public function register() 
	{

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();

		$this->setPages();

		// $this->setSubPages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		// $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
	}

	public function setPages()
	{
		$this->pages = array(
			array(
				'page_title' 	=> 'GattoVerde Plugin', 
				'menu_title' 	=> 'GattoVerde', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_plugin', 
				// 'callback' 		=> function() { return require_once ("$this->plugin_path/templates/admin.php" ); }, 
				'callback' 		=> array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' 		=> 'dashicons-store', 
				'position' 		=> 110
			)
		);
	}

	// public function setSubPages()
	// {

	// 	$this->subpages = array(
	// 		array(
	// 			'parent_slug' 	=> 'gattoverde_plugin', 
	// 			'page_title' 	=> 'Custom Post Type', 
	// 			'menu_title' 	=> 'CPT', 
	// 			'capability' 	=> 'manage_options', 
	// 			'menu_slug' 	=> 'gattoverde_cpt', 
	// 			'callback' 		=> array( $this->callbacks, 'adminCpt' ),
	// 		),
	// 		array(
	// 			'parent_slug' 	=> 'gattoverde_plugin', 
	// 			'page_title' 	=> 'GattoVerde Taxonomies', 
	// 			'menu_title' 	=> 'Taxonomies', 
	// 			'capability' 	=> 'manage_options', 
	// 			'menu_slug' 	=> 'gattoverde_taxonomies', 
	// 			'callback' 		=> array( $this->callbacks, 'adminTaxonomies' ),
	// 		),
	// 		array(
	// 			'parent_slug' 	=> 'gattoverde_plugin', 
	// 			'page_title' 	=> 'GattoVerde Widgets', 
	// 			'menu_title' 	=> 'Widgets', 
	// 			'capability' 	=> 'manage_options', 
	// 			'menu_slug' 	=> 'gattoverde_widgets', 
	// 			'callback' 		=> array( $this->callbacks, 'adminWidgets' ),
	// 		),
	// 	);
	// }

	// now set the fields, sections and fields for the specific page form
	public function setSettings()
	{
		$args = array(
			array(
				'option_group' 	=> 'gattoverde_plugin_settings',
				'option_name' 	=> 'gattoverde_plugin',
				'callback' 		=> array( $this->callbacks_mngr, 'checkboxSanitize' ),
			)
		);
		

		$this->settings->addSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' 		=> 'gattoverde_admin_index',
				'title' 	=> 'Settings Manager',
				'callback' 	=> array( $this->callbacks_mngr, 'gattoverdeSectionManager' ),
				'page'		=> 'gattoverde_plugin'
			),
		);

		$this->settings->addSections( $args );
	}

	public function setFields()
	{
		foreach ( $this->managers as $manager => $manager_title ) {
			$args[] = array(
				'id' 		=> $manager, // same of option_group name
				'title' 	=> $manager_title,
				'callback' 	=> array( $this->callbacks_mngr, 'checkboxField' ),
				'page'		=> 'gattoverde_plugin', //linked to the page
				'section'	=> 'gattoverde_admin_index', //linked to section id
				'args'		=> array(
					'option_name' 	=> 'gattoverde_plugin', // linked to the page
					'label_for' 	=> $manager,
					'class' 		=> 'ui-toggle'
				)
			);
		}

		$this->settings->addFields( $args );
	}

}