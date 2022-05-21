<?php

if( ! class_exists('acf_field_children') ) :

	class acf_field_latest_children extends acf_field {


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


		function format_value( $value, $post_id, $field ) {

            $type = get_post_type($post_id);
            $query = new \WP_Query(['post_parent'=>$post_id, 'post_type'=>$type, 'posts_per_page'=>-1]);

			if( !isset($query->posts) || !is_array($query->posts) )
				return [];

			return $query->posts;
		}
	}

	acf_register_field_type( 'acf_field_latest_children' );

endif; // class_exists check
