<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc\Api\Callbacks;

// the initial \ meaning look inside the root plugin
use \Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
	public function checkboxSanitize( $input )
	{
		// return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
		// return ( isset( $input ) ? true : false ); // same
		// 
		$output = array();

		foreach ( $this->managers as $manager => $manager_title ) {
			$output[$manager] = isset( $input[$manager] ) ? true : false;
		} 

		return $output;
	}

	public function gattoverdeSectionManager()
	{
		echo "Settings stuff";
	}

	public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$class = $args['class'];
		$option_name =  $args['option_name'];
		$checkbox = get_option( $option_name );

		$checked = isset( $checkbox[$name] ) ? ( $checkbox[$name] ? true : false ) : false;
		
		echo '<div class="' . $class . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ( $checked ? 'checked' : '' ) . '><label for="' . $name . '"><div></div></label></div>';
	} 

}