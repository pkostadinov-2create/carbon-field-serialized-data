<?php

class Carbon_Field_Serialized_Data extends Carbon_Field_HTML {
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
		$scores_total_percent = '0';
		$scores_total_percent = apply_filters('crb_update_save_survey_page_results', $scores_total_percent, 'total');
		?>

		<div class="survey-result">
			<div class="result-title">
				<div class="purple-title">Survey result</div><!-- /.purple-title -->
				<?php
				$page_id = crb_get_id_from_template('templates/survey-results.php');
				$crb_survey_results_subtitle = carbon_get_post_meta($page_id, 'crb_survey_results_subtitle');
				if ( !empty($crb_survey_results_subtitle) ): ?>
					<div class="sub-title">
						<?php
						$crb_survey_results_subtitle = str_replace('00%', '<span class="percent">' . $scores_total_percent . '%</span>', $crb_survey_results_subtitle);
						echo apply_filters('the_title', $crb_survey_results_subtitle);
						?>
					</div><!-- /.sub-title -->
				<?php endif; ?>
			</div><!-- /.result-title -->

			<div class="result-body">
				<?php echo do_shortcode('[score-board]'); ?>
			</div><!-- /.result-body -->
		</div><!-- /.survey-result -->

		<?php
	}

	/**
	 * admin_enqueue_scripts()
	 * 
	 * This method is called in the admin_enqueue_scripts action. It is called once per field type.
	 * Use this method to enqueue CSS + JavaScript files.
	 * 
	 */
	function admin_enqueue_scripts() {
		$template_dir = get_template_directory_uri();

		# Enqueue JS
		// crb_enqueue_script('carbon-field-serialized-data', $template_dir . '/includes/carbon-field-serialized-data/js/field.js', array('carbon-fields'));

		# Enqueue CSS
		crb_enqueue_style('carbon-field-serialized-data', $template_dir . '/includes/carbon-field-serialized-data/css/field.css');
	}

	function is_required() {
		return false;
	}

	function get_label() {
		return '';
	}

	function load() {
		// skip;
	}

	function save() {
		// skip;
	}

	function delete() {
		// skip;
	}
}