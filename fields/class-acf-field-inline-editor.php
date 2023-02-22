<?php

if( ! class_exists('acf_field_inline_editor') ) :

    class acf_field_inline_editor extends acf_field_text {


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
            $this->name = 'inline_editor';
            $this->label = __("Inline editor",'acf');
            $this->defaults = array(
                'default_value'	=> ''
            );
        }

        function strip_word_html($text, $allowed_tags = '<a><ul><li><b><i><sup><sub><em><strong><u><br><br/><br /><p><h2><h3><h4><h5><h6>')
        {
            if( !extension_loaded('mbstring') )
                return strip_tags($text, $allowed_tags);

            mb_regex_encoding('UTF-8');

            $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u');
            $replace = array('\'', '\'', '"', '"', '-');
            $text = preg_replace($search, $replace, $text);

            if(mb_stripos($text, '/*') !== FALSE)
                $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');

            $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
            $text = strip_tags($text, $allowed_tags);

            $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);

            $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
            $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
            $text = preg_replace($search, $replace, $text);

            $num_matches = preg_match_all("/\<!--/u", $text, $matches);

            if($num_matches)
                $text = preg_replace('/\<!--(.)*--\>/isu', '', $text);

            return preg_replace('/(<[^>]+) style=".*?"/i', '$1', $text);
        }

        /**
         * @param $value
         * @param $post_id
         * @param $field
         * @return string
         */
        function update_value($value, $post_id=0, $field=array()){

            return $this->strip_word_html($value, '<b><i><strong><sup><sub><a><u><strike><br>');
        }

        public function input_admin_enqueue_scripts()
        {
            $dir = plugin_dir_url(__DIR__);

            wp_enqueue_script(
                'acf-inline-editor-component_field',
                "{$dir}js/inline.js",
                array('acf-input'),
                ACF_EXTENSIONS_VERSION
            );
        }


        function render_field( $field ) {
            $html = '';

            // Prepend text.
            if ( $field['prepend'] !== '' ) {
                $field['class'] .= ' acf-is-prepended';
                $html           .= '<div class="acf-input-prepend">' . acf_esc_html( $field['prepend'] ) . '</div>';
            }

            // Append text.
            if ( $field['append'] !== '' ) {
                $field['class'] .= ' acf-is-appended';
                $html           .= '<div class="acf-input-append">' . acf_esc_html( $field['append'] ) . '</div>';
            }

            // Input.
            $input_attrs = array();
            foreach ( array( 'type', 'id', 'class', 'name', 'value', 'placeholder', 'maxlength', 'pattern', 'readonly', 'disabled', 'required' ) as $k ) {
                if ( isset( $field[ $k ] ) ) {
                    $input_attrs[ $k ] = $field[ $k ];
                }
            }

            $input_attrs['type'] = 'hidden';
            $input_attrs['class'] .= 'acf-input-hidden-'.$field['key'];
            $input_attrs['data-toolbar'] = implode(',', $field['toolbar']);

            $html .= '<div class="acf-input-wrap"><div class="acf-input-inline-editor" id="'.$field['id'].'-inline-editor" style="min-height:'.((intval($field['rows']??1))*30).'px">'.$field['value'].'</div>' . acf_get_text_input( acf_filter_attrs( $input_attrs ) ) . '</div>';

            // Display.
            echo $html;
        }


        /*
		*  render_field_settings()
		*
		*  Create extra options for your field. This is rendered when editing a field.
		*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
		*
		*  @type	action
		*  @since	3.6
		*  @date	23/01/13
		*
		*  @param	$field	- an array holding all the field's data
		*/

        function render_field_settings( $field ) {

            // default_value
            acf_render_field_setting( $field, array(
                'label'			=> __('Toolbar','acf'),
                'instructions'	=> __('Specify what buttons you want to include on the inline toolbar','acf'),
                'type'			=> 'select',
                'multiple'     => 1,
                'ui'           => 1,
                'choices'      => [
                    'bold'=>'bold',
                    'italic'=>'italic',
                    'underline'=>'underline',
                    'subscript'=>'subscript',
                    'superscript'=>'superscript',
                    'strikeThrough'=>'strikeThrough',
                    /*'align'=>'align',
                    'unorderedList'=>'unorderedList',
                    'orderedList'=>'orderedList',
                    'color'=>'color',*/
                    'nonBreakingSpace'=>'nonBreakingSpace',
                    'link'=>'link'
                ],
                'name'			=> 'toolbar',
            ));

            // default_value
            /*acf_render_field_setting( $field, array(
				'label'			=> __('Colors','acf'),
				'instructions'	=> __('Specify what colors you want to include on the color picker','acf'),
				'type'			=> 'text',
                'name'			=> 'colors'
            ));*/

            // default_value
            acf_render_field_setting( $field, array(
                'label'			=> __('Rows','acf'),
                'type'			=> 'number',
                'name'			=> 'rows',
                'placeholder'   => 1
            ));

        }
    }

    acf_register_field_type( 'acf_field_inline_editor' );

endif; // class_exists check
