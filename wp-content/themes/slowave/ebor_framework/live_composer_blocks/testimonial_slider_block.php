<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Testimonail_slider_Block" );')
);

class Slowave_Testimonail_slider_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Testimonail_slider_Block';
    var $module_title = 'Testimonial Slider';
    var $module_icon = 'quote-left';
    var $module_category = 'Slowave - Tabs';
 
 	// Module Options
    function options() { 
		
		// Get categories
		$cats = get_categories('taxonomy=dslc_testimonials_cats');
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
				'label' => 'Text Color',
				'id' => 'text_color',
				'std' => '#d9d9d9',
				'type' => 'color',
				'refresh_on_change' => true,
				'affect_on_change_el' => '.ebor-testimonial',
				'affect_on_change_rule' => 'color',
				'section' => 'styling'
			),
    		array(
    			'label' => 'Posts Amount',
    			'id' => 'amount',
    			'std' => '6',
    			'type' => 'text',
    		),
    		array(
    			'label' => 'Show Which Categories?',
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
			'post_type' => 'dslc_testimonials',
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
					'taxonomy' => 'dslc_testimonials_cats',
					'field' => 'id',
					'terms' => $terms,
					'operator' => 'IN',
				)
			);
		}

		// Do the query
		$block_query = new WP_Query( $args );
	?>	  
		    
		    <div id="testimonials" class="tab-container text-center">
		      <div class="panel-container">
		      
			    <?php 
			    	$i = 0;
			    	if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
			    	$i++;
			   ?>
			   
			   			<div id="tst<?php echo $i; ?>" class="ebor-testimonial"><?php echo get_the_content(); the_title('<span class="author">','</span>'); ?></div>
			   			
			   <?php 	
			    	endwhile;	
			    		
			    	endif;
			    	wp_reset_query();
			    ?>
			    
			 </div>
		     <ul class="etabs">
		     	<?php
		     		$i2 = 0;
		     		while( $i2++ < $i ){
		     			echo '<li class="tab"><a href="#tst'.$i2.'">'.$i2.'</a></li>';
		     		}
				?>
		     </ul>
		   </div>

	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}