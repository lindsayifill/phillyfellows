<?php 
	/**
	 * archive-dslc_projects.php
	 * The project archive used in Slowave
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

      <h1><?php echo get_option('Portfolio Title','Our Portfolio'); ?></h1>

<?php 
	/**
	 * Get Wrapper End title - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','endtitle'); 
	
	/**
	 * Get Wrapper Start - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','start'); 
?>

  <div class="portfolio">
  
    <?php get_template_part('loop','loop/filters'); ?>
    
    <ul class="items col<?php get_option('portfolio_layout','4'); ?>">
      
		<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				
				/**
				 * Get portfolio posts by portfolio layout.
				 */
				get_template_part('loop/content', 'portfolio');
			
			endwhile;	
			else : 
				
				/**
				 * Display no posts message if none are found.
				 */
				get_template_part('loop/content','none');
				
			endif;
		?>
      
    </ul>
    
  </div><!-- /.portfolio --> 
  
<?php 
	/**
	 * Get Wrapper End - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','end'); 
	
	get_footer();