<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Text_Block" );')
);

class Slowave_Text_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Text_Block';
    var $module_title = 'Text & Icon';
    var $module_icon = 'font';
    var $module_category = 'Slowave - Text';
 
 	// Module Options
    function options() { 
		
		// Get categories
		$cats = ebor_picons();
		$cats_choices = array();

		// Generate usable array of categories
		foreach ( $cats as $cat ) {
			$cats_choices[] = array(
				'label' => str_replace('icon-picons-', '', $cat),
				'value' => $cat
			);
		}
				
    	// The options array
    	$dslc_options = array(
			array(
				'label' => 'Content',
				'id' => 'content',
				'std' => 'Click to edit. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
				'type' => 'textarea',
				'visibility' => 'hidden',
				'section' => 'styling'
			),
			array(
				'label' => 'Title',
				'id' => 'title',
				'std' => 'Click to Edit Title.',
				'type' => 'textarea',
				'visibility' => 'hidden',
				'section' => 'styling'
			),
			array(
				'label' => 'Icon',
				'id' => 'icon',
				'std' => 'icon-picons-star',
				'type' => 'select',
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
	?>
		
		<div class="divide20"></div>
		<div class="col-services">
	      <div class="icon"> 
	      <?php 
	              		        
			if ( $dslc_active ) {
				?><div class="dslca-editable-content" data-id="title"><?php
			}
			
				$output_content =  '<i class="'. $options["icon"] .' icn"></i>';
				echo $output_content;

			if ( $dslc_active ) {
				?></div><!-- .dslca-editable-content --><?php
			}

		  ?> 
	      </div>

	      <div class="text">
	        <h5 class="upper">
	        	<?php 
	        		        
					if ( $dslc_active ) {
						?><div class="dslca-editable-content" data-id="title"><?php
					}
					
						$output_content = stripslashes( strip_tags( $options['title'] ) );
						echo $output_content;
	
					if ( $dslc_active ) {
						?></div><!-- .dslca-editable-content --><?php
					}
	
				?>
	        </h5>
	        <?php 
	        
				if ( $dslc_active ) {
					?><div class="dslca-editable-content" data-id="content"><?php
				}
				
					$output_content = stripslashes( $options['content'] );
					$output_content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $output_content);
					$output_content = wpautop(do_shortcode( strip_tags($output_content) ));
					echo $output_content;

				if ( $dslc_active ) {
					?></div><!-- .dslca-editable-content --><?php
				}

			?>
	      </div>

	    </div>
	
	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}