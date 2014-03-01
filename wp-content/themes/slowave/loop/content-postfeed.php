<?php
	$format = get_post_format(); 
	if( false === $format ) 
		$format = 'standard';
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

  <?php get_template_part('postformats/format', $format); ?>
  
  <div class="post-content image-caption">
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
  
</div>