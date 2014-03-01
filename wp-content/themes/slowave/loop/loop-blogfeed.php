<?php 
	if ( is_active_sidebar('primary') && get_option('index_sidebar','1') == '1' ){
		echo '<div class="row"><div class="col-sm-8 content"><div class="classic-blog">';
	} else {
		echo '<div class="classic-blog">';
	}
?>

  <div class="classic-blog">
  
  <?php
  	if ( have_posts() ) : while ( have_posts() ) : the_post();
  		
  		/**
  		 * Get blog posts by blog layout.
  		 */
  		get_template_part('loop/content', 'postfeed');
  	
  	endwhile;	
  	else : 
  		
  		/**
  		 * Display no posts message if none are found.
  		 */
  		get_template_part('loop/content','none');
  		
  	endif;
  ?>
  
  </div>

<?php 
	if ( is_active_sidebar('primary') && get_option('index_sidebar','1') == '1' ){
		echo '</div></div>';
		get_sidebar();
		echo '</div>';
	} else {
		echo '</div>';
	}