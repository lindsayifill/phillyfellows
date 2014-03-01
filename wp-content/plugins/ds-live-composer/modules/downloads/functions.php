<?php

include DS_LIVE_COMPOSER_ABS . '/modules/downloads/inc/ajax.php';

function dslc_downloads_module_init() {

	/**
	 * Custom Post Type
	 */

	register_post_type( 'dslc_downloads', array(
		'menu_icon' => 'dashicons-download',
		'labels' => array(
			'name' => __( 'Downloads', 'dslc_string' ),
			'singular_name' => __( 'Download Item', 'dslc_string' ),
			'add_new' => __( 'Add Download Item', 'dslc_string' ),
			'add_new_item' => __( 'Add Download Item', 'dslc_string' ),
			'edit' => __( 'Edit', 'dslc_string' ),
			'edit_item' => __( 'Edit Download Item', 'dslc_string' ),
			'new_item' => __( 'New Download Item', 'dslc_string' ),
			'view' => __( 'View Download Item', 'dslc_string' ),
			'view_item' => __( 'View Download Item', 'dslc_string' ),
			'search_items' => __( 'Search Download Item', 'dslc_string' ),
			'not_found' => __( 'No Download Item found', 'dslc_string' ),
			'not_found_in_trash' => __( 'No Download Item found in Trash', 'dslc_string' ),
			'parent' => __( 'Parent Download Item', 'dslc_string' ),
		),
		'public' => true,
		'rewrite' => array( 'slug' => dslc_get_option( 'downloads_slug', 'dslc_plugin_options_cpt_slugs' ) ),
		'supports' => array( 'title', 'custom-fields', 'excerpt', 'editor', 'author', 'thumbnail' ),
	));
	
	/**
	 * Custom Taxonomies
	 */

	register_taxonomy('dslc_downloads_cats', 'dslc_downloads', array( 'label' => 'Categories', 'hierarchical' => true, 'public' => true, 'rewrite' => array( 'slug' => dslc_get_option( 'downloads_cats_slug', 'dslc_plugin_options_cpt_slugs' ) )));
	register_taxonomy('dslc_downloads_tags', 'dslc_downloads', array( 'label' => 'Tags', 'hierarchical' => false, 'public' => true, 'rewrite' => array( 'slug' => dslc_get_option( 'downloads_tags_slug', 'dslc_plugin_options_cpt_slugs' ) )));

	/**
	 * Post Options
	 */

	global $dslc_var_post_options;
	$dslc_var_post_options['dslc-downloads-module-options'] = array(
		'title' => 'Download Options',
		'show_on' => 'dslc_downloads',
		'options' => array(
			array(
				'label' => 'Downloadable File',
				'std' => '',
				'id' => 'dslc_download_file',
				'type' => 'file',
			),
		)
	);

} add_action( 'init', 'dslc_downloads_module_init' );