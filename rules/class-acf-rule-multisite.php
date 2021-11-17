<?php

if ( ! class_exists( 'ACF_Location_Multisite' ) ) :

	class ACF_Location_Multisite extends ACF_Location {

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
			$this->name        = 'site';
			$this->label       = __( 'Site', 'acf' );
			$this->category    = 'Misc';
			$this->object_type = 'blog';
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

			$selected_site = (int) $rule['value'];

			if( $selected_site == 'all')
				return true;

			$current_site = get_current_blog_id();

			if($rule['operator'] == "==")
				$match = ( $current_site == $selected_site );
			elseif($rule['operator'] == "!=")
				$match = ( $current_site != $selected_site );

			return $match;
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

			$choices ['all'] = __('All');
			$sites = get_sites();

			/** @var \WP_Site $site */
			foreach($sites as $site ) {
				$choices[ $site->blog_id ] = $site->blog_id.' : '.$site->blogname;
			}

			return $choices;
		}
	}

	// initialize
	acf_register_location_type( 'ACF_Location_Multisite' );

endif; // class_exists check
