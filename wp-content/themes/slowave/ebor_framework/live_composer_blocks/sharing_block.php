<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Sharing_Block" );')
);

class Slowave_Sharing_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Sharing_Block';
    var $module_title = 'Sharing Buttons';
    var $module_icon = 'twitter';
    var $module_category = 'Slowave - Misc';
 
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
    			'label' => 'Categories',
    			'id' => 'categories',
    			'std' => '',
    			'type' => 'checkbox',
    			'choices' => $cats_choices
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
		
		//REQUIRED
		$this->module_start( $options );
			
			get_template_part('loop/content','sharing');

    	// REQUIRED
    	$this->module_end( $options );

    }
 
}