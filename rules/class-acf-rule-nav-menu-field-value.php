<?php

if ( ! class_exists( 'ACF_Location_Nav_Menu_Field_Value' ) ) :

	class ACF_Location_Nav_Menu_Field_Value extends ACF_Location {

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
			$this->name        = 'nav_menu_field_value';
			$this->label       = __( 'Menu Field Value', 'acf' );
			$this->category    = 'forms';
			$this->object_type = 'menu';
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

            $object_id = false;

            $value = explode(':', $rule['value']);

            $target_field = $value[0];
            $expected_value = $value[1];

            if( $nav_menu_item_id = $screen['nav_menu_item_id'] ?? 0 ){

                $menu_terms = wp_get_object_terms($nav_menu_item_id, 'nav_menu');
                if (!is_wp_error($menu_terms) && !empty($menu_terms)) {

                    $nav_menu_id = $menu_terms[0]->term_id;
                    $object_id = 'menu_'.$nav_menu_id;
                }
            }
            elseif( $nav_menu_id = $screen['nav_menu'] ?? 0 ){

                $object_id = 'menu_'.$nav_menu_id;
            }

            if (!$object_id) return false;

            $actual_value = get_field($target_field, $object_id);

            if ($rule['operator'] === '==') {
                return $actual_value == $expected_value;
            } elseif ($rule['operator'] === '!=') {
                return $actual_value != $expected_value;
            }

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

            $groups = acf_get_field_groups();

            foreach($groups as $group){

                $contains_menu_field = false;

                foreach ($group['location'] as $rules){

                    foreach ($rules as $rule){

                        if( $rule['param'] == 'nav_menu' ){

                            $contains_menu_field = true;
                            break 2;
                        }
                    }
                }

                if( !$contains_menu_field )
                    continue;

                $fields = acf_get_fields($group);

                foreach ( $fields as $field) {

                    if( $field['choices']??false ){

                        foreach ( $field['choices']??[] as $key=>$value) {

                            $choices[$field['name'].':'.$key] = $field['label'].' : '.$value;
                        }
                    }
                }
            }

            ksort($choices);

            return $choices;
		}
	}

	// initialize
	acf_register_location_type( 'ACF_Location_Nav_Menu_Field_Value' );

endif; // class_exists check
