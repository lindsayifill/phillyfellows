<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Alert_Block" );')
);

class Slowave_Alert_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Alert_Block';
    var $module_title = 'Alert Bar';
    var $module_icon = 'exclamation-sign';
    var $module_category = 'Slowave - Elements';
 
 	// Module Options
    function options() { 
		
		// Get categories
		$cats = array(
			array(
				'label' => 'Standard Alert',
				'value' => 'standard'
			),
			array(
				'label' => 'Alert with Dismiss',
				'value' => 'dismiss'
			),
		);

		$types = array(
			array(
				'label' => 'Standard',
				'value' => 'alert-warning'
			),
			array(
				'label' => 'Error',
				'value' => 'alert-danger'
			),
			array(
				'label' => 'Success',
				'value' => 'alert-success'
			),
			array(
				'label' => 'Info',
				'value' => 'alert-info'
			),
		);
	
    	// The options array
    	$dslc_options = array(
			array(
				'label' => 'Content',
				'id' => 'content',
				'std' => 'Click to edit content',
				'type' => 'textarea',
				'visibility' => 'hidden',
				'section' => 'styling'
			),
			array(
				'label' => 'Title',
				'id' => 'title',
				'std' => 'Click to Edit Title',
				'type' => 'textarea',
				'visibility' => 'hidden',
				'section' => 'styling'
			),
			array(
				'label' => 'Alert Type',
				'id' => 'type',
				'std' => 'standard',
				'type' => 'select',
				'choices' => $cats
			),
			array(
				'label' => 'Alert Appearance',
				'id' => 'appearance',
				'std' => 'alert-warning',
				'type' => 'select',
				'choices' => $types
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

			<div class="alert <?php echo $options['appearance']; ?>">
				<?php if( $options['type'] == 'dismiss' ) : ?>
					<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php endif; ?>
					<strong>
						<?php 
						        		        
							if ( $dslc_active ) {
								?><span class="dslca-editable-content" data-id="title"><?php
							}
							
								$output_content = stripslashes( strip_tags( $options['title'] ) );
								echo $output_content;
			
							if ( $dslc_active ) {
								?></span><!-- .dslca-editable-content --><?php
							}
			
						?>
					</strong>
				<?php 
					        
					if ( $dslc_active ) {
						?><span class="dslca-editable-content" data-id="content"><?php
					}
					
						$output_content = stripslashes( strip_tags( $options['content'] ) );
						$output_content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $output_content);
						echo $output_content;
	
					if ( $dslc_active ) {
						?></span><!-- .dslca-editable-content --><?php
					}
	
				?>
			</div>
	
	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}