<div id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
	
	<?php
		if( has_post_thumbnail() ){
			echo '<figure class="icon-overlay medium icn-link"><a href="'. get_permalink() .'">';
			the_post_thumbnail('index');
			echo '</a></figure>';
		}
	?>
	
	<div class="image-caption">
	
		<?php 
			the_title('<h3 class="post-title"><a href="' . get_permalink() . '">','</a></h3>'); 
			get_template_part('loop/content','metapost'); 
			the_excerpt(); 
		?>
	
	</div>
  
</div>