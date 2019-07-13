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

class Admin extends BaseController
{
	public $settings;

	public $callbacks;
	public $callbacks_mngr;

	public $pages = array();

	public $subpages = array();

	// used for registering the services inside a special class
	public function register() 
	{

		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();

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
				'option_group' 	=> 'gattoverde_plugin_settings',
				'option_name' 	=> 'cpt_manager',
				'callback' 		=> array( $this->callbacks_mngr, 'checkboxSanitize' ),
			),
			array(
				'option_group' 	=> 'gattoverde_plugin_settings',
				'option_name' 	=> 'taxonomy_manager',
				'callback' 		=> array( $this->callbacks_mngr, 'checkboxSanitize' )
			),
			array(
				'option_group' 	=> 'gattoverde_plugin_settings',
				'option_name' 	=> 'media_widget',
				'callback' 		=> array( $this->callbacks_mngr, 'checkboxSanitize' )
			),
			array(
				'option_group' 	=> 'gattoverde_plugin_settings',
				'option_name' 	=> 'testimonial_manager',
				'callback' 		=> array( $this->callbacks_mngr, 'checkboxSanitize' )
			),
			array(
				'option_group' 	=> 'gattoverde_plugin_settings',
				'option_name' 	=> 'templates_manager',
				'callback' 		=> array( $this->callbacks_mngr, 'checkboxSanitize' )
			),
			array(
				'option_group' 	=> 'gattoverde_plugin_settings',
				'option_name' 	=> 'login_manager',
				'callback' 		=> array( $this->callbacks_mngr, 'checkboxSanitize' )
			),
			array(
				'option_group' 	=> 'gattoverde_plugin_settings',
				'option_name' 	=> 'menùmbership_manager',
				'callback' 		=> array( $this->callbacks_mngr, 'checkboxSanitize' )
			),
			array(
				'option_group' 	=> 'gattoverde_plugin_settings',
				'option_name' 	=> 'chatsystem_manager',
				'callback' 		=> array( $this->callbacks_mngr, 'checkboxSanitize' )
			),
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
		$args = array(
			array(
				'id' 		=> 'cpt_manager', // same of option_group name
				'title' 	=> 'Activate CPT Manager',
				'callback' 	=> array( $this->callbacks_mngr, 'checkboxField' ),
				'page'		=> 'gattoverde_plugin', //linked to the page
				'section'	=> 'gattoverde_admin_index', //linked to section id
				'args'		=> array(
					'label_for' 	=> 'cpt',
					'class' 		=> 'cpt-class'
				),
			),
			array(
				'id' 		=> 'taxonomy_manager', // same of option_group name
				'title' 	=> 'Taxonomy CPT Manager',
				'callback' 	=> array( $this->callbacks_mngr, 'checkboxField' ),
				'page'		=> 'gattoverde_plugin', //linked to the page
				'section'	=> 'gattoverde_admin_index', //linked to section id
				'args'		=> array(
					'label_for' 	=> 'taxonomy',
					'class' 		=> 'taxonomy-class'
				),
			),
			array(
				'id' 		=> 'gallery_manager', // same of option_group name
				'title' 	=> 'Activate Gallery Manager',
				'callback' 	=> array( $this->callbacks_mngr, 'checkboxField' ),
				'page'		=> 'gattoverde_plugin', //linked to the page
				'section'	=> 'gattoverde_admin_index', //linked to section id
				'args'		=> array(
					'label_for' 	=> 'gallery',
					'class' 		=> 'gallery-class'
				),
			),
			array(
				'id' 		=> 'testimonial_manager', // same of option_group name
				'title' 	=> 'Activate Testimonial Manager',
				'callback' 	=> array( $this->callbacks_mngr, 'checkboxField' ),
				'page'		=> 'gattoverde_plugin', //linked to the page
				'section'	=> 'gattoverde_admin_index', //linked to section id
				'args'		=> array(
					'label_for' 	=> 'testimonial',
					'class' 		=> 'testimonial-class'
				),
			),
			array(
				'id' 		=> 'templates', // same of option_group name
				'title' 	=> 'Activate Templates Manager',
				'callback' 	=> array( $this->callbacks_mngr, 'checkboxField' ),
				'page'		=> 'gattoverde_plugin', //linked to the page
				'section'	=> 'gattoverde_admin_index', //linked to section id
				'args'		=> array(
					'label_for' 	=> 'templates',
					'class' 		=> 'templates-class'
				),
			),
			array(
				'id' 		=> 'login_manager', // same of option_group name
				'title' 	=> 'Activate Login Manager',
				'callback' 	=> array( $this->callbacks_mngr, 'checkboxField' ),
				'page'		=> 'gattoverde_plugin', //linked to the page
				'section'	=> 'gattoverde_admin_index', //linked to section id
				'args'		=> array(
					'label_for' 	=> 'login',
					'class' 		=> 'login-class'
				),
			),
			array(
				'id' 		=> 'membership_manager', // same of option_group name
				'title' 	=> 'Activate Membership Manager',
				'callback' 	=> array( $this->callbacks_mngr, 'checkboxField' ),
				'page'		=> 'gattoverde_plugin', //linked to the page
				'section'	=> 'gattoverde_admin_index', //linked to section id
				'args'		=> array(
					'label_for' 	=> 'membership',
					'class' 		=> 'membership-class'
				),
			),
			array(
				'id' 		=> 'chatsystem_manager', // same of option_group name
				'title' 	=> 'Activate Membership Manager',
				'callback' 	=> array( $this->callbacks_mngr, 'checkboxField' ),
				'page'		=> 'gattoverde_plugin', //linked to the page
				'section'	=> 'gattoverde_admin_index', //linked to section id
				'args'		=> array(
					'label_for' 	=> 'chatsystem',
					'class' 		=> 'chatsystem-class'
				),
			),
		);

		$this->settings->addFields( $args );
	}

}