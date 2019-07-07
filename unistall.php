<?php
/**
 * @package GattoVerdePlugin
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die( 'Nope' );
}

// Clear Database stored data
// $books = get_posts( array( 'post_type' => 'book', 'numberposts' => -1 ) );

// foreach ( $books as $book ) {
// 	wp_delete_post( $book->ID, true );
// }
// 

// Access DB via SQL
global $wpdb;

$wpdq->query( "DELETE FROM wp_posts WHERE post_type = 'book'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationship WHERE object_id NOT IN (SELECT id FROM wp_posts)" );