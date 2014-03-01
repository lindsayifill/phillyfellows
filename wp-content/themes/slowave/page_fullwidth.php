<?php
/*
Template Name: Full Width Template
*/

/**
 * page_fullwidth.php
 * Used mainly for the page builder
 * @author TommusRhodus
 * @package Slowave
 * @since 1.0.0
 */
get_header();
the_post();

if( get_post_meta( $post->ID, '_ebor_disable_header', true ) !== 'on' )
	get_template_part('loop/content','pagetitle');

the_content();
get_footer();