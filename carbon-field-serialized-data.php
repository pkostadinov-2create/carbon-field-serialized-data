<?php
/*
Plugin Name: Carbon Field: Serialized Data
Description: Extends base Carbon fields with a Serialized Data field.
Version: 1.0.0
*/

/**
 * Set text domain
 * @see https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
 */
load_plugin_textdomain( 'carbon-field-serialized-data', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );

/**
 * Hook field initialization
 */
add_action( 'after_setup_theme', 'crb_init_carbon_field_serialized_data', 15 );
function crb_init_carbon_field_serialized_data() {
	if ( class_exists( 'Carbon_Fields\\Field\\Field' ) ) {
		include_once dirname(__FILE__) . '/Carbon_Field_Serialized_Data.php';
	}
}
