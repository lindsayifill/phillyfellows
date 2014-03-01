<?php 
	/**
	 * 404.php
	 * The 404 template used in Slowave
	 * @author TommusRhodus
	 * @package Slowave
	 * @since 1.0.0
	 */
	get_header();
	the_post();
		
	/**
	 * Get Wrapper Start - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','start'); 
?>

	<div class="whoopsie-daisy-wrapper">
		<h1 class="whoopsie-daisy"><small><?php _e('Uh, Oh.','slowave'); ?></small><?php _e('404','slowave'); ?></h1>
		<a href="<?php echo home_url(); ?>"><?php _e('&larr; Head Home','slowave'); ?></a>
	</div>
  
<?php 
	/**
	 * Get Wrapper End - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','end'); 
	
	get_footer();