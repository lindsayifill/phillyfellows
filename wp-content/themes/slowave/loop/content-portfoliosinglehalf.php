<?php 
	$format = get_post_format(); 
	if( false === $format ) 
		$format = 'standard';
?>
      
<div class="row">

  <div class="col-sm-8">
  
    <?php get_template_part('postformats/format', $format); ?>
    
  </div><!-- /.col-sm-8 -->
  
  <div class="col-sm-4 lp30">
  
    <?php 
    	the_content();
    	wp_link_pages();
    ?>
    
    <div class="divide5"></div>
    
    <?php 
    	if( get_post_meta( $post->ID, '_ebor_portfolio_post_meta', true ) !=='on' )
    		get_template_part('loop/content','metaportfolio'); 
    ?>
    
  </div><!-- /.col-sm-4 --> 
  
</div><!-- /.row --> 