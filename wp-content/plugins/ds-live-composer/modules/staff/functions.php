<?php

global $dslc_var_post_options;

$dslc_var_post_options['dslc-staff-post-options'] = array(
	'title' => 'Staff Member Options',
	'show_on' => 'dslc_staff',
	'options' => array(
		array(
			'label' => 'Position',
			'std' => '',
			'id' => 'dslc_staff_position',
			'type' => 'text',
		),
		array(
			'label' => 'Social - Twitter',
			'std' => '',
			'id' => 'dslc_staff_social_twitter',
			'type' => 'text',
		),
		array(
			'label' => 'Social - Facebook',
			'std' => '',
			'id' => 'dslc_staff_social_facebook',
			'type' => 'text',
		),
		array(
			'label' => 'Social - GooglePlus',
			'std' => '',
			'id' => 'dslc_staff_social_googleplus',
			'type' => 'text',
		),
		array(
			'label' => 'Social - LinkedIn',
			'std' => '',
			'id' => 'dslc_staff_social_linkedin',
			'type' => 'text',
		)
	)
);

function dslc_staff_module_cpt() {

	register_post_type( 'dslc_staff', array(
		'menu_icon' => 'dashicons-id',
		'labels' => array(
			'name' => __( 'Staff', 'dslc_string' ),
			'singular_name' => __( 'Staff Member', 'dslc_string' ),
			'add_new' => __( 'Add Staff', 'dslc_string' ),
			'add_new_item' => __( 'Add Staff Member', 'dslc_string' ),
			'edit' => __( 'Edit Staff', 'dslc_string' ),
			'edit_item' => __( 'Edit Staff Member', 'dslc_string' ),
			'new_item' => __( 'New Staff Member', 'dslc_string' ),
			'view' => __( 'View Staff', 'dslc_string' ),
			'view_item' => __( 'View Staff Member', 'dslc_string' ),
			'search_items' => __( 'Search Staff', 'dslc_string' ),
			'not_found' => __( 'No Staff found', 'dslc_string' ),
			'not_found_in_trash' => __( 'No Staff found in Trash', 'dslc_string' ),
			'parent' => __( 'Parent Staff Member', 'dslc_string' ),
		),
		'public' => true,
		'rewrite' => array( 'slug' => dslc_get_option( 'staff_slug', 'dslc_plugin_options_cpt_slugs' ) ),
		'supports' => array( 'title', 'custom-fields', 'excerpt', 'editor', 'author', 'thumbnail'  ),
	));
	
	register_taxonomy('dslc_staff_cats', 'dslc_staff', array( 'label' => 'Categories', 'hierarchical' => true, 'public' => true, 'rewrite' => array( 'slug' => dslc_get_option( 'staff_cats_slug', 'dslc_plugin_options_cpt_slugs' ) )));

} add_action( 'init', 'dslc_staff_module_cpt' );