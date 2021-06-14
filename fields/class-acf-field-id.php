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
				'default_value'	=> uniqid()
			);
		}
	}

	acf_register_field_type( 'acf_field_id' );

endif; // class_exists check
