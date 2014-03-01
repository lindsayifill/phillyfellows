<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Image_Block" );')
);

class Slowave_Image_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Image_Block';
    var $module_title = 'Image';
    var $module_icon = 'instagram';
    var $module_category = 'Slowave - Elements';
 
 	// Module Options
    function options() { 
				
    	// The options array
    	$dslc_options = array(
			array(
				'label' => 'Image',
				'id' => 'image',
				'std' => 'http://placehold.it/1170x400',
				'type' => 'image',
				'section' => 'styling'
			),
			array(
				'label' => 'Image Alt Text',
				'id' => 'alt',
				'std' => 'alt-text',
				'type' => 'text',
				'section' => 'styling'
			),
			array(
				'label' => 'Additional Image Classes',
				'id' => 'class',
				'std' => '',
				'type' => 'text',
				'section' => 'styling'
			),
			array(
				'label' => 'Link Image? Enter Destination URL here.',
				'id' => 'link',
				'std' => '',
				'type' => 'text',
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
			
			if( $options['link'] !== '' )
				echo '<figure class="icon-overlay medium icn-link"><a href="'. esc_url($options['link']) .'">';
			
			if( $options['image'] !== '' )
				echo '<img src="' . $options['image'] . '" alt="' . $options['alt'] . '" class="' . $options['class'] . '" />';
			
			if( $options['link'] !== '' )
				echo '</a></figure>';

    	// REQUIRED
    	$this->module_end( $options );

    }
 
}