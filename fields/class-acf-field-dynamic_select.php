<?php

if( ! class_exists('acf_field_dynamic_select_extension') ) :

	class acf_field_dynamic_select_extension extends acf_field_select {

		function render_field( $field ) {

			// convert
			$value = acf_get_array($field['value']);

			$field_key = explode('.', $field['field_key']);
            $other_field_values = [];

			if( $field_key[0] == 'options'){

				$other_field_values = get_field($field_key[1], 'options');
				array_shift($field_key);
			}
			else{

                if( $post_id = $_GET['post']??false ){

                    $other_field_values = get_field($field_key[0], $post_id);

                    if( is_null($other_field_values) )
                        $other_field_values = get_post_meta($post_id,  $field_key[0]);
                }
                elseif( $term_id = $_GET['tag_ID']??false ){

                    $other_field_values = get_field($field_key[0], 'term_'.$term_id);

                    if( is_null($other_field_values) )
                        $other_field_values = get_term_meta($term_id,  $field_key[0]);
                }
			}

			$choices = $other_field_values;

			if( count($field_key) == 2 ){

				foreach ($other_field_values as $other_field_value){

					$choice = $other_field_value[$field_key[1]]??'';

					if( strlen($choice) ){

						$choice = $other_field_value[$field_key[1]];
						$choices[sanitize_title($choice)] = $choice;
					}
				}
			}

			// placeholder
			if( empty($field['placeholder']) ) {
				$field['placeholder'] = _x('Select', 'verb', 'acf');
			}


			// add empty value (allows '' to be selected)
			if( empty($value) ) {
				$value = array('');
			}


			// prepend empty choice
			// - only for single selects
			// - have tried array_merge but this causes keys to re-index if is numeric (post ID's)
			if( $field['allow_null'] && !$field['multiple'] ) {
				$choices = array( '' => "- {$field['placeholder']} -" ) + $choices;
			}


			// vars
			$select = array(
				'id'				=> $field['id'],
				'class'				=> $field['class'],
				'name'				=> $field['name'],
				'data-ui'			=> $field['ui'],
				'data-ajax'			=> $field['ajax'],
				'data-multiple'		=> $field['multiple'],
				'data-placeholder'	=> $field['placeholder'],
				'data-allow_null'	=> $field['allow_null']
			);


			// multiple
			if( $field['multiple'] ) {

				$select['multiple'] = 'multiple';
				$select['size'] = 5;
				$select['name'] .= '[]';

				// Reduce size to single line if UI.
				if( $field['ui'] ) {
					$select['size'] = 1;
				}
			}


			// special atts
			if( !empty($field['readonly']) ) $select['readonly'] = 'readonly';
			if( !empty($field['disabled']) ) $select['disabled'] = 'disabled';
			if( !empty($field['ajax_action']) ) $select['data-ajax_action'] = $field['ajax_action'];


			// hidden input is needed to allow validation to see <select> element with no selected value
			if( $field['multiple'] || $field['ui'] ) {
				acf_hidden_input(array(
					'id'	=> $field['id'] . '-input',
					'name'	=> $field['name']
				));
			}


			// append
			$select['value'] = $value;
			$select['choices'] = $choices;


			// render
			acf_select_input( $select );

		}

		/*
		*  initialize
		*
		*  This function will setup the field type data
		*
		*  @type	function
		*  @date	10/01/2019
		*  @since	5.0.0
		*
		*  @param	n/a
		*  @return	n/a
		*/

		function initialize() {

			// vars
			$this->name = 'dynamic_select';
			$this->label = __("Dynamic select",'acf');
			$this->category = 'choice';

			$this->defaults = array(
				'multiple' 		=> 0,
				'allow_null' 	=> 0,
				'choices'		=> array(),
				'default_value'	=> '',
				'ui'			=> 0,
				'ajax'			=> 0,
				'placeholder'	=> '',
				'return_format'	=> 'value'
			);
		}


		/*
		*  render_field_settings()
		*
		*  Create extra options for your field. This is rendered when editing a field.
		*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
		*
		*  @type	action
		*  @since	3.6
		*  @date	23/01/13
		*
		*  @param	$field	- an array holding all the field's data
		*/

		function render_field_settings( $field ) {

			// allow_null
			acf_render_field_setting( $field, array(
				'label'			=> __('Allow Null?','acf'),
				'instructions'	=> '',
				'name'			=> 'allow_null',
				'type'			=> 'true_false',
				'ui'			=> 1,
			));

			// multiple
			acf_render_field_setting( $field, array(
				'label'			=> __('Select multiple values?','acf'),
				'instructions'	=> '',
				'name'			=> 'multiple',
				'type'			=> 'true_false',
				'ui'			=> 1,
			));


			// ui
			acf_render_field_setting( $field, array(
				'label'			=> __('Stylised UI','acf'),
				'instructions'	=> '',
				'name'			=> 'ui',
				'type'			=> 'true_false',
				'ui'			=> 1,
			));


			// return_format
			acf_render_field_setting( $field, array(
				'label'			=> __('Return Format','acf'),
				'instructions'	=> __('Specify the value returned','acf'),
				'type'			=> 'select',
				'name'			=> 'return_format',
				'choices'		=> array(
					'value'			=> __('Value','acf'),
					'label'			=> __('Label','acf'),
					'array'			=> __('Both (Array)','acf')
				)
			));


			// max
			acf_render_field_setting( $field, array(
				'label'			=> __('Field key','acf'),
				'instructions'	=> __('Specify field key using dot notation, max 2 levels, options supported','acf'),
				'type'			=> 'text',
				'placeholder'   => 'repeater.title or options.repeater.title',
				'name'			=> 'field_key',
			));

		}
	}

	acf_register_field_type( 'acf_field_dynamic_select_extension' );

endif; // class_exists check
