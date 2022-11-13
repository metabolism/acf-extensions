<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ACF_Location_Term_Type' ) ) :

	class ACF_Location_Term_Type extends ACF_Location {

		/**
		 * Initializes props.
		 *
		 * @date    5/03/2014
		 * @since   5.0.0
		 *
		 * @param   void
		 * @return  void
		 */
		public function initialize() {
			$this->name           = 'term_type';
			$this->label          = __( 'Term Type', 'acf' );
			$this->category       = 'post';
			$this->object_type    = 'term';
			$this->object_subtype = 'term';
		}

		/**
		 * Matches the provided rule against the screen args returning a bool result.
		 *
		 * @date    9/4/20
		 * @since   5.9.0
		 *
		 * @param   array $rule The location rule.
		 * @param   array $screen The screen args.
		 * @param   array $field_group The field group settings.
		 * @return  bool
		 */
		public function match( $rule, $screen, $field_group ) {

            // Check screen args.
			if ( isset( $screen['taxonomy'], $_GET['tag_ID'] ) )
				$term_id = $_GET['tag_ID'];
			else
				return false;

			// Get term.
			$term = get_term( $term_id, $_GET['taxonomy'] );

            if ( ! $term )
				return false;

            $term_parent = $term->parent;

			// Compare.
			switch ( $rule['value'] ) {

				case 'top_level':
					$result      = ( $term_parent === 0 );
					break;

				case 'parent':
					$children = get_term_children($term_id, $_GET['taxonomy']);
					$result   = ! empty( $children );
					break;

				case 'child':
					$result      = ( $term_parent !== 0 );
					break;

				default:
					return false;
			}

			// Reverse result for "!=" operator.
			if ( $rule['operator'] === '!=' )
				return ! $result;

			return $result;
		}

		/**
		 * Returns an array of possible values for this rule type.
		 *
		 * @date    9/4/20
		 * @since   5.9.0
		 *
		 * @param   array $rule A location rule.
		 * @return  array
		 */
		public function get_values( $rule ) {
			return array(
				'top_level'  => __( 'Top Level Term (no parent)', 'acf' ),
				'parent'     => __( 'Parent Term (has children)', 'acf' ),
				'child'      => __( 'Child Term (has parent)', 'acf' ),
			);
		}
	}

	// initialize
	acf_register_location_type( 'ACF_Location_Term_Type' );

endif; // class_exists check
