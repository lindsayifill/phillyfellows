<?php
	$format = get_post_format(); 
	if( false === $format ) 
		$format = 'standard';
?>

<div class="clear"></div>

<div id="post-<?php the_ID(); ?>" <?php post_class('post post-feed-alt'); ?>>
  
  <div class="post-content image-caption">
  	<?php if( has_post_thumbnail() ) : ?>
  		<div class="post-feed-alt-image">
  			<figure class="icon-overlay medium icn-link main">
	  			<a href="<?php the_permalink(); ?>">
	  				<?php the_post_thumbnail('index-square'); ?>
	  			</a>
  			</figure>
  		</div>
  	<?php endif; ?>
  	
  	<div class="post-feed-alt-details">
	    <?php 
	    	the_title('<h2 class="post-title"><a href="' . get_permalink() . '">','</a></h2>'); 
	    	get_template_part('loop/content','metapost'); 
	    	if(!( $format == 'quote' || $format == 'chat' )){
	    		the_excerpt(); 
	    		echo '<a href="'. get_permalink() .'" class="more">'. get_option('blog_continue', 'Continue Reading') .'</a>';
	    	} else {
	    		the_content();
	    	}
	    ?>
    </div>
    <div class="clear"></div>
  </div>
  
</div>