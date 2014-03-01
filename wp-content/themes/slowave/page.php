<?php 

/**
 * page.php
 * The standard page template in Slowave
 * @author TommusRhodus
 * @package Slowave
 * @since 1.0.0
 */
get_header();
the_post();

if( get_post_meta( $post->ID, '_ebor_disable_header', true ) !== 'on' )
	get_template_part('loop/content','pagetitle');
	
/**
 * Get Wrapper Start - Uses get_template_part for simple child themeing.
 */
get_template_part('inc/wrapper','start'); 

the_content();
wp_link_pages();

/**
 * Get Wrapper End - Uses get_template_part for simple child themeing.
 */
get_template_part('inc/wrapper','end'); 

get_footer();