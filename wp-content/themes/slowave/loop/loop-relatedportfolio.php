<?php
	/**
	 * First, grab post terms.
	 */
	$terms = get_the_terms( $post->ID , 'dslc_projects_cats', 'string');
	
	/**
	 * Return if this post has no terms
	 */
	if(!( $terms ))
		return false;
	
	/**
	 * Now we know that we definitely have terms to work with, build and array of term id's
	 */	
	$term_ids = array_values( wp_list_pluck( $terms, 'term_id' ) );
	
	/**
	 * Build the related posts query based on what we've grabbed above
	 */
	$related_query = new WP_Query( 
		array(
		  'post_type' => 'dslc_projects',
		  'tax_query' => array(
	            array(
	                'taxonomy' => 'dslc_projects_cats',
	                'field' => 'id',
	                'terms' => $term_ids,
	                'operator'=> 'IN' //Or 'AND' or 'NOT IN'
	             )
	       ),
		  'posts_per_page' => 6,
		  'ignore_sticky_posts' => 1,
		  'orderby' => 'rand',
		  'post__not_in'=> array(
		  		$post->ID
		  )
	   ) 
	);
	
	if ( $related_query->have_posts() ) :
	
	/**
	 * Get Wrapper Start - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','start'); 
?>

    <div class="section-title text-center">
      <h2><?php echo get_option('portfolio_related_title', 'Related Works'); ?></h2>
      <span class="icon"><i class="icon-picons-diamond"></i></span> 
    </div>
    
    <div class="owl-portfolio owlcarousel carousel-th">
      
      <?php 
      	while ( $related_query->have_posts() ) : $related_query->the_post(); 
      	global $post;
      	
      	get_template_part('loop/content','carouselportfolio'); 
      	
        endwhile;
      ?>

    </div> 

<?php 
	/**
	 * Get Wrapper End - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','end'); 
	
	endif;
	wp_reset_query();