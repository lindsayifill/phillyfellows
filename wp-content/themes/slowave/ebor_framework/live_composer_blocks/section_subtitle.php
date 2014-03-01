<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Section_Subtitle" );')
);

class Slowave_Section_Subtitle extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Section_Subtitle';
    var $module_title = 'Section Subtitle';
    var $module_icon = 'font';
    var $module_category = 'Slowave - Misc';
 
 	// Module Options
    function options() { 
				
    	// The options array
    	$dslc_options = array(
			array(
				'label' => 'Title',
				'id' => 'title',
				'std' => 'Click here to edit the title',
				'type' => 'textarea',
				'visibility' => 'hidden',
				'section' => 'styling'
			),
			array(
				'label' => 'Placed on Dark Background?',
				'id' => 'dark_bg',
				'std' => 'no',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => 'No',
						'value' => 'no'
					),
					array(
						'label' => 'Yes',
						'value' => 'yes'
					),
				)
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
	?>
	
	<?php 
		if( $options['dark_bg'] == 'yes' )
			echo '<div class="black-wrapper">'
	?>
		
		<div class="text-center">
        	<?php 
        			  	        		        
				if ( $dslc_active ) {
					?><div class="dslca-editable-content" data-id="title"><?php
				}
				
					$output_content = strip_tags( stripslashes( $options['title'] ) );
					echo '<p class="lead">' . strip_tags( $output_content ) . '</p>';

				if ( $dslc_active ) {
					?></div><!-- .dslca-editable-content --><?php
				}

			?>
		</div>
		<div class="divide30"></div>
	
	<?php 
		if( $options['dark_bg'] == 'yes' )
			echo '</div>'
	?>
	
	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}