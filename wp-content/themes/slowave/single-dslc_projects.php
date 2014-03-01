<?php
	/**
	 * single-dslc_projects.php
	 * The single projects post template in Slowave
	 * @author TommusRhodus
	 * @package Slowave
	 * @since 1.0.0
	 */
	get_header(); 
	the_post();
	
	$layout = get_post_meta( $post->ID, '_ebor_layout_checkbox', true );
	if( $layout == '-1' || $layout == 'on' )
		$layout == 'full';
		
	/**
	 * Get Wrapper Start Title - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','starttitle'); 

    the_title('<h1 class="pull-left entry-title">','</h1>');
    
    get_template_part('loop/content','postnav'); 
      	
    /**
     * Get Wrapper End title - Uses get_template_part for simple child themeing.
     */
    get_template_part('inc/wrapper','endtitle'); 	
?>
  
  <div class="dark-wrapper">
    
       <?php
       		if(!( $layout == 'wide' ))
       			echo '<div class="container inner">';
       			
       		get_template_part('loop/content','portfoliosingle' . $layout); 
       		
       		if(!( $layout == 'wide' ))
       			echo '</div>';
       ?>
       
  </div><!-- /.dark-wrapper -->

<?php 
	if( get_option('portfolio_share','1') == 1 )
		get_template_part('loop/content','shareportfolio');
	
	if( get_option('portfolio_related','1') == 1 )
		get_template_part('loop/loop','relatedportfolio');
	
	get_footer(); 