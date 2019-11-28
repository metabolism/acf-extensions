<?php

if( ! class_exists('acf_field_public_settings') ) :

	class acf_field_public_settings {

		/**
		 * Add image size pre-renderint
		 * @return void
		 */
		public function addField($field)
		{
			acf_render_field_setting( $field, array(
				'label'			=> __('Public'),
				'instructions'	=> __('Expose field value','acf'),
				'name'			=> 'public',
				'type'			=> 'true_false',
				'ui'			=> 1,
				'default_value' => 1
			));
		}


		public function __construct()
		{
			add_action('acf/render_field_settings', [$this, 'addField']);
			add_action('acf/render_field_settings', [$this, 'addField']);
		}
	}

	new acf_field_public_settings();

endif; // class_exists check
