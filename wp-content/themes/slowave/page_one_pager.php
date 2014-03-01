<?php
/*
Template Name: One Pager
*/

/**
 * page_one_pager.php
 * USed for a single page layout, where a scrolling menu is appropriate
 * @author TommusRhodus
 * @package Slowave
 * @since 1.0.0
 */
get_header();
the_post();

if( get_post_meta( $post->ID, '_ebor_disable_header', true ) !== 'on' )
	get_template_part('loop/content','pagetitle');

the_content();
get_footer('onepage');