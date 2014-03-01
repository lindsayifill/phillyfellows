<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Video_Block" );')
);

class Slowave_Video_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Video_Block';
    var $module_title = 'Video';
    var $module_icon = 'film';
    var $module_category = 'Slowave - Elements';
 
 	// Module Options
    function options() { 
				
    	// The options array
    	$dslc_options = array(
			array(
				'label' => 'Video URL',
				'id' => 'title',
				'std' => 'http://vimeo.com/24496773',
				'type' => 'textarea',
				'section' => 'styling'
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

		  	if( $dslc_active ){
		  		echo '<div class="text-center"><h3 class="text-center">' . $options['title'] . '</h3> -> Will be converted to a video when out of editor view.</div>';
		  	} else {
		  		echo apply_filters('the_content', esc_url($options['title']) ); 
		  	}

    	// REQUIRED
    	$this->module_end( $options );

    }
 
}