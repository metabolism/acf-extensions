<?php

if( ! class_exists('acf_field_component') ) :

	/**
	 * ACF Component Field Class
	 *
	 * Using existing functionality of clone field, extends it to another
	 * field type that allows embedding the entire group without recreating.
	 *
	 * @since       1.0.0
	 * @version     1.0.14
	 * @class       acf_field_component
	 * @extends     acf_field_clone
	 */
	class acf_field_component extends acf_field_clone {

		public $cloning;
		public $have_rows;

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
			$this->name = 'component';
			$this->category = 'relational';
			$this->label = __('Component','acf');
			$this->defaults = array(
				'clone' => '',
				'field_group_id' => '',
				'prefix_label'	 => 0,
				'prefix_name'	 => 0,
				'display'		 => 'group',
				'layout'		 => 'block'
			);
			$this->cloning = array();
			$this->have_rows = 'single';

			acf_enable_filter('clone');

			add_filter('acf/get_fields', 		array($this, 'acf_get_fields'), 5, 2);
			add_filter('acf/prepare_field',		array($this, 'acf_prepare_field'), 10, 1);
			add_filter('acf/clone_field',		array($this, 'acf_clone_field'), 10, 2);
		}


		/*
	     *  acf_clone_field
	     *
	     *  This function is run when cloning a clone field
	     *  Important to run the acf_clone_field function on sub fields to pass on settings such as 'parent_layout'
	     *
	     *  @type	function
	     *  @date	28/06/2016
	     *  @since	5.3.8
	     *
	     *  @param	$field (array)
	     *  @param	$clone_field (array)
	     *  @return	$field
	     */
		function acf_clone_field( $field, $clone_field ) {

			// bail early if this field is being cloned by some other kind of field (future proof)
			if($clone_field['type'] == 'component')
				$clone_field['type'] = 'clone';

			if($field['type'] == 'component')
				$field['type'] = 'clone';

			$name = $clone_field['name'];
			$display = $clone_field['display'];

			$field = parent::acf_clone_field($field, $clone_field);

			if( $display == 'group' )
				$field['name'] = $field['__name'] = $name.'_'.$field['name'];

			return $field;
		}


		/*
	     *  get_cloned_fields
	     *
	     *  This function will return an array of fields for a given clone field
	     *
	     *  @type	function
	     *  @date	28/06/2016
	     *  @since	5.3.8
	     *
	     *  @param	$field (array)
	     *  @param	$parent (array)
	     *  @return	(array)
	     */
		function get_cloned_fields( $field ) {

			if(isset($field['field_group_id']))
				$field['clone'] = [$field['field_group_id']];

			return parent::get_cloned_fields($field);

		}

		/**
		 * Filter the value returned from db
		 *
		 * @since  1.0.0
		 * @version  1.0.14
		 * @param  object $field Current field object
		 * @return object The filtered values
		 */
		public function load_field($field)
		{
			$field = parent::load_field($field);

			if ( (!isset($_GET['post_type']) || $_GET['post_type'] != 'acf-field-group') && get_post_type() != 'acf-field-group')
				$field['type'] = 'clone';

			return $field;
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

			// The ACF Group that we want to use
			acf_render_field_setting($field, array(
				'label'         => __('Component', 'acf-components'),
				'instructions'  => __('Select component to be used', 'acf-components'),
				'type'          => 'select',
				'name'          => 'field_group_id',
				'required'      => 1,
				'multiple'		=> 0,
				'ui'			=> 0,
				'choice'       => false,
				'acf-components::select_group' => true
			));

			// display
			acf_render_field_setting( $field, array(
				'label'			=> __('Display','acf'),
				'instructions'	=> __('Specify the style used to render the clone field', 'acf'),
				'type'			=> 'select',
				'name'			=> 'display',
				'class'			=> 'setting-display',
				'choices'		=> array(
					'group'			=> __('Group (displays selected fields in a group within this field)','acf'),
					'seamless'		=> __('Seamless (replaces this field with selected fields)','acf'),
				),
			));
		}
	}

	acf_register_field_type( 'acf_field_component' );

endif; // class_exists check
