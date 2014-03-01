<div id="team-<?php the_ID(); ?>">

	<div class="col-sm-5 rp20"> 
		<figure>
			<?php the_post_thumbnail('index'); ?>
		</figure> 
	</div>
	
	<div class="col-sm-7">
	  
	  <?php 
	    the_title('<h3><a href="'. get_permalink() .'">','</a></h3>');
	  	the_content(); 
	  ?>
	  <div class="divide10"></div>
	  
	  <?php get_template_part('loop/loop','social'); ?>
	  
	</div>
	
	<div class="clear divide40"></div>

</div>