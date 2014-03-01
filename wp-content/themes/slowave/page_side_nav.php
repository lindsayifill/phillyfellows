<?php 
	/*
	Template Name: Page Side Nav
	*/
	
	/**
	 * page_side_nav.php
	 * A page template with a selectable side navigation
	 * @author TommusRhodus
	 * @package Slowave
	 * @since 1.0.0
	 */
	get_header();
	the_post();
	
	if( get_post_meta( $post->ID, '_ebor_disable_header', true ) !== 'on' )
		get_template_part('loop/content','pagetitle');
			
	$items = wp_get_nav_menu_items( get_post_meta( $post->ID, '_ebor_side_menu',true) );
	
	/**
	 * Get Wrapper Start - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','start'); 
?>
    
  <div class="row classic-blog">
  
    <aside class="col-sm-4 sidebar left-sidebar">
      <div class="sidebox widget page-side-nav">
      
        <ul class="border-list">
        	<?php
        		foreach( $items as $item ){
        			echo '<li><a href="' . $item->url . '">'. $item->title .'</a></li>';
        		}
        	?>
        </ul>
        
      </div>
    </aside>
    
    <div class="col-sm-8 content lp30">
      <?php 
      	the_content(); 
      	wp_link_pages();
      ?>
    </div>
    
  </div><!-- /.row .classic-blog --> 
  
<?php 
	/**
	 * Get Wrapper End - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','end'); 
	
	get_footer();