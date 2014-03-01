<?php

/**
 * Table of Contents
 *
 * - dslc_load_scripts ( Load CSS and JS files )
 * - dslc_load_admin_scripts ( Load CSS and JS files for the admin )
 * - dslc_load_fonts ( Load Google Fonts )
 */


/**
 * Load CSS and JS files
 *
 * @since 1.0
 */

function dslc_load_scripts() {

	global $dslc_active;

	wp_enqueue_style( 'dslc-main-css', DS_LIVE_COMPOSER_URL . 'css/main.css');
	wp_enqueue_style( 'dslc-front-plugins-css', DS_LIVE_COMPOSER_URL . 'css/front/plugins.css');
	wp_enqueue_style( 'dslc-font-awesome', DS_LIVE_COMPOSER_URL . 'css/font-awesome.css');
	wp_enqueue_style( 'dslc-modules-css', DS_LIVE_COMPOSER_URL . 'css/modules.css');
	
	wp_enqueue_script( 'dslc-front-plugins-js', DS_LIVE_COMPOSER_URL . 'js/front-plugins.js', array( 'jquery' ) );
	wp_enqueue_script( 'dslc-front-js', DS_LIVE_COMPOSER_URL . 'js/front.js', array( 'jquery' ) );
	wp_localize_script( 'dslc-front-js', 'DSLCAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	
	// Check if the user can work with composer
	if ( $dslc_active && is_user_logged_in() && current_user_can( DS_LIVE_COMPOSER_CAPABILITY ) ) {

		wp_enqueue_media();
		
		// CSS
		wp_enqueue_style( 'jquery-ui-slider' );
		wp_enqueue_style( 'dslc-composer-css', DS_LIVE_COMPOSER_URL . 'css/composer.css');
		wp_enqueue_style( 'dslc-plugins-css', DS_LIVE_COMPOSER_URL . 'css/plugins.css');

		// JavaScript
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-droppable' );
		wp_enqueue_script( 'jquery-effects-core' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'dslc-load-fonts', 'http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js' );
		wp_enqueue_script( 'dslc-plugins-js', DS_LIVE_COMPOSER_URL . 'js/plugins.js', array( 'jquery' ) );
		wp_enqueue_script( 'dslc-main-js', DS_LIVE_COMPOSER_URL . 'js/main.js', array( 'jquery' ) );
		wp_localize_script( 'dslc-main-js', 'DSLCAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	}

} add_action( 'wp_enqueue_scripts', 'dslc_load_scripts' );


/**
 * Load CSS and JS files for the admin
 *
 * @since 1.0
 */

function dslc_load_admin_scripts() {

	wp_enqueue_script( 'dslc-post-options-js-admin', DS_LIVE_COMPOSER_URL . 'includes/post-options-framework/js/main.js', array( 'jquery' ) );
	wp_enqueue_style( 'dslc-post-options-css-admin', DS_LIVE_COMPOSER_URL . 'includes/post-options-framework/css/main.css');

	wp_enqueue_script( 'dslc-plugin-options-js-admin', DS_LIVE_COMPOSER_URL . 'includes/plugin-options-framework/js/main.js', array( 'jquery' ) );
	wp_enqueue_style( 'dslc-plugin-options-css-admin', DS_LIVE_COMPOSER_URL . 'includes/plugin-options-framework/css/main.css');

} add_action( 'admin_init', 'dslc_load_admin_scripts' );


/**
 * Load Google Fonts
 *
 * @since 1.0
 */

function dslc_load_fonts() {

	wp_enqueue_style( 'dslc-gf-oswald', "//fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext" );
	wp_enqueue_style( 'dslc-gf-opensans', "//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" );
	wp_enqueue_style( 'dslc-gf-roboto', "//fonts.googleapis.com/css?family=Roboto:400,700" );
	wp_enqueue_style( 'dslc-gf-lato', "//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" );

} add_action( 'wp_enqueue_scripts', 'dslc_load_fonts' );