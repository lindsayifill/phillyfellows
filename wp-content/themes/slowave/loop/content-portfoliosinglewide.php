<?php 
	$format = get_post_format(); 
	if( false === $format ) 
		$format = 'standard';
		
	get_template_part('postformats/format', $format); 
?>
      
<div class="divide30"></div>
<div class="container inner tp0">

	<div class="row">
		
		<?php if( get_post_meta( $post->ID, '_ebor_portfolio_post_meta', true ) !=='on' ) : ?>
			<div class="col-sm-8">
		<?php endif; ?>
		
			  <?php 
			  	the_content();
			  	wp_link_pages();
			  ?>
		
		<?php if( get_post_meta( $post->ID, '_ebor_portfolio_post_meta', true ) !=='on' ) : ?>
			</div>
			
			<div class="col-sm-4 lp30 tp30">
			  <?php get_template_part('loop/content','metaportfolio'); ?>
			</div>
		<?php endif; ?>
	
	</div><!-- /.row -->

</div>