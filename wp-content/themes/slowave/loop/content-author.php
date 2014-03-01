<div class="divide50"></div>
<div class="about-author image-caption">
  <div class="author-image">
  	<?php echo get_avatar( get_the_author_meta('email'), 120 ); ?>
  </div>
  <div class="author-details vcard author">
    <h3><?php echo get_option('author_details_title','About the author'); ?></h3>
    <?php 
    	printf(wpautop( '<span class="fn">%s</span>: %s' ), get_the_author(), get_the_author_meta('description')); 
    	get_template_part('loop/loop', 'social');	
    ?>
  </div>
  <div class="clearfix"></div>
</div>