<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Blog_Carousel_Block" );')
);

class Slowave_Blog_Carousel_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Blog_Carousel_Block';
    var $module_title = 'Blog Carousel';
    var $module_icon = 'circle';
    var $module_category = 'Slowave - Carousels';
 
 	// Module Options
    function options() { 
		
		// Get categories
		$cats = get_categories();
		$cats_choices = array();

		// Generate usable array of categories
		foreach ( $cats as $cat ) {
			$cats_choices[] = array(
				'label' => $cat->name,
				'value' => $cat->cat_ID
			);
		}
		
		
    	// The options array
    	$dslc_options = array(

    		array(
    			'label' => 'Posts Per Page',
    			'id' => 'amount',
    			'std' => '6',
    			'type' => 'text',
    		),
    		array(
    			'label' => 'Categories',
    			'id' => 'categories',
    			'std' => '',
    			'type' => 'checkbox',
    			'choices' => $cats_choices
    		),
    		array(
    			'label' => 'Order By',
    			'id' => 'orderby',
    			'std' => 'date',
    			'type' => 'select',
    			'choices' => array(
    				array(
    					'label' => 'Publish Date',
    					'value' => 'date'
    				),
    				array(
    					'label' => 'Modified Date',
    					'value' => 'modified'
    				),
    				array(
    					'label' => 'Random',
    					'value' => 'rand'
    				),
    				array(
    					'label' => 'Alphabetic',
    					'value' => 'title'
    				),
    				array(
    					'label' => 'Comment Count',
    					'value' => 'comment_count'
    				),
    			)
    		),
    		array(
    			'label' => 'Order',
    			'id' => 'order',
    			'std' => 'DESC',
    			'type' => 'select',
    			'choices' => array(
    				array(
    					'label' => 'Ascending',
    					'value' => 'ASC'
    				),
    				array(
    					'label' => 'Descending',
    					'value' => 'DESC'
    				)
    			)
    		),
    		array(
    			'label' => 'Offset',
    			'id' => 'offset',
    			'std' => '0',
    			'type' => 'text',
    		),

    	);

    	// Return the array
    	return apply_filters( 'dslc_module_options', $dslc_options, $this->module_id );

    }
 
 	// Module Output
    function output( $options ) {

    	global $dslc_active;
    	
		if ( $dslc_active && is_user_logged_in() && current_user_can( DS_LIVE_COMPOSER_CAPABILITY ) )
			$dslc_is_admin = true;
		else
			$dslc_is_admin = false;

		$this->module_start( $options );
		
		// General args
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $options['amount'],
			'order' => $options['order'],
			'orderby' => $options['orderby'],
			'offset' => $options['offset']
		);

		// Category args
		if ( isset( $options['categories'] ) && $options['categories'] != '' ) {
			$cats_array = explode( ' ', $options['categories']);
			$args['category__in'] = $cats_array;
		}

		// Do the query
		$block_query = new WP_Query( $args );
    	
		//CONTENT START
		echo '<div class="divide30"></div><div class="owl-blog owlcarousel carousel-th">';
			
		if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
			
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
		wp_reset_query();
		
		echo '</div>';

    	// REQUIRED
    	$this->module_end( $options );

    }
 
}