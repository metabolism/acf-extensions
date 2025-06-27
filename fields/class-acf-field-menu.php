<?php

if( ! class_exists('acf_field_menu') ) :

    class acf_field_menu extends acf_field_select {

        function render_field( $field ) {

            $value   = acf_get_array( $field['value'] );

            $menus = wp_get_nav_menus();

            $choices = [];

            if ( ! empty( $menus ) ) {

                foreach ( $menus as $menu )
                    $choices[ $menu->term_id ] = $menu->name;
            }

            if ( empty( $field['placeholder'] ) ) {
                $field['placeholder'] = _x( 'Select', 'verb', 'acf' );
            }

            // Add empty value (allows '' to be selected).
            if ( empty( $value ) ) {
                $value = array( '' );
            }

            // prepend empty choice
            // - only for single selects
            // - have tried array_merge but this causes keys to re-index if is numeric (post ID's)
            if ( $field['allow_null'] && ! $field['multiple'] ) {
                $choices = array( '' => "- {$field['placeholder']} -" ) + $choices;
            }

            // clean up choices if using ajax
            if ( $field['ui'] && $field['ajax'] ) {
                $minimal = array();
                foreach ( $value as $key ) {
                    if ( isset( $choices[ $key ] ) ) {
                        $minimal[ $key ] = $choices[ $key ];
                    }
                }
                $choices = $minimal;
            }

            $select = array(
                'id'               => $field['id'],
                'class'            => $field['class'],
                'name'             => $field['name'],
                'data-ui'          => $field['ui'],
                'data-ajax'        => $field['ajax'],
                'data-multiple'    => $field['multiple'],
                'data-placeholder' => $field['placeholder'],
                'data-allow_null'  => $field['allow_null'],
            );

            if ( ! empty( $field['aria-label'] ) ) {
                $select['aria-label'] = $field['aria-label'];
            }

            if ( $field['multiple'] ) {
                $select['multiple'] = 'multiple';
                $select['size']     = 5;
                $select['name']    .= '[]';

                // Reduce size to single line if UI.
                if ( $field['ui'] ) {
                    $select['size'] = 1;
                }
            }

            if ( ! empty( $field['create_options'] ) && $field['ui'] ) {
                $select['data-create_options'] = true;
            }

            // special atts
            if ( ! empty( $field['readonly'] ) ) {
                $select['readonly'] = 'readonly';
            }
            if ( ! empty( $field['disabled'] ) ) {
                $select['disabled'] = 'disabled';
            }
            if ( ! empty( $field['ajax_action'] ) ) {
                $select['data-ajax_action'] = $field['ajax_action'];
            }
            if ( ! empty( $field['nonce'] ) ) {
                $select['data-nonce'] = $field['nonce'];
            }
            if ( $field['ajax'] && empty( $field['nonce'] ) && acf_is_field_key( $field['key'] ) ) {
                $select['data-nonce'] = wp_create_nonce( 'acf_field_' . $this->name . '_' . $field['key'] );
            }
            if ( ! empty( $field['hide_search'] ) ) {
                $select['data-minimum-results-for-search'] = '-1';
            }

            // Hidden input is needed to allow validation to see <select> element with no selected value.
            if ( $field['multiple'] || $field['ui'] ) {
                acf_hidden_input(
                    array(
                        'id'   => $field['id'] . '-input',
                        'name' => $field['name'],
                    )
                );
            }

            $select['value']   = $value;
            $select['choices'] = $choices;

            if ( ! empty( $field['create_options'] ) && $field['ui'] && is_array( $field['value'] ) ) {
                foreach ( $field['value'] as $value ) {
                    // Already exists in choices.
                    if ( isset( $field['choices'][ $value ] ) ) {
                        continue;
                    }

                    $option = esc_attr( $value );

                    $select['choices'][ $option ] = $option;
                }
            }

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
            $this->name = 'menu';
            $this->label = __("Menu",'acf');
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


            // multiple
            acf_render_field_setting( $field, array(
                'label'			=> __('Select multiple values?','acf'),
                'instructions'	=> '',
                'name'			=> 'multiple',
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

        }
    }

    acf_register_field_type( 'acf_field_menu' );

endif; // class_exists check
