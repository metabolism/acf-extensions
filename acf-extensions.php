<?php
/*
    Plugin Name: Advanced Custom Fields Extensions
    Description: Advanced Custom Fields add on. Create components, component field, hidden field and latest post field
    Version: 1.1.11
    Author: Metabolism
    License: GPLv2 or later
    License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('ABSPATH') or die('No script kiddies please!');

/**
 * Load up the translation files
 *
 * @since  1.0.4
 * @return void
 */
function acf_extensions_load_textdomain() {
    load_plugin_textdomain('acf-component_field', false, dirname(plugin_basename(__FILE__)).'/lang/');
}

add_action('plugins_loaded', 'acf_extensions_load_textdomain');


/**
 * Load the main field class after core acf init
 *
 * @since  1.0.0
 * @return void
 */
function include_acf_extensions_plugin() {

	$required_version = '5.8.0';

	if( !function_exists('acf') )
		return;

	$acf = acf();

	if( is_admin() && version_compare($acf->version, $required_version, '<') ) {
		add_action('admin_notices', function() use($required_version){
			echo '<div class="error"><p>'.__('ACF Extensions plugin requires ACF PRO '.$required_version).'</p></div>';
		});
	}

	include_once('fields/class-acf-field-component.php');
	include_once('fields/class-acf-field-components.php');
	include_once('fields/class-acf-field-hidden.php');
	include_once('fields/class-acf-field-children.php');
	include_once('fields/class-acf-field-latest_posts.php');
	include_once('fields/class-acf-field-link.php');
	include_once('fields/class-acf-field-map.php');
	include_once('fields/class-acf-field-dynamic_select.php');
	include_once('fields/class-acf-field-id.php');
	include_once('fields/class-acf-field-instagram_post.php');

	include_once('rules/class-acf-rule-multisite.php');
	include_once('rules/class-acf-rule-parent-post.php');
	include_once('rules/class-acf-rule-tax-type.php');

	include_once('settings/class-acf-field-tag.php');

	include_once('plugins/class-export.php');
}

add_action('acf/include_field_types', 'include_acf_extensions_plugin');

add_action('acf/init', function (){

    if( isset($_GET['clean-acf']) && $_GET['clean-acf'] && is_admin() && current_user_can('administrator')){

        $folder = apply_filters('acf/settings/save_json', '');

        foreach (glob($folder."/*.*") as $filename) {

            $content = json_decode(file_get_contents($filename), true);
            foreach($content['fields'] as $i=>$field){

                if(!($field['key']??false) || empty($field))
                    unset($content['fields'][$i]);
            }
            file_put_contents($filename, json_encode($content, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        }

        global $wpdb;

        $wpdb->query("DELETE pm FROM $wpdb->postmeta pm LEFT JOIN $wpdb->posts wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL");
        $wpdb->query("DELETE FROM $wpdb->posts WHERE post_type='acf-field'");
    }
});

add_filter( 'mce_external_plugins', function ( $plugins ) {
	$plugins['table'] = content_url() . '/plugins/acf-extensions/js/tinymce/table/plugin.min.js';
	return $plugins;
});


/**
 * Change acf-component status back to acf-diabled when deactivated
 *
 * @since  1.0.0
 * @return void
 */
function deactivate_acf_extensions_plugin() {

    // convert all the acf-component to acf-disabled
    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'acf-field-group',
        'post_status'    => array('acf-component')
    );

    $field_groups = get_posts($args);

    foreach ($field_groups as $field_group) {
        $field_group->post_status = 'acf-disabled';
        wp_update_post($field_group);
    }
}

register_deactivation_hook(__FILE__, 'deactivate_acf_extensions_plugin');


/**
 * Loop through the inactive acf field group and tag them as acf component
 * don't touch the enable ones even its is_acf_component is true.
 * Because the means user manually enable it,
 * thus might not be a component anymore
 *
 * @since  1.0.7
 * @return void
 */
function activate_acf_extensions_plugin() {

    if( !function_exists('acf_get_field_group') )
        return;

    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'acf-field-group',
        'post_status'    => array('acf-component', 'acf-disabled')
    );

    $field_groups = get_posts($args);

    foreach ($field_groups as $field_group) {
        $acf = acf_get_field_group($field_group);

        if (acf_maybe_get($acf, 'is_acf_component', 0) == 1) {
            wp_update_post(array(
                'ID' => $field_group->ID,
                'post_status' => 'acf-component'
            ));
        }
    }
}

register_activation_hook(__FILE__, 'activate_acf_extensions_plugin');
