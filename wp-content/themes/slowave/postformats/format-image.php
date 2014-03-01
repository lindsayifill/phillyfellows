<?php 
	global $post;
	
	$attachments = get_post_meta( $post->ID, '_ebor_gallery_list', true );
	
	if ( $attachments ){ 
		
		if( get_post_type() == 'dslc_projects' ){
  			foreach ( $attachments as $attachment ){
  				echo '<figure><img src="'.$attachment.'" alt="'.get_the_title().'" /></figure><div class="divide30"></div>';
  			}
  		} else {
  			foreach ( $attachments as $attachment ){
  				echo '<figure class="icon-overlay medium icn-link main">
  						<a href="'.get_permalink().'">
  							<img src="'.$attachment.'" alt="'.get_the_title().'" />
  						</a>
  					  </figure>';
  			}
  		}

	}