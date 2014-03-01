<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Call_To_Action_Block" );')
);

class Slowave_Call_To_Action_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Call_To_Action_Block';
    var $module_title = 'Call To Action';
    var $module_icon = 'hand-right';
    var $module_category = 'Slowave - Elements';
 
 	// Module Options
    function options() { 
				
    	// The options array
    	$dslc_options = array(
			array(
				'label' => 'Content',
				'id' => 'content',
				'std' => 'Click to edit this content',
				'type' => 'textarea',
				'visibility' => 'hidden',
				'section' => 'styling'
			),
			array(
				'label' => 'Button Text',
				'id' => 'title',
				'std' => 'Hire Us',
				'type' => 'text',
				'section' => 'styling'
			),
			array(
				'label' => 'Button Link',
				'id' => 'link',
				'std' => 'http://www.google.com',
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
	?>
		
		<div class="text-center ebor-call-to-action">
		  <div class="thin">
		    <p class="lead">
		    <?php 
		    	        
				if ( $dslc_active ) {
					?><div class="dslca-editable-content" data-id="content"><?php
				}
				
					$output_content = stripslashes( strip_tags( $options['content'] ) );
					$output_content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $output_content);
					$output_content = do_shortcode( $output_content );
					echo $output_content;

				if ( $dslc_active ) {
					?></div><!-- .dslca-editable-content --><?php
				}

			?>
		    </p>
		    <a href="<?php echo esc_url( $options['link'] ); ?>" class="btn bm0"><?php echo stripslashes($options['title']); ?></a> </div>
		</div>
	
	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}