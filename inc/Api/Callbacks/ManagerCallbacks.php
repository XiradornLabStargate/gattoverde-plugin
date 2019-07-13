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
		return ( isset( $input ) ? true : false ); // same 
	}

	public function gattoverdeSectionManager()
	{
		echo "Settings stuff";
	}

	public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$class = $args['class'];
		$checked = get_option( $name ) ? 'checked' : '';
		
		echo "<input type=\"checkbox\" class=\"$classes\" name=\"$name\" value=\"1\" $checked>";
	} 

}