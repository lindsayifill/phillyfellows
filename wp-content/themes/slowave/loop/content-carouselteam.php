<div id="team-<?php the_ID(); ?>" class="item">
  
  <?php if( has_post_thumbnail() ) : ?>
	  <figure class="icon-overlay medium icn-more"> 
	  	<a href="<?php echo the_permalink(); ?>">
	  		<?php the_post_thumbnail('index'); ?>
	  	</a>
	  </figure>
  <?php endif; ?>
  
  <div class="image-caption">
    <?php the_title('<h3><a href="'. get_permalink() .'">','</a></h3>'); ?>
    <span class="meta"><?php echo get_post_meta( $post->ID, '_ebor_the_job_title', true ); ?></span>
    <?php 
    	echo wpautop(wp_trim_words(get_the_excerpt(), 15)); 
    	get_template_part('loop/loop','social');
    ?>
  </div>
</div>