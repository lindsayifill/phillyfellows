<?php
	if( get_option('portfolio_link','lightbox') == 'lightbox' ){
	
		$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		$before_thumbnail = '<figure class="icon-overlay medium icn-more"><a href="'. $url[0] .'" class="fancybox-media" data-rel="portfolio">';
		$after_thumbnail = '</a></figure>';
		
	} else {
	
		$before_thumbnail = '<figure class="icon-overlay medium icn-link"><a href="'. get_permalink() .'">';
		$after_thumbnail = '</a></figure>';
	
	}
?>

<li id="portfolio-<?php the_ID(); ?>" <?php post_class('item ' . ebor_the_isotope_terms() ); ?>>

	<?php 
		echo $before_thumbnail;
		the_post_thumbnail('index'); 
		echo $after_thumbnail;
	?>
	
	<div class="image-caption">
		<?php 
			the_title('<h3><a href="'. get_permalink() .'">','</a></h3>'); 
			
			if( get_option('portfolio_index_categories', '1') == 1 )
				echo '<span class="meta">'. ebor_the_simple_terms() .'</span>';
		?>
	</div>
    
</li>