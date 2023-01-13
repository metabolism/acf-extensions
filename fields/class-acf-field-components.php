<?php

if( ! class_exists('acf_field_components') ) :
    
    /**
     * ACF Components Field Class
     *
     * Using existing functionality of flexible content field, extends it to another
     * field type that allows embedding the entire group without recreating.
     *
     * @since       1.0.0
     * @version     1.0.14
     * @class       acf_field_components
     * @extends     acf_field_flexible_content
     */
    class acf_field_components extends acf_field_flexible_content
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
            $this->name = 'components';
            $this->label = __('Components', 'acf-components');
            $this->category = 'relational';
            $this->defaults = array(
                'fields_group_id' => array(),
                'min'			=> '',
                'max'			=> '',
                'layouts'        => array(),
                'button_label'   => __("Add Component",'acf'),
                'collapsed'      => ''
            );
            
            // create a custom status for this field, looks prettier in the table list
            add_action('init', array($this, 'register_component_post_status'));
            
            if( is_admin() )
                add_action('init', array($this, 'field_group_enqueue_style'));
            
            
            // add side metabos for component checkbox
            add_action('add_meta_boxes', array($this, 'add_component_meta_boxes'));
            
            // update the group to acf-component status on save
            add_action('acf/update_field_group', array($this, 'update_component_post_status'));
            
            // include the component groups on export screen
            add_action('pre_get_posts', array($this, 'display_component_on_export'));
            
            // filter the select dropdown to populate proper options
            add_filter("acf/prepare_field/type=select", array($this, 'filter_available_field_groups'));
            
            // include the acf-component into the list,
            // so the file syncing won't think it doesn't exists admin/field-groups.php:25
            // also need to make sure this trigger before the json local cache
            add_filter('acf/get_field_groups', array($this, 'include_component_field_groups'), 5);
            
            add_filter('acf/get_field_group', array($this, 'set_active_status'));
            
            // change the proper status when a field group is duplicated
            add_action('acf/duplicate_field_group', array($this, 'update_component_status_on_duplication'));
            
            // do not save layouts on export
            add_action('acf/prepare_field_group_for_export', array($this, 'prepare_field_group_for_export'));
            add_action('acf/update_field_group', array($this, 'update_field_group'));
            
            // append 'acf-component' status to all wp_query that queries 'acf-field-group'
            add_action('pre_get_posts', array($this, 'include_component_post_status'));
            add_action('acf/render_field', array($this, 'render_field'));
            
            add_filter( "acf/location/rule_match", array($this, 'acf_components_rule_match'), 10, 4);
            
            //add featured image in title if available
            add_filter('acf/fields/flexible_content/layout_title', array($this, 'acf_flexible_content_layout_title_thumbnail'), 10, 4);
            add_filter('acf/fields/flexible_content/layout_title', array($this, 'acf_flexible_content_layout_title_preview'), 9, 4);
            
            // handle slug
            add_action('edit_form_before_permalink', array($this, 'acf_extensions_add_slug'));
            add_action('wp_insert_post', array($this, 'acf_extensions_update_component'), 10, 3 );

            // called the base, no parent, cause we're hacking the repeater
            acf_field::__construct();
        }
        
        /**
         * Do not display component, ever.
         *
         * @param $result
         * @param $rule
         * @param $screen
         * @param $field_group
         * @return  bool
         * @version 1.0.13
         * @since   1.0.13
         */
        public function acf_components_rule_match($result, $rule, $screen, $field_group=false ){
            
            if( $field_group && isset($field_group['is_acf_component']) && $field_group['is_acf_component'] )
                return false;
            
            return $result;
        }
        
        
        /**
         * Initialize
         *
         * @since   1.0.13
         * @version 1.0.13
         * @return  void
         */
        public function initialize()
        {
            // nothing
        }
        
        /*
         *  render_field()
         *
         *  Create the HTML interface for your field
         *
         *  @param	$field - an array holding all the field's data
         *
         *  @type	action
         *  @since	3.6
         *  @date	23/01/13
         */
        
        function render_field( $field ) {
            
            if( $field['type'] === 'flexible_content' ){
                
                acf_hidden_input(
                    array(
                        'name' => 'collapse['.$field['key'] . ']',
                        'value' => $field['collapse']??0
                    )
                );
                
                echo '<div class="acf-components-actions"><a class="acf-components-collapse dashicons dashicons-arrow-up-alt2 acf-js-tooltip" title="Collapse all"></a><a class="acf-components-expand dashicons dashicons-arrow-down-alt2 acf-js-tooltip" title="Expand all"></a></div>';
                echo '<script type="text-html" class="tmpl-popup tmpl-popup-components"><ul>';
                
                foreach( $field['layouts'] as $layout ){
                    $atts = array(
                        'href'			=> '#',
                        'data-layout'	=> $layout['name'],
                        'data-min' 		=> $layout['min'],
                        'data-max' 		=> $layout['max'],
                    );
                    
                    echo '<li><a ';
                    acf_esc_attr_e( $atts );
                    echo '>'.$layout['label'].'</a>';
                    
                    $thumbnail = false;
                    
                    if( isset($layout['thumbnail_id']) && !empty($layout['thumbnail_id']) )
                        $thumbnail = wp_get_attachment_url($layout['thumbnail_id']);
                    
                    if( !$thumbnail && isset($layout['thumbnail_path']) && !empty($layout['thumbnail_path']) )
                        $thumbnail = $layout['thumbnail_path'];
                    
                    if( $thumbnail )
                        echo '<span><img src="'.$thumbnail.'"></span>';
                    
                    echo '</li>';
                }
                
                echo '</ul></script>';
                echo '<script type="text-javascript">';
                echo "$('.tmpl-popup-components').prev().find('.tmpl-popup').replaceWith($('.tmpl-popup-components'))";
                echo '</script>';
            }
        }
        
        /**
         * Initialize
         *
         * @param $field_group
         * @return  array
         * @since   1.0.13
         * @version 1.0.13
         */
        public function set_active_status($field_group)
        {
            if( isset($field_group['is_acf_component']) && $field_group['is_acf_component'])
                $field_group['active'] = true;
            
            return $field_group;
        }
        
        /**
         * Field Setting options.
         *
         * @since   1.0.0
         * @version 1.0.5
         * @param   object $field Current field object
         * @return  void
         */
        public function render_field_settings($field)
        {
            // The ACF Group that we want to use
            acf_render_field_setting($field, array(
                'label'         => __('Components', 'acf-components'),
                'instructions'  => __('Select components to be used', 'acf-components'),
                'type'          => 'select',
                'name'          => 'fields_group_id',
                'required'      => 1,
                'multiple'		=> 1,
                'ui'			=> 1,
                'choices'       => array(),
                'acf-components::select_group' => true
            ));
            
            acf_render_field_setting($field, array(
                'label'         => __('Minimum components', 'acf'),
                'instructions'  => '',
                'type'          => 'number',
                'name'          => 'min',
                'placeholder'   => '0',
            ));
            
            // max
            acf_render_field_setting($field, array(
                'label'         => __('Maximum components', 'acf'),
                'instructions'  => '',
                'type'          => 'number',
                'name'          => 'max',
                'placeholder'   => '0',
            ));
            
            // Same as repeater field
            acf_render_field_setting($field, array(
                'label'         => __('Button Label', 'acf'),
                'instructions'  => '',
                'type'          => 'text',
                'name'          => 'button_label',
            ));
            
            acf_render_field_setting($field, array(
                'label'         => __('Auto collapse', 'acf'),
                'instructions'  => '',
                'name'          => 'collapse',
                'type'			=> 'true_false',
                'ui'			=> 1,
            ));
        }
        
        /**
         * Filter the value retured from db
         *
         * @since  1.0.0
         * @version  1.0.14
         * @param  object $field Current field object
         * @return object The filtered values
         */
        public function load_field($field)
        {
            // check if current operation is exporting
            if (! $this->isExporting()) {
                
                // Treat the selected fields as a 'sub-field' in repeater
                
                if( empty($field['fields_group_id']) )
                    return $field;
                
                
                // loop through layouts, sub fields and swap out the field key with the real field
                foreach( $field['fields_group_id'] as $i ) {
                    
                    // extract layout
                    $component = $this->get_component($i);
                    
                    if( !isset($component['fields']) )
                        continue;
                    
                    $sub_fields = $component['fields'];
                    
                    // validate layout
                    $layout = [
                        'name'=> $component['slug'],
                        'label'=> $component['title'],
                        'thumbnail_id'=> isset($component['thumbnail_id'])?$component['thumbnail_id']:'',
                        'thumbnail_path'=> isset($component['thumbnail_path'])?$component['thumbnail_path']:''
                    ];
                    
                    $layout = $this->get_valid_layout( $layout );
                    
                    // append sub fields
                    if( !empty($sub_fields) ) {
                        
                        foreach( array_keys($sub_fields) as $k ) {
                            
                            // check if 'parent_layout' is empty
                            if( empty($sub_fields[ $k ]['parent_layout']) ) {
                                
                                // parent_layout did not save for this field, default it to first layout
                                $sub_fields[ $k ]['parent_layout'] = $layout['key'];
                            }
                            
                            // append sub field to layout,
                            if( $sub_fields[ $k ]['parent_layout'] == $layout['key'] ) {
                                
                                $layout['sub_fields'][] = acf_extract_var( $sub_fields, $k );
                            }
                        }
                    }
                    
                    // append back to layouts
                    $field['layouts'][ $layout['key'] ] = $layout;
                }
            }
            
            if ( (!isset($_GET['post_type']) || $_GET['post_type'] != 'acf-field-group') && get_post_type() != 'acf-field-group')
                $field['type'] = 'flexible_content';
            
            return parent::load_field($field);
        }
        
        
        /**
         * Remove layout from filed group and add thumbnail id, recursively
         *
         * @since  1.0.2
         * @deprecated 1.0.12
         * @param  array $field_group
         * @return array
         */
        public function prepare_field_group_for_export($field_group)
        {
            if( isset($field_group['fields']) )
                $type = 'fields';
            elseif( isset($field_group['sub_fields']) )
                $type = 'sub_fields';
            else
                return $field_group;
            
            if( !is_array($field_group[$type]))
                return $field_group;
            
            foreach ($field_group[$type] as &$field)
            {
                if( $field['type'] == 'components' && isset($field['layouts']))
                    unset($field['layouts']);
                
                $field = $this->prepare_field_group_for_export($field);
            }
            
            if($type == 'fields'){
                
                $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                
                $wp_upload_dir = wp_upload_dir();
                
                $acf_thumb_dir = '/acf-thumbnails';
                
                $image_src = get_attached_file($thumbnail_id);
                
                if( $image_src && strlen($image_src) ){
                    
                    $src_filename = str_replace($wp_upload_dir['basedir'],'', str_replace('-150x150', '', $image_src));
                    $ext = '.'.pathinfo($src_filename, PATHINFO_EXTENSION);
                    
                    $dest_filename = $field_group['key'].$ext;
                    $dest_filepath = $wp_upload_dir['basedir'].$acf_thumb_dir.'/'.$dest_filename;
                    $dest_folder = dirname($dest_filepath);
                    if( !is_dir( $dest_folder ) )
                        mkdir($dest_folder, 0777, true);
                    
                    if( file_exists($wp_upload_dir['basedir'].'/'.$src_filename) ){
                        
                        $src_filepath = $wp_upload_dir['basedir'].'/'.$src_filename;
                        $thumb_src_filepath = $wp_upload_dir['basedir'].'/'.str_replace($ext, '-150x150'.$ext, $src_filename);
                        $thumb_dest_filepath = str_replace($ext, '-150x150'.$ext, $dest_filepath);
                        
                        if( copy($src_filepath, $dest_filepath) ){
                            if( file_exists($thumb_src_filepath) ){
                                if( copy($thumb_src_filepath, $thumb_dest_filepath) )
                                    $field_group['thumbnail_path'] = $wp_upload_dir['relative'].$acf_thumb_dir.'/'.$dest_filename;
                            }
                        }
                    }
                }
                
                $field_group['active'] = 1;
                
                //todo: find a better way than using Request
                if( isset($_REQUEST['slug']) )
                    $field_group['slug'] = sanitize_title($_REQUEST['slug']);
            }
            
            return $field_group;
        }
        
        /**
         * Update field group
         *
         * @since  1.0.2
         * @deprecated 1.0.12
         * @param  array $field_group
         * @return array
         */
        public function update_field_group($field_group)
        {
            if( isset($field_group['thumbnail_path']) and !empty($field_group['thumbnail_path'])) {
                
                if( !has_post_thumbnail($field_group['ID']) ){
                    
                    $wp_upload_dir = wp_upload_dir();
                    $filepath = $wp_upload_dir['basedir'].str_replace($wp_upload_dir['relative'],'', $field_group['thumbnail_path']);
                    $filename = basename($filepath);
                    
                    if( file_exists($filepath) ){
                        $upload_file = wp_upload_bits($filename, null, file_get_contents($filepath));
                        if( !$upload_file['error'] ){
                            $wp_filetype = wp_check_filetype($filename, null );
                            $attachment = array(
                                'post_mime_type' => $wp_filetype['type'],
                                'post_parent' => $field_group['ID'],
                                'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
                                'post_content' => '',
                                'post_status' => 'inherit'
                            );
                            $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $field_group['ID'] );
                            if (!is_wp_error($attachment_id)) {
                                $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
                                wp_update_attachment_metadata( $attachment_id,  $attachment_data );
                                set_post_thumbnail($field_group['ID'], $attachment_id);
                            }
                        }
                    }
                }
            }
            
            return $field_group;
        }
        
        /**
         * Add scripts for input editing page
         *
         * @since  1.0.0
         * @version 1.0.10
         * @return void
         */
        public function input_admin_enqueue_scripts()
        {
            $dir = plugin_dir_url(__DIR__);
            
            wp_enqueue_style(
                'acf-input-component_field',
                "{$dir}css/input.css",
                [],
                ACF_EXTENSIONS_VERSION
            );
            
            wp_enqueue_script(
                'acf-input-component_field',
                "{$dir}js/input.js",
                [],
                ACF_EXTENSIONS_VERSION
            );
        }
        
        /**
         * Add scripts for group editing page
         *
         * @since  1.0.0
         * @return void
         */
        public function field_group_admin_enqueue_scripts()
        {
            $dir = plugin_dir_url(__DIR__);
            
            wp_enqueue_script(
                'acf-group-component_field',
                "{$dir}js/group.js",
                array('acf-pro-input'),
                ACF_EXTENSIONS_VERSION
            );
            
            wp_enqueue_style(
                'acf-group-component_field',
                "{$dir}css/group.css",
                [],
                ACF_EXTENSIONS_VERSION
            );
        }
        
        /**
         * Add scripts for group editing page
         *
         * @since  1.0.0
         * @return void
         */
        public function field_group_enqueue_style()
        {
            $dir = plugin_dir_url(__DIR__);
            $url = get_home_url();
            
            wp_enqueue_style(
                'acf-group-component_thumbnail',
                "{$dir}css/thumbnail.css"
            );
        }
        
        /**
         * Register a seperated post status to indicate component
         *
         * @since  1.0.0
         * @return void
         */
        public function register_component_post_status()
        {
            register_post_status('acf-component', array(
                'label'                     => __('Component', 'acf-components'),
                'public'                    => ! is_admin(),
                'exclude_from_search'       => true,
                'show_in_admin_all_list'    => false,
                'show_in_admin_status_list' => true,
                'label_count'               => _n_noop('Component <span class="count">(%s)</span>', 'Components <span class="count">(%s)</span>', 'acf-components'),
            ));
            
            if( (isset($_GET['post']) && get_post_status($_GET['post']) == 'acf-component') || (isset($_POST['post_ID']) && get_post_status($_POST['post_ID']) == 'acf-component') )
                add_post_type_support( 'acf-field-group', 'thumbnail' );
        }
        
        /**
         * Add metabox in group editing page for assigning as component
         *
         * @since  1.0.0
         * @return void
         */
        public function add_component_meta_boxes()
        {
            add_meta_box(
                'acf-component-field-metabox',
                __('ACF Components', 'acf-components'),
                array($this, 'component_metabox_callback'),
                'acf-field-group',
                'side'
            );
        }
        
        
        /**
         * Show thumbnail in the title if available
         *
         * @param $title
         * @param $field
         * @param $layout
         * @param $i
         * @return string
         * @since  1.0.0
         */
        public function acf_flexible_content_layout_title_thumbnail( $title, $field, $layout, $i ) {
            
            $thumbnail = false;
            
            if( isset($layout['thumbnail_id']) && !empty($layout['thumbnail_id']) )
                $thumbnail = wp_get_attachment_url($layout['thumbnail_id']);
            
            if( !$thumbnail && isset($layout['thumbnail_path']) && !empty($layout['thumbnail_path']) )
                $thumbnail = $layout['thumbnail_path'];
            
            if( $thumbnail ) {
                $path_parts = pathinfo($thumbnail);
                $small = str_replace('.'.$path_parts['extension'], '-150x150.'.$path_parts['extension'], $thumbnail);
                
                $html = '<div class="thumbnail">';
                $html .= '<img src="' . $small . '" class="small"/>';
                $html .= '<img src="' . $thumbnail . '" class="large" />';
                $html .= '</div>';
                $html .= $title;
                
                return $html;
            }
            
            return $title;
        }
        
        
        /**
         * Show thumbnail in the title if available
         *
         * @param $title
         * @param $field
         * @param $layout
         * @param $i
         * @return string
         * @since  1.0.0
         */
        public function acf_flexible_content_layout_title_preview( $title, $field, $layout, $i ) {
            
            $preview = '';
            $values = $_POST['value'] ?? ($field['value'][$i]??[]);
            
            foreach($layout['sub_fields'] as $sub_field){
                
                $value = $values[$sub_field['key']]['value']??$values[$sub_field['key']]??'';
                
                if( in_array($sub_field['type'],['text','wysiwyg','textarea']) && !empty($value) && is_string($value) ){
                    
                    $preview = strip_tags($value);
                    break;
                }
            }
            
            return '<span class="acf-component-title">'.$title.'</span><span class="acf-component-preview-title">'.(!empty($preview)?' : '.substr($preview,0,100):'').'</span>';
        }
        
        
        /**
         * Callback for the metabox output
         *
         * @since  1.0.0
         * @return void
         */
        public function component_metabox_callback()
        {
            global $post;
            $checked = $post->post_status == 'acf-component'? 'checked' : '';
            printf('<input type="hidden" name="%s" value="0" />', 'acf_field_group[is_acf_component]');
            printf('<label><input type="checkbox" name="%s" value="1" %s id="is_acf_component_checkbox" /> %s</label>',
                'acf_field_group[is_acf_component]',
                $checked, __('use as component', 'acf-components')
            );
        }
        
        /**
         * Check and assign the group to acf-component status on save and import
         *
         * @since  1.0.1
         * @version 1.0.9
         * @param  array $field_group the group object
         * @return void
         */
        public function update_component_post_status($field_group)
        {
            $data = array('ID'=>$field_group['ID']);
            
            // update the post status when it's saving the group
            if ($group = acf_maybe_get($_POST, 'acf_field_group', false)) {
                if (acf_maybe_get($group, 'is_acf_component', null))
                    $data['post_status'] = 'acf-component';
            }
            
            // if it's updated from a sync, update the status as well
            if (acf_maybe_get($_GET, 'acfsync') || acf_maybe_get($_GET, 'action2') === 'acfsync') {
                if (acf_maybe_get($field_group, 'is_acf_component', null))
                    $data['post_status'] = 'acf-component';
                
                if ($slug = acf_maybe_get($field_group, 'slug', null))
                    $data['post_excerpt'] = $slug;
            }
            
            // update the post status when it's importing from json
            if (isset($_FILES['acf_import_file'])) {
                if (acf_maybe_get($field_group, 'is_acf_component', null))
                    $data['post_status'] = 'acf-component';
                
                if ($slug = acf_maybe_get($field_group, 'slug', null))
                    $data['post_excerpt'] = $slug;
            }
            
            wp_update_post($data);
        }
        
        /**
         * Add acf-component status on the export lists
         *
         * @since  1.0.0
         * @param  object $query thee query to retreive export list
         * @return void
         */
        public function display_component_on_export($query)
        {
            if (acf_maybe_get($_GET, 'page') == 'acf-settings-tools') {
                $post_status = $query->get('post_status');
                
                // some of the code is passing string...
                if (is_string($post_status)) {
                    $post_status .= ', acf-component';
                } else
                    if (is_array($post_status)) {
                        $post_status[] = 'acf-component';
                    }
                
                $query->set('post_status', $post_status);
            }
        }
        
        /**
         * Reset the repeater field's delete hook,
         * cause we don't want to delete the component
         *
         * @since  1.0.0
         * @param  array $field current field instance
         * @return void
         */
        public function delete_field( $field ) {}
        
        /**
         * Reset the repeater field's duplicate hook,
         * cause component should not be duplicated
         *
         * @since  1.0.0
         * @param  array $field current field instance
         * @return array
         */
        public function duplicate_field( $field )
        {
            return $field;
        }
        
        /**
         * Fetch the available field groups for select
         *
         * @since  1.0.0
         * @version 1.0.5
         * @return array available field groups
         */
        protected function fetch_available_field_groups()
        {
            $available_groups = array();
            
            // load from local php
            $local_groups = acf_get_local_field_groups();
            foreach ($local_groups as $group) {
                if (isset($group['is_acf_component']) && $group['is_acf_component']) {
                    $available_groups[$group['key']] = $group['title'];
                }
            }
            
            // then we load the ones from database
            $groups_query = new WP_Query();
            $groups_query->query(array(
                'post_type'      => 'acf-field-group',
                'posts_per_page' => -1,
                'post_status'    => 'acf-component',
                'post__not_in'   => isset($_GET['post'])? array((int) $_GET['post']) : array()
            ));
            
            foreach ($groups_query->posts as $group) {
                $available_groups[$group->post_name] = $group->post_title;
            }
            
            return $available_groups;
        }
        
        
        /**
         * Display slug form
         *
         * @param $post
         * @return void
         * @since  1.0.0
         */
        public function acf_extensions_add_slug($post) {
            if($post->post_type == 'acf-field-group' && $post->post_status == 'acf-component'){
                $html =
                    '<div class="hide-if-no-js">'.
                    '<strong>'.__( 'Slug' ).'</strong> '.
                    '<span id="editable-post-name"><input type="text" name="slug" value="'.$post->post_excerpt.'" autocomplete="off"></span> </span>'.
                    '<span id="edit-slug-buttons"><button type="submit" class="save button button-small">OK</button></span>'.
                    '</div>';
                echo $html;
            }
        }
        
        
        /**
         * Save slug to post_excerpt
         *
         * @param $post_ID
         * @param $post
         * @param $update
         * @return void
         * @since  1.0.0
         */
        public function acf_extensions_update_component($post_ID, $post, $update) {
            
            if( $post->post_type == 'acf-field-group' && isset($_REQUEST['slug']) ){
                
                global $wpdb;
                $wpdb->update( $wpdb->posts, ['post_excerpt' => sanitize_title($_REQUEST['slug'])], ['ID' => $post_ID] );
            }
        }
        
        /**
         * Get the component field group
         *
         * @since  1.0.2
         * @version 1.0.11
         * @param $group_key
         * @return array
         */
        protected function get_component($group_key) {
            
            // bail early
            if (! $group_key) {
                return array();
            }
            
            // if acf is able to load it from local json or php, then we return it
            if ($field_group = acf_get_field_group($group_key)) {
                
                $thumbnail_id = isset($field_group['thumbnail_id'])?$field_group['thumbnail_id']:false;
                
                if(!$thumbnail_id && isset($field_group['ID']) && $field_group['ID'])
                    $thumbnail_id = get_post_thumbnail_id($field_group['ID']);
                
                $slug = isset($field_group['slug'])?$field_group['slug']:false;
                if( !$slug )
                    $slug = get_the_excerpt($field_group['ID']);
                
                return [
                    'title'=>$field_group['title'],
                    'fields'=>acf_get_fields($field_group),
                    'thumbnail_path'=>isset($field_group['thumbnail_path'])?$field_group['thumbnail_path']:false,
                    'thumbnail_id'=>$thumbnail_id,
                    'slug'=>$slug?$slug:sanitize_title($field_group['title'])
                ];
            }
            
            // vars
            $args = array(
                'posts_per_page'    => 1,
                'post_type'         => 'acf-field-group',
                'orderby'           => 'menu_order title',
                'order'             => 'ASC',
                'suppress_filters'  => false,
                'post_status'       => array('acf-component'),
                'pagename'          => $group_key // hacky, but there's no parameter for post_name
            );
            
            // load posts
            $posts = get_posts($args);
            
            // validate
            if (empty($posts)) {
                return array();
            }
            
            $post = $posts[0];
            
            return [
                'title'=>$post->title,
                'slug'=>$post->post_excerpt,
                'fields'=>acf_get_fields($post->ID),
                'thumbnail_id'=>get_post_thumbnail_id($post->ID)
            ];
        }
        
        /**
         * Filter the component field group
         *
         * @since   1.0.5
         * @version 1.0.11
         * @param   array $field current field instance
         * @return  array
         */
        public function filter_available_field_groups($field) {
            if ($field['type'] == 'select' && isset($field['acf-components::select_group'])) {
                $field['choices'] = $this->fetch_available_field_groups();
                
            }
            return $field;
        }
        
        /**
         * Include the ACF component field groups
         *
         * @since   1.0.6
         * @version 1.0.8
         * @param   array $groups field groups
         * @return  array
         */
        public function include_component_field_groups($groups)
        {
            $args = array(
                'posts_per_page'    => -1,
                'post_type'         => 'acf-field-group',
                'orderby'           => 'menu_order title',
                'order'             => 'ASC',
                'suppress_filters'  => false,
                'post_status'       => array('acf-component')
            );
            
            // load posts from db
            $posts = get_posts($args);
            
            foreach ($posts as $post) {
                $groups[] = acf_get_field_group($post);
            }
            
            return $groups;
        }
        
        
        /**
         * Update the post status on field group duplication
         *
         * @since   1.0.11
         * @param   array $field_group field_group
         * @return  void
         */
        public function update_component_status_on_duplication($field_group)
        {
            if (! acf_maybe_get($field_group, 'is_acf_component', 0)) {
                return;
            }
            
            wp_update_post(array(
                'ID' => $field_group['ID'],
                'post_status' => 'acf-component'
            ));
        }
        
        /**
         * Append component status to the query
         *
         * @since  1.0.14
         * @param  object $query WP_Query
         * @return void
         */
        public function include_component_post_status($query)
        {
            if ($query->get('post_type') != 'acf-field-group') {
                return;
            }
            
            if (! is_array($query->get('post_status')) ) {
                return;
            }
            
            $postStatus = $query->get('post_status');
            $postStatus[] = 'acf-component';
            
            $query->set('post_status', $postStatus);
        }
        
        /**
         * Check if currently is exporting field group,
         * acf pro v5.6.5 added new "admin tool" interface
         *
         * @since  1.0.14
         * @return boolean
         */
        protected function isExporting()
        {
            if (isset($_POST['acf_export_keys'])) {
                return true;
            }
            
            if (acf_maybe_get_GET('tool') == 'export' && acf_maybe_get_GET('keys')) {
                return true;
            }
            
            if (acf_maybe_get_POST('action') == 'download' && acf_maybe_get_POST('keys')) {
                return true;
            }
            
            return false;
        }
    }

    acf_register_field_type( 'acf_field_components' );

endif; // class_exists check

