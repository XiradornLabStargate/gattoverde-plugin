<?php
/**
 * @package GattoVerdePlugin
 */

namespace Inc;

final class Init
{
	/**
	 * Store all classes inside an array
	 * @return array List of classes
	 */
	public static function get_services() {
		return [
			Base\Enqueue::class;
			Pages\Admin::class;
		];
	}
	
	/**
	 * Loop through classes and instanciate theme.
	 * Call also register() method if exist
	 * @return 
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instanciate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  class $class 	class from get services
	 * @return class instance 	new instance of the class
	 */
	private static function instanciate( $class ) {
		$service = new $class();

		return $service;
	}
}
