<?php

global $dslc_var_post_options;

$dslc_var_post_options['dslc-gallery-post-options'] = array(
	'title' => 'Gallery Options',
	'show_on' => 'dslc_galleries',
	'options' => array(
		array(
			'label' => 'Images',
			'std' => '',
			'id' => 'dslc_gallery_images',
			'type' => 'files',
		),
	)
);

function dslc_galleries_module_cpt() {

	register_post_type( 'dslc_galleries', array(
		'menu_icon' => 'dashicons-format-gallery',
		'labels' => array(
			'name' => __( 'Galleries', 'dslc_string' ),
			'singular_name' => __( 'Add Gallery', 'dslc_string' ),
			'add_new' => __( 'Add Gallery', 'dslc_string' ),
			'add_new_item' => __( 'Add Gallery', 'dslc_string' ),
			'edit' => __( 'Edit', 'dslc_string' ),
			'edit_item' => __( 'Edit Gallery', 'dslc_string' ),
			'new_item' => __( 'New Gallery', 'dslc_string' ),
			'view' => __( 'View Gallery', 'dslc_string' ),
			'view_item' => __( 'View Gallery', 'dslc_string' ),
			'search_items' => __( 'Search Gallery', 'dslc_string' ),
			'not_found' => __( 'No Gallery found', 'dslc_string' ),
			'not_found_in_trash' => __( 'No Gallery found in Trash', 'dslc_string' ),
			'parent' => __( 'Parent Gallery', 'dslc_string' ),
		),
		'public' => true,
		'rewrite' => array( 'slug' => dslc_get_option( 'galleries_slug', 'dslc_plugin_options_cpt_slugs' ) ),
		'supports' => array( 'title', 'custom-fields', 'excerpt', 'editor', 'author', 'thumbnail'  ),
	));
	
	register_taxonomy('dslc_galleries_cats', 'dslc_galleries', array( 'label' => 'Categories', 'hierarchical' => true, 'public' => true, 'rewrite' => array( 'slug' => dslc_get_option( 'galleries_cats_slug', 'dslc_plugin_options_cpt_slugs' ) ) ));

} add_action( 'init', 'dslc_galleries_module_cpt' );