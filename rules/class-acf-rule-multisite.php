<?php

if( ! class_exists('acf_rule_multisite') ) :

	/**
	 * ACF Rule Multisite
	 *
	 * Add a rule to select blog id
	 *
	 * @since       1.0.0
	 * @version     1.0.14
	 * @class       acf_rule_multisite
	 */
	class acf_rule_multisite
	{
		/**
		 * Constructor
		 *
		 * @since   1.0.0
		 * @version 1.0.14
		 * @return  void
		 */
		public function __construct()
		{
			if ( is_multisite() ) {
				add_filter('acf/location/rule_types', [$this, 'acf_location_rule_type_multisite']);
				add_filter('acf/location/rule_values/site',  [$this, 'acf_location_rule_values_multisites']);
				add_filter('acf/location/rule_match/site', [$this, 'acf_location_rules_match_site'], 10, 3);
			}
		}

		function acf_location_rule_type_multisite( $choices ) {

			$choices['Multisite']['site'] = __('Site');
			return $choices;

		}

		function acf_location_rule_values_multisites( $choices ) {

			$choices ['all'] = __('All');
			$sites = get_sites();

			/** @var \WP_Site $site */
			foreach($sites as $site ) {
				$choices[ $site->blog_id ] = $site->blogname;
			}

			return $choices;
		}

		function acf_location_rules_match_site( $match, $rule, $options ) {

			$selected_site = (int) $rule['value'];

			if( $selected_site == 'all')
				return true;

			$current_site = get_current_blog_id();

			if($rule['operator'] == "==") {
				$match = ( $current_site == $selected_site );
			}
			elseif($rule['operator'] == "!=") {
				$match = ( $current_site != $selected_site );
			}

			return $match;
		}
	}

	new acf_rule_multisite();

	endif;