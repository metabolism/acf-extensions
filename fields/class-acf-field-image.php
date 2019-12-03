<?php

if( ! class_exists('acf_field_image_extension') ) :

	class acf_field_image_extension {

        /**
         * Add image size pre-renderint
         * @return void
         */
        public function addField($field)
        {
            acf_render_field_setting( $field, array(
                'label'			=> __('Sizes'),
                'instructions'	=> __('Add pre-rendered image sizes, name : width x height : extension, extension is not required','acf'),
                'name'			=> 'sizes',
                'type'			=> 'text',
                'placeholder'	=> 'ex: large:1920x1080:webp, small:150x150:jpg, medium:800x600'
            ));
            acf_render_field_setting( $field, array(
                'label'			=> __('Scaled down'),
                'instructions'	=> __('Generate pre-rendered scaled down blurred version based on sizes parameter','acf'),
                'name'			=> 'scaled_down',
                'type'			=> 'true_false',
	            'ui'			=> 1
            ));
        }


        public function __construct()
		{
            add_action('acf/render_field_settings/type=image', [$this, 'addField']);
            add_action('acf/render_field_settings/type=gallery', [$this, 'addField']);
        }
	}

	new acf_field_image_extension();

endif; // class_exists check
