<?php

function dslc_projects_module_cpt() {

	register_post_type( 'dslc_projects', array(
		'menu_icon' => 'dashicons-feedback',
		'labels' => array(
			'name' => __( 'Projects', 'dslc_string' ),
			'singular_name' => __( 'Project', 'dslc_string' ),
			'add_new' => __( 'Add Project', 'dslc_string' ),
			'add_new_item' => __( 'Add Project', 'dslc_string' ),
			'edit' => __( 'Edit', 'dslc_string' ),
			'edit_item' => __( 'Edit Project', 'dslc_string' ),
			'new_item' => __( 'New Project', 'dslc_string' ),
			'view' => __( 'View Project', 'dslc_string' ),
			'view_item' => __( 'View Project', 'dslc_string' ),
			'search_items' => __( 'Search Project', 'dslc_string' ),
			'not_found' => __( 'No Project found', 'dslc_string' ),
			'not_found_in_trash' => __( 'No Project found in Trash', 'dslc_string' ),
			'parent' => __( 'Parent Project', 'dslc_string' ),
		),
		'public' => true,
		'rewrite' => array( 'slug' => dslc_get_option( 'projects_slug', 'dslc_plugin_options_cpt_slugs' ) ),
		'supports' => array( 'title', 'custom-fields', 'excerpt', 'editor', 'author', 'thumbnail'  ),
	));
	
	register_taxonomy('dslc_projects_cats', 'dslc_projects', array( 'label' => 'Categories', 'hierarchical' => true, 'public' => true, 'rewrite' => array( 'slug' => dslc_get_option( 'projects_cats_slug', 'dslc_plugin_options_cpt_slugs' ) )  ));

} add_action( 'init', 'dslc_projects_module_cpt' );