<?php 
	/*
	Template Name: Page With Sidebar
	*/
	
	/**
	 * page_sidebar.php
	 * A page template with a sidebar
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
?>
		
	<div class="row">
	
	  <div class="col-sm-8 content">
		<?php 
			the_content(); 
			wp_link_pages();
		?>
	  </div>
	  
	  <?php get_sidebar('page'); ?>
	  
	</div>
  
<?php 
	/**
	 * Get Wrapper End - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','end'); 
	
	get_footer();