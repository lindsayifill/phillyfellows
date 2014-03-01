<?php  
	$titles = get_post_meta( $post->ID, '_ebor_the_additional_title', true );
	$details = get_post_meta( $post->ID, '_ebor_the_additional_detail', true );
?>

<ul class="item-details">
	<?php
		if( get_post_meta( $post->ID, '_ebor_the_client_date', true ) && get_option('portfolio_date', '1') == 1 )
				echo '<li class="updated"><span>'.__('Date','slowave').':</span> '.get_post_meta( $post->ID, '_ebor_the_client_date', true ).'</li>';
	
		if( ebor_the_simple_terms() && get_option('portfolio_categories', '1') == 1 )
				echo '<li><span>'.__('Categories','slowave').':</span> '.ebor_the_simple_terms().'</li>';
	
		if( get_post_meta( $post->ID, '_ebor_the_client', true ) && get_option('portfolio_client', '1') == 1 )
				echo '<li><span>'.__('Client','slowave').':</span> '.get_post_meta( $post->ID, '_ebor_the_client', true ).'</li>';
	
		if( get_post_meta( $post->ID, '_ebor_the_client_url', true ) && get_option('portfolio_url', '1') == 1 )
				echo '<li><span>'.__('URL','slowave').':</span> <a href="'.esc_url(get_post_meta( $post->ID, '_ebor_the_client_url', true )).'" target="_blank">'.esc_url(get_post_meta( $post->ID, '_ebor_the_client_url', true )).'</a></li>';
	
		if( $titles ){
			foreach( $titles as $index => $title ){
				echo '<li><span>'.$title.':</span> '.$details[$index].'</li>';
			}
		}
	?>
</ul>