<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Pages;

// order by lenght of string name PSR-2
use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $pages = array();

	public $subpages = array();

	// used for registering the services inside a special class
	public function register() 
	{

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubPages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
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

	public function setSubPages()
	{

		$this->subpages = array(
			array(
				'parent_slug' 	=> 'gattoverde_plugin', 
				'page_title' 	=> 'Custom Post Type', 
				'menu_title' 	=> 'CPT', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_cpt', 
				'callback' 		=> array( $this->callbacks, 'adminCpt' ),
			),
			array(
				'parent_slug' 	=> 'gattoverde_plugin', 
				'page_title' 	=> 'GattoVerde Taxonomies', 
				'menu_title' 	=> 'Taxonomies', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_taxonomies', 
				'callback' 		=> array( $this->callbacks, 'adminTaxonomies' ),
			),
			array(
				'parent_slug' 	=> 'gattoverde_plugin', 
				'page_title' 	=> 'GattoVerde Widgets', 
				'menu_title' 	=> 'Widgets', 
				'capability' 	=> 'manage_options', 
				'menu_slug' 	=> 'gattoverde_widgets', 
				'callback' 		=> array( $this->callbacks, 'adminWidgets' ),
			),
		);
	}

	// now set the fields, sections and fields for the specific page form
	public function setSettings()
	{
		$args = array(
			array(
				'option_group' 	=> 'gattoverde_options_group',
				'option_name' 	=> 'example',
				'callback' 		=> array( $this->callbacks, 'gattoverdeOptionsGroup' ),
			),
			array(
				'option_group' 	=> 'gattoverde_options_group',
				'option_name' 	=> 'first_name',
			),
		);

		$this->settings->addSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' 		=> 'gattoverde_admin_index',
				'title' 	=> 'Settings',
				'callback' 	=> array( $this->callbacks, 'gattoverdeAdminSection' ),
				'page'		=> 'gattoverde_plugin'
			),
		);

		$this->settings->addSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' 		=> 'example', // same of option_group name
				'title' 	=> 'Example',
				'callback' 	=> array( $this->callbacks, 'gattoverdeExample' ),
				'page'		=> 'gattoverde_plugin', //linked to the page
				'section'	=> 'gattoverde_admin_index', //linked to section id
				'args'		=> array(
					'label_for' 	=> 'example',
					'class' 		=> 'example-class'
				),
			),
			array(
				'id' 		=> 'first_name', // same of option_group name
				'title' 	=> 'First Name',
				'callback' 	=> array( $this->callbacks, 'gattoverdeFirstName' ),
				'page'		=> 'gattoverde_plugin', //linked to the page
				'section'	=> 'gattoverde_admin_index', //linked to section id
				'args'		=> array(
					'label_for' 	=> 'first_name',
					'class' 		=> 'first-name-class'
				),
			),
		);

		$this->settings->addFields( $args );
	}

}