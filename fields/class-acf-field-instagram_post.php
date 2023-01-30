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
        public function update_value($value, $post_id=0, $field=array()){

            $current_value = acf_get_metadata( $post_id, $field['name'] );

            if( ($current_value['url']??'') == $value && !empty($current_value['thumbnail']??'') )
                return $current_value;

            if( !empty($value) ){

                preg_match_all('/\/p\/(.+)\/.*/m', $value, $matches, PREG_SET_ORDER, 0);

                if( !count($matches) || count($matches[0]) != 2)
                    return false;

                $wp_upload_dir = wp_upload_dir();

                $filepath = $wp_upload_dir['basedir'].'/instagram/'.$matches[0][1].'.jpg';
                @file_put_contents($filepath, @file_get_contents('https://www.instagram.com/p/'.$matches[0][1].'/media?size='.($field['size']??'m')));

                if( file_exists($filepath) )
                    $file_url = str_replace($wp_upload_dir['basedir'], $wp_upload_dir['baseurl'], $filepath);
                else
                    $file_url = false;

                $value = [
                    'url'=>$value,
                    'title'=>'Instagram post',
                    'thumbnail'=>$file_url,
                    'author_name'=>''
                ];
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

            $wp_upload_dir = wp_upload_dir();

            if( !is_dir($wp_upload_dir['basedir'] .'/instagram') )
                @mkdir($wp_upload_dir['basedir'].'/instagram', 0777, true);
        }
    }

    acf_register_field_type( 'acf_field_instagram_post' );

endif; // class_exists check
