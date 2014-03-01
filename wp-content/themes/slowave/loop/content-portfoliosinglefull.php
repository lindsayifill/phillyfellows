<?php 
	$format = get_post_format(); 
	if( false === $format ) 
		$format = 'standard';
		
	get_template_part('postformats/format', $format); 
?>

<div class="row">
	
	<?php 
		if( get_post_meta( $post->ID, '_ebor_portfolio_post_meta', true ) !=='on' ){
			echo '<div class="col-sm-8">';
		} else {
			echo '<div class="col-sm-12">';
		}
	
	  	the_content();
	  	wp_link_pages();
	
		if( get_post_meta( $post->ID, '_ebor_portfolio_post_meta', true ) !=='on' ){
			echo '</div><div class="col-sm-4 lp30 tp30">';
			get_template_part('loop/content','metaportfolio');
		}
	?>
	
	</div><!--.col-sm-x-->

</div><!-- /.row -->