<?php

if( ! class_exists('acf_field_children') ) :

	class acf_field_children extends acf_field {


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
			$this->name = 'children';
			$this->label = __("Page children",'acf');
            $this->category = 'relational';
        }


		function render_field( $field ) {

			$input_attrs = array();
			foreach ( array( 'type', 'id', 'class', 'name', 'value', 'placeholder', 'maxlength', 'pattern', 'readonly', 'disabled', 'required' ) as $k ) {
				if ( isset( $field[ $k ] ) ) {
					$input_attrs[ $k ] = $field[ $k ];
				}
			}

			$input_attrs['value'] = '[post_chidren]';
			$html = '<div class="acf-input-wrap">' . acf_get_text_input( acf_filter_attrs( $input_attrs ) ) . '</div>';

			// Display.
			echo $html;
		}

		function format_value( $value, $post_id, $field ) {

			$post_id = get_the_ID();
            $type = get_post_type($post_id);
            $query = new \WP_Query(['post_parent'=>$post_id, 'post_type'=>$type, 'posts_per_page'=>-1, 'order'=>'ASC', 'orderby'=>'menu_order']);

			if( !isset($query->posts) || !is_array($query->posts) )
				return [];

			return $query->posts;
		}
	}

	acf_register_field_type( 'acf_field_children' );

endif; // class_exists check
