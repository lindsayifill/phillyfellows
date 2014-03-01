<?php 

echo ( is_active_sidebar('primary') && get_option('index_sidebar','1') == '1' ) ? '<div class="row"><div class="col-sm-8 content"><div class="grid-blog col2">' : '<div class="grid-blog col3">';

if ( have_posts() ) : while ( have_posts() ) : the_post();
	
	/**
	 * Get blog posts by blog layout.
	 */
	get_template_part('loop/content', 'postgrid');

endwhile;	
else : 
	
	/**
	 * Display no posts message if none are found.
	 */
	get_template_part('loop/content','none');
	
endif;

if( is_active_sidebar('primary') && get_option('index_sidebar','1') == '1' ){
	echo '</div></div>';
	get_sidebar();
}

echo '</div>';

/**
 * Post pagination, use ebor_pagination() first and fall back to default
 */
echo function_exists('ebor_pagination') ? ebor_pagination() : posts_nav_link();