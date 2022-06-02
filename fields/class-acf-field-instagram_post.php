<?php

if( ! class_exists('acf_field_instagram_post') ) :

	class acf_field_instagram_post extends acf_field_url {

		/**
		 * When saving get title, url and image from Instagram
		 *
		 * @param $value
		 * @param int $post_id
		 * @param array $field
		 * @return mixed
		 */
		public function updateValue($value, $post_id=0, $field=array()){

			if( $field['type'] == 'instagram_post' ){

				$current_value = acf_get_metadata( $post_id, $field['name'] );

				if( ($current_value['url']??'') == $value )
					return $current_value;

                if( !empty($value) ){

                    preg_match_all('/\/p\/(.+)\/.*/m', $value, $matches, PREG_SET_ORDER, 0);

                    if( !count($matches) || count($matches[0]) != 2)
                        return false;

                    $filepath = ABSPATH . UPLOADS.'/instagram/'.$matches[0][1].'.jpg';
                    @file_put_contents($filepath, @file_get_contents('https://www.instagram.com/p/'.$matches[0][1].'/media?size='.($field['size']??'m')));

                    if( file_exists($filepath) ){

                        $wp_upload_dir = wp_upload_dir();
                        $file_url = str_replace($wp_upload_dir['basedir'], $wp_upload_dir['baseurl'], $filepath);

                        $body['thumbnail_url'] = $file_url;
                    }

                    $value = [
                        'url'=>$value,
                        'title'=>'Instagram post',
                        'thumbnail'=>$body['thumbnail_url'],
                        'author_name'=>''
                    ];
                }
            }

			return $value;
		}

        function render_field_settings( $field ) {

            // display
            acf_render_field_setting( $field, array(
                'label'			=> __('Size','acf'),
                'type'			=> 'select',
                'name'			=> 'size',
                'choices'		=> array(
                    'm'		=> __('Small','acf'),
                    'l'		=> __('Large','acf'),
                ),
            ));
        }

		/*
		*  initialize
		*
		*  This function will setup the field type data
		*
		*  @type	function
		*  @date	01/10/2019
		*  @since	5.0.0
		*
		*  @param	n/a
		*  @return	n/a
		*/

		function initialize() {

			// vars
			$this->name = 'instagram_post';
			$this->label = __("Instagram post",'acf');
			$this->defaults = array(
				'default_value'	=> '',
				'size'	=> 'm',
				'placeholder'	=> 'https://www.instagram.com/p/xxxyyyzzz/'
			);
		}

		function render_field( $field ) {

			$thumbnail = $field['value']['thumbnail']??false;
			$field['value'] = $field['value']['url']??'';
			$field['type'] = 'url';

			echo '<div class="acf-instagram_post">';

			parent::render_field($field);

			if( $thumbnail )
				echo '<img src="'.$thumbnail.'">';

			echo '</div>';
		}

		public function __construct()
		{
			parent::__construct();

			if( defined(UPLOADS) && !is_dir(ABSPATH . UPLOADS.'/instagram') )
				mkdir(ABSPATH . UPLOADS.'/instagram', 0777, true);

			add_filter('acf/update_value', [$this, 'updateValue'], 10, 3);
		}
	}

	acf_register_field_type( 'acf_field_instagram_post' );

endif; // class_exists check
