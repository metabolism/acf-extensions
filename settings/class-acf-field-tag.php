<?php

if( ! class_exists('acf_field_tag') ) :

	/**
	 * ACF Tag selector
	 *
	 *
	 * @since       1.0.0
	 * @version     1.0.14
	 * @class       acf_field_tag
	 */
	class acf_field_tag  {

		/**
		 * let user choose html tag
		 * @param $field
		 * @return void
		 */
		public function addField($field)
		{
			if( $field['type'] == 'textarea' || $field['type'] == 'text'){

				acf_render_field_setting( $field, array(
					'label'			=> __('Html tag'),
					'instructions'	=> __('Let user choose associated html tag (h1/h2/p/...)','acf'),
					'name'			=> 'tag',
					'type'			=> 'true_false',
					'ui'			=> 1,
					'default_value' => 0
				));
			}
		}

		/**
		 * let user choose html tag
		 * @param $field
		 * @return void
		 */
		public function addTagSelector($field)
		{
			if( isset($field['tag']) && $field['tag'] ){

				$tag = isset($field['selected_tag'])?$field['selected_tag']:'p';

				echo '<div class="acf-tag-selector"><select name="'.str_replace('[value]', '[tag]', $field['name']).'">'.
					  '<option value="h1" '.($tag=='h1'?'selected':'').'>H1</option>'.
					  '<option value="h2" '.($tag=='h2'?'selected':'').'>H2</option>'.
					  '<option value="h3" '.($tag=='h3'?'selected':'').'>H3</option>'.
					  '<option value="h4" '.($tag=='h4'?'selected':'').'>H4</option>'.
					  '<option value="h5" '.($tag=='h5'?'selected':'').'>H5</option>'.
					  '<option value="h6" '.($tag=='h6'?'selected':'').'>H6</option>'.
					  '<option value="p" '.($tag=='p'?'selected':'').'>P</option>'.
					'</select></div>';
			}
		}

		/**
		 * let user choose html tag
		 * @param $field
		 * @return void
		 */
		public function prepareField($field)
		{
			if( isset($field['tag']) ){

				if( $field['tag'] ){

					$field['name'] = $field['name'].'[value]';

					if( is_array($field['value']) ){

						$field['selected_tag'] = $field['value']['tag'];
						$field['value'] = $field['value']['value'];
					}
				}
				elseif( is_array($field['value']) ){

					$field['value'] = $field['value']['value'];
				}
			}

			return $field;
		}


		public function __construct()
		{
			add_action('acf/render_field_settings', [$this, 'addField']);
			add_action('acf/render_field', [$this, 'addTagSelector']);
			add_filter('acf/prepare_field', [$this, 'prepareField']);
		}
	}

	new acf_field_tag();

endif; // class_exists check
