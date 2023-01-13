<?php

if( ! class_exists('acf_field_inline_editor') ) :

	class acf_field_inline_editor extends acf_field_text {


		/*
		*  initialize
		*
		*  This function will setup the field type data
		*
		*  @type	function
		*  @date	01/10/2019
		*  @since	5.0.0
		*
		*  @param	n/a
		*  @return	n/a
		*/

		function initialize() {

			// vars
			$this->name = 'inline_editor';
			$this->label = __("Inline editor",'acf');
			$this->defaults = array(
				'default_value'	=> ''
			);
		}

        public function input_admin_enqueue_scripts()
        {
            $dir = plugin_dir_url(__DIR__);

            wp_enqueue_script(
                'acf-inline-editor-component_field',
                "{$dir}js/inline.js",
                array('acf-input'),
                false,
                '1.3.1'
            );
        }


        function render_field( $field ) {
            $html = '';

            // Prepend text.
            if ( $field['prepend'] !== '' ) {
                $field['class'] .= ' acf-is-prepended';
                $html           .= '<div class="acf-input-prepend">' . acf_esc_html( $field['prepend'] ) . '</div>';
            }

            // Append text.
            if ( $field['append'] !== '' ) {
                $field['class'] .= ' acf-is-appended';
                $html           .= '<div class="acf-input-append">' . acf_esc_html( $field['append'] ) . '</div>';
            }

            // Input.
            $input_attrs = array();
            foreach ( array( 'type', 'id', 'class', 'name', 'value', 'placeholder', 'maxlength', 'pattern', 'readonly', 'disabled', 'required' ) as $k ) {
                if ( isset( $field[ $k ] ) ) {
                    $input_attrs[ $k ] = $field[ $k ];
                }
            }

            $input_attrs['type'] = 'hidden';
            $input_attrs['class'] .= 'acf-input-hidden-'.$field['key'];
            $input_attrs['data-toolbar'] = implode(',', $field['toolbar']);
            $input_attrs['data-colors'] = $field['colors'];

            $html .= '<div class="acf-input-wrap"><div class="acf-input-inline-editor" id="'.$field['id'].'-inline-editor" style="min-height:'.(($field['rows']??1)*30).'px">'.$field['value'].'</div>' . acf_get_text_input( acf_filter_attrs( $input_attrs ) ) . '</div>';

            // Display.
            echo $html;
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

			// default_value
			acf_render_field_setting( $field, array(
				'label'			=> __('Toolbar','acf'),
				'instructions'	=> __('Specify what buttons you want to include on the inline toolbar','acf'),
				'type'			=> 'select',
                'multiple'     => 1,
                'ui'           => 1,
                'choices'      => [
                    'bold'=>'bold',
                    'italic'=>'italic',
                    'underline'=>'underline',
                    'subscript'=>'subscript',
                    'superscript'=>'superscript',
                    'strikeThrough'=>'strikeThrough',
                    'align'=>'align',
                    'unorderedList'=>'unorderedList',
                    'nonBreakingSpace'=>'nonBreakingSpace',
                    'orderedList'=>'orderedList',
                    'color'=>'color',
                    'link'=>'link'
                ],
				'name'			=> 'toolbar',
			));

			// default_value
			acf_render_field_setting( $field, array(
				'label'			=> __('Colors','acf'),
				'instructions'	=> __('Specify what colors you want to include on the color picker','acf'),
				'type'			=> 'text',
                'name'			=> 'colors'
			));

			// default_value
			acf_render_field_setting( $field, array(
				'label'			=> __('Rows','acf'),
				'type'			=> 'number',
                'name'			=> 'rows',
                'placeholder'   => 1
			));

		}
	}

	acf_register_field_type( 'acf_field_inline_editor' );

endif; // class_exists check
