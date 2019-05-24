<?php

if( ! class_exists('acf_field_better_link') ) :

	class acf_field_better_link {


		/**
		 * Whan saving link, store post_id and boolean to know if the link title is the post title
		 * @param $value
		 * @param int $post_id
		 * @param array $field
		 * @return mixed
		 */
		public function updateValue($value, $post_id=0, $field=array()){

			if( $field['type'] == 'link'){

				$value['post_id'] = url_to_postid($value['url']);

				if( $value['post_id'] ){
					$title = get_the_title($value['post_id']);
					$value['is_title'] = $title == $value['title'];
				}
				elseif( isset($value['is_title']) ){
					unset($value['is_title']);
				}
			}

			return $value;
		}

		/**
		 * On load, check if link and title still belong to the post_id, else update
		 * @param $value
		 * @param int $post_id
		 * @param array $field
		 * @return mixed
		 */
		public function loadValue($value, $post_id=0, $field=array()){

			if( $field['type'] == 'link' && isset($value['post_id']) && $value['post_id']){

				$url = get_permalink($value['post_id']);
				$update = false;

				if( isset($value['is_title']) && $value['is_title'] ) {
					$value['title'] = get_the_title($value['post_id']);
					$update = true;
				}

				if( $url != $value['url']) {
					$value['url'] = $url;
					$update = true;
				}

				if($update){
					acf_update_metadata( $post_id, $field['name'], $value );
					acf_update_metadata( $post_id, $field['name'], $field['key'], true );
					acf_flush_value_cache( $post_id, $field['name'] );
				}
			}

			return $value;
		}

		public function __construct()
		{
			add_filter('acf/update_value', [$this, 'updateValue'], 10, 3);
			add_filter('acf/load_value', [$this, 'loadValue'], 10, 3);
		}
	}

	new acf_field_better_link();

endif; // class_exists check
