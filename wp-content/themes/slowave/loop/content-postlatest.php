<div id="post-<?php the_ID(); ?>" class="post">

  <figure class="icon-overlay medium icn-link">
  	<a href="<?php the_permalink(); ?>">
  		<?php the_post_thumbnail('index-square'); ?>
  	</a>
  </figure>
  
  <div class="post-content">
    <?php 
    	the_title('<h3 class="post-title"><a href="' . get_permalink() . '">','</a></h3>'); 
    	get_template_part('loop/content','metapost'); 
    	the_excerpt(); 
    ?>
  </div>
</div>