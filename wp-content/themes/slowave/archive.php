<?php 
	/**
	 * index.php
	 * The main post loop in Slowave
	 * @author TommusRhodus
	 * @package Slowave
	 * @since 1.0.0
	 */
	get_header(); 
	
	/**
	 * Get Wrapper Start Title - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','starttitle'); 
?>
    
      <h1 class="pull-left"><?php echo get_queried_object()->name; ?></h1>
      
      <div class="navigation pull-right"> 
      	<?php
      		previous_posts_link("<i class='icon-left-open-1'></i>" );
      		echo ' ';
      		next_posts_link("<i class='icon-right-open-1'></i>" ); 
      	?>
      </div>
    	
<?php 
	/**
	 * Get Wrapper End title - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','endtitle'); 
	
	/**
	 * Get Wrapper Start - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','start'); 
	
	get_template_part('loop/loop', get_option('blog_layout','bloggrid') ); 
	
	/**
	 * Get Wrapper End - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','end'); 
	
	get_footer();