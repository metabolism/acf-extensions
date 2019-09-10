<?php

if( !class_exists('acf_rule_term_type') && function_exists('get_taxonomy_templates') ) :

	/**
	 * ACF Rule Term template
	 *
	 * Add a rule to select a term template
	 *
	 * @since       1.0.0
	 * @version     1.0.14
	 * @class       acf_rule_tax_template
	 */
	class acf_rule_term_type
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
				add_filter('acf/location/rule_types', [$this, 'acf_location_rule_type_term_template']);
				add_filter('acf/location/rule_values/term_template',  [$this, 'acf_location_rule_values_term_templates']);
				add_filter('acf/location/rule_match/term_template', [$this, 'acf_location_rules_match_term_template'], 10, 3);
			}
		}

		function acf_location_rule_type_term_template( $choices ) {

			$choices[__('Misc')]['term_template'] = __('Term template');
			return $choices;

		}

		function acf_location_rule_values_term_templates( $choices ) {

			$choices ['all'] = __('All');

			$taxonomies = get_taxonomies();

			foreach ($taxonomies as $taxonomy){

				$templates = get_taxonomy_templates($taxonomy);

				if( !empty($templates) ){
					foreach ($templates as $key=>$label){
						$choices[$key] = $label;
					}
				}
			}

			return $choices;
		}

		function acf_location_rules_match_term_template( $match, $rule, $options ) {

			$template = $rule['value'];

			$terms_id = wp_get_object_terms( $options['post_id'], get_object_taxonomies($options['post_type']), ['fields' => 'ids'] );
			$templates = [];

			foreach ($terms_id as $term_id)
				$templates[] = get_term_meta($term_id, 'template', true);

			$templates = array_filter($templates);

			if($rule['operator'] == "==")
				$match = in_array($template, $templates);
			elseif($rule['operator'] == "!=")
				$match = !in_array($template, $templates);

			return $match;
		}
	}

	new acf_rule_term_type();

	endif;