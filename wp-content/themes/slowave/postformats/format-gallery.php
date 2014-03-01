<?php 
	global $post;
	
	$attachments = get_post_meta( $post->ID, '_ebor_gallery_list', true );
	
	if ( $attachments ) : 
?>

	<div class="owl-slider-wrapper">
	  <div class="owl-portfolio-slider owl-carousel">
	  		
	  		<?php 
	  			foreach ( $attachments as $attachment ){
	  				echo '<div class="item"><img src="'.$attachment.'" alt="'.get_the_title().'"/></div>';
	  			}
	  		?>
	    
	  </div>
	  <div class="owl-custom-nav"> <a class="slider-prev"></a> <a class="slider-next"></a> </div>
	</div>

<?php 
	endif;
?>