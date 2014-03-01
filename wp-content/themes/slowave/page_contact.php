<?php 
	/*
	Template Name: Contact
	*/
	
	/**
	 * page_contact.php
	 * The contact page template in Slowave
	 * @author TommusRhodus
	 * @package Slowave
	 * @since 1.0.0
	 */
	get_header(); 
	the_post();
	
	if( get_post_meta( $post->ID, '_ebor_disable_header', true ) !== 'on' )
		get_template_part('loop/content','pagetitle');
	
	if( get_post_meta( $post->ID, '_ebor_map_address', true ) ) 
		echo'<div class="map"></div>'; 
		
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
	
	if( get_post_meta( $post->ID, '_ebor_map_address', true ) ) : 
?>

	<script type="text/javascript">
		/*-----------------------------------------------------------------------------------*/
		/*	MAP
		/*-----------------------------------------------------------------------------------*/
		jQuery(document).ready(function($){
		'use strict';
		
			<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); $url = $url[0]; ?>
			jQuery('.map').goMap({ address: '<?php echo get_post_meta( $post->ID, '_ebor_map_address', true ); ?>',
			  zoom: 14,
			  mapTypeControl: false,
		      draggable: false,
		      scrollwheel: false,
		      streetViewControl: false,
		      maptype: 'ROADMAP',
	    	  markers: [
	    		{ 'address' : '<?php echo get_post_meta( $post->ID, '_ebor_map_address', true ); ?>' }
	    	  ],
			  icon: '<?php echo $url; ?>', 
				  addMarker: false
		});
		
		});
	</script>
		
<?php 
	endif; 
	
	get_footer();