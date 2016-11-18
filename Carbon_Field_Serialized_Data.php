<?php

namespace Carbon_Fields\Field;

class Serialized_Data_Field extends Field {
	public $field_html;

	function set_html($callback_or_html) {
		if ( is_callable($callback_or_html) ) {
			$this->field_html = call_user_func($callback_or_html);
		} else {
			$this->field_html = $callback_or_html;
		}

		return $this;
	}

	function to_json($load) {
		$field_data = parent::to_json($load);

		$field_data = array_merge($field_data, array(
			'html' => $this->field_html,
		));

		return $field_data;
	}

	function template() {
		echo apply_filters( 'crb_serialized_data_field_output', '{{ value }}', $this->name );
	}

	/**
	 * admin_enqueue_scripts()
	 *
	 * This method is called in the admin_enqueue_scripts action. It is called once per field type.
	 * Use this method to enqueue CSS + JavaScript files.
	 *
	 */
	static function admin_enqueue_scripts() {
		$template_dir = get_template_directory_uri();

		// Get the current url for the carbon-fields-number, regardless of the location
		$template_dir .= str_replace( wp_normalize_path( get_template_directory() ), '', wp_normalize_path(__DIR__) );

		# Enqueue JS
		// crb_enqueue_script( 'carbon-field-serialized-data', $template_dir . '/includes/carbon-field-serialized-data/js/field.js', array( 'carbon-fields' ) );

		# Enqueue CSS
		// crb_enqueue_style( 'carbon-field-serialized-data', $template_dir . '/includes/carbon-field-serialized-data/css/field.css' );
	}

	function is_required() {
		return false;
	}

	function get_label() {
		return '';
	}

	function load() {
		$this->store->load( $this );
		$value = $this->get_value();

		if ( !empty( $value ) ) {
			$this->set_value( maybe_unserialize( $value ) );
		}
	}

	function save() {
		// skip;
	}

	function delete() {
		// skip;
	}
}