<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Portfolio_Block" );')
);

class Slowave_Portfolio_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Portfolio_Block';
    var $module_title = 'Portfolio';
    var $module_icon = 'th';
    var $module_category = 'Slowave - Feeds';
 
 	// Module Options
    function options() { 
		
		$filter_choice = '';
		$filter_choices[] = array(
			'label' => 'Hide Filters',
			'value' => 'none'
		);
		
		$pagination_choices = '';
		$pagination_choices[] = array(
			'label' => 'Hide Pagination',
			'value' => 'none'
		);
		$pagination_choices[] = array(
			'label' => 'Show Pagination',
			'value' => 'show'
		);
		
		// Get categories
		$cats = get_categories('taxonomy=dslc_projects_cats');
		$cats_choices = array();

		// Generate usable array of categories
		foreach ( $cats as $cat ) {
			$cats_choices[] = array(
				'label' => $cat->name,
				'value' => $cat->cat_ID
			);
			$filter_choices[] = array(
				'label' => $cat->name,
				'value' => $cat->cat_ID
			);
		}
		
    	// The options array
    	$dslc_options = array(
			
			array(
				'label' => 'Layout',
				'id' => 'layout',
				'std' => '4',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '4 columns',
						'value' => '4'
					),
					array(
						'label' => '3 columns',
						'value' => '3'
					),
				)
			),
    		array(
    			'label' => 'Posts Per Page',
    			'id' => 'amount',
    			'std' => '12',
    			'type' => 'text',
    		),
    		array(
    			'label' => 'Hide Pagination Buttons? (Recommended if used in page with other content)',
    			'id' => 'pagination',
    			'std' => 'show',
    			'type' => 'select',
    			'choices' => $pagination_choices
    		),
    		array(
    			'label' => 'Show Which Categories?',
    			'id' => 'categories',
    			'std' => '',
    			'type' => 'checkbox',
    			'choices' => $cats_choices
    		),
    		array(
    			'label' => 'Show Which Filters?',
    			'id' => 'filters',
    			'std' => '',
    			'type' => 'checkbox',
    			'choices' => $filter_choices
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
		
		// Fix for pagination
		if( is_front_page() ) { $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; } else { $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; }
		
		// General args
		$args = array(
			'paged' => $paged, 
			'post_type' => 'dslc_projects',
			'posts_per_page' => $options['amount'],
			'order' => $options['order'],
			'orderby' => $options['orderby'],
			'offset' => $options['offset']
		);

		// Category args
		if ( isset( $options['categories'] ) && $options['categories'] !== '' ) {
			$terms = explode( ' ', $options['categories']);
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'dslc_projects_cats',
					'field' => 'id',
					'terms' => $terms,
					'operator' => 'IN',
				)
			);
		}

		// Do the query
		$block_query = new WP_Query( $args );
	?>
    	
		<div class="portfolio">
			
		<?php
				if( $options['filters'] == 'none ' ){
					//nothing
				} else {
				
					$filters = get_categories('taxonomy=dslc_projects_cats');
					
					echo '<ul class="filter"><li><a class="active" href="#" data-filter="*">All</a></li>';
						foreach( $filters as $filter ){
							$terms = explode( ' ', $options['filters']);
							if(!( in_array( $filter->term_id, $terms) ) && trim($options['filters']) !== '' )
								continue;
								
							echo '<li><a href="#" data-filter=".'.$filter->slug.'">' . $filter->name . '</a></li>';
						}
					echo '</ul>';
					
				}
		?>
		  
		  <!--4 for 4 cols, 3 for 3 cols-->
		  <ul class="items col<?php echo $options['layout']; ?>">
		    
		    <?php 
		    	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		    		
		    		/**
		    		 * Get blog posts by blog layout.
		    		 */
		    		get_template_part('loop/content', 'portfolio');
		    	
		    	endwhile;	
		    	else : 
		    		
		    		/**
		    		 * Display no posts message if none are found.
		    		 */
		    		get_template_part('loop/content','none');
		    		
		    	endif;
		    ?>
		    
		  </ul>
		  
		  <?php
		  	/**
		  	 * Post pagination, use ebor_pagination() first and fall back to default
		  	 */
		  	if( $options['pagination'] !== 'none' )
		  		echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
		  	wp_reset_query();
		  ?>
		  
		</div>
		
	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}