<?php

if ( ! class_exists( 'ACF_Location_Nav_Menu_Item_Depth' ) ) :

	class ACF_Location_Nav_Menu_Item_Depth extends ACF_Location {

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
			$this->name        = 'nav_menu_item_depth';
			$this->label       = __( 'Menu item depth', 'acf' );
			$this->category    = 'forms';
			$this->object_type = 'menu_item_depth';
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
			if ( isset( $screen['nav_menu_item_depth'] ) )
				return $this->compare_to_rule( $screen['nav_menu_item_depth'], $rule );
			else
				return false;
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

			return [0,1,2,3,4,5,6,7,8,9];
		}
	}

	// initialize
	acf_register_location_type( 'ACF_Location_Nav_Menu_Item_Depth' );

endif; // class_exists check
