<?php

if( ! class_exists('acf_field_id') ) :

	class acf_field_id extends acf_field {


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
			$this->name = 'id';
			$this->label = __("Uniqid",'acf');
			$this->defaults = array(
                'default_value'	=> ''
			);
		}

        /*
	     *  render_field()
	     *
	     *  Create the HTML interface for your field
	     *
	     *  @param	$field - an array holding all the field's data
	     *
	     *  @type	action
	     *  @since	3.6
	     *  @date	23/01/13
	     */

        function render_field( $field ) {

            $input_attrs = array();
            foreach( array( 'id', 'name', 'value', 'readonly', 'disabled' ) as $k ) {
                if( isset($field[ $k ]) )
                    $input_attrs[ $k ] = $field[ $k ];
            }

            $input_attrs['type'] = 'hidden';

            echo acf_get_text_input( acf_filter_attrs($input_attrs) );
        }

        /*
	     *  update_value()
	     *
	     *  Return uniqid on save
	     *
	     *  @param	$value - an array holding all the field's data
	     *
	     *  @type	action
	     *  @since	3.6
	     *  @date	23/01/13
	     */

        function update_value( $value ) {

            if( empty($value) )
                $value = uniqid();

            return $value;
        }
	}

	acf_register_field_type( 'acf_field_id' );

endif; // class_exists check
