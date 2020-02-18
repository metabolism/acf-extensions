<?php

if( ! class_exists('acf_export') ) :

	/**
	 * ACF Export
	 *
	 * Convert id to url on export
	 *
	 * @since       1.0.0
	 * @version     1.0.14
	 * @class       acf_export
	 */
	class acf_export
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
			add_filter( 'export_wp_options', [$this, 'filterOptions'] );
			add_filter( 'postmeta_export',  [$this, 'filterPostMeta']);
		}


		/**
		 * Add attachment protocol when needed
		 * @param $field
		 * @param $value
		 * @return string
		 */
		private function processAttachment($field, $value){

			if( $field  && $value ){

				if ($field['type'] == 'post_object'){

					if( $post = get_post($value) ){

						$value = 'post://'.$post->post_name.'@'.$post->post_type;
					}
				}
				if ($field['type'] == 'taxonomy'){

					if( $term = get_term($value) ){

						$value = 'term://'.$term->name.'@'.$term->taxonomy;
					}
				}
				if ($field['type'] == 'relationship'){

					foreach ((array)$value as &$item){

						if( $post = get_post($item) ){

							$item = 'post://'.$post->post_name.'@'.$post->post_type;
						}
					}
				}
				elseif ($field['type'] == 'image' || $field['type'] == 'file'){

					if( $url = wp_get_attachment_url($value) ){

						$value = 'attachment://'.ltrim(str_replace(WP_HOME, '', $url), '/');
					}
				}
				elseif ($field['type'] == 'gallery'){

					$value = maybe_unserialize($value);

					if( is_array($value)){
						foreach ($value as &$id){

							if( $url = wp_get_attachment_url($id) )
								$id = 'attachment://'.ltrim(str_replace(WP_HOME, '', $url), '/');
						}

						$value = serialize($value);
					}
				}
			}

			return $value;
		}


		/**
		 * @param $options_arr
		 * @return array
		 */
		public function filterOptions($options_arr){

			if( !function_exists('acf_get_field') )
				return $options_arr;

			$options = [];

			foreach($options_arr as $option)
				$options[$option['name']] = $option['value'];

			$options_arr = [];

			foreach($options as $name=>$value){

				if( substr($name, 0, 1) !== '_' && isset($options['_'.$name]) && substr($options['_'.$name], 0, 6) == 'field_' ){

					$field = acf_get_field($options['_'.$name]);
					$value = $this->processAttachment($field, $value);
				}

				$options_arr[] = ['name'=>$name, 'value'=>$value];
			}

			return $options_arr;
		}


		/**
		 * Add attachment protocol when needed
		 * @param $postmeta_arr
		 * @return array
		 */
		public function filterPostMeta($postmeta_arr){

			if( !function_exists('acf_get_field') )
				return $postmeta_arr;

			$postmeta = [];

			foreach($postmeta_arr as $meta)
				$postmeta[$meta->meta_key] = $meta->meta_value;

			$postmeta_arr = [];

			foreach($postmeta as $key=>$value){

				if( substr($key, 0, 1) !== '_' && isset($postmeta['_'.$key]) && substr($postmeta['_'.$key], 0, 6) == 'field_' ){

					$field = acf_get_field($postmeta['_'.$key]);
					$value = $this->processAttachment($field, $value);
				}

				$postmeta_arr[] = (object)['meta_key'=>$key, 'meta_value'=>$value];
			}

			return $postmeta_arr;
		}
	}

	new acf_export();

endif;