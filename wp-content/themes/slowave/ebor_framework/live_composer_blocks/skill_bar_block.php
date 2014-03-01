<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Skill_Bar_Block" );')
);

class Slowave_Skill_Bar_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Skill_Bar_Block';
    var $module_title = 'Skill Bar';
    var $module_icon = 'circle';
    var $module_category = 'Slowave - Elements';
 
 	// Module Options
    function options() { 
	
    	// The options array
    	$dslc_options = array(
			array(
				'label' => 'Content',
				'id' => 'content',
				'std' => '90',
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
		
		<ul class="progress-list">
		  <li>
		    <p>
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
		     <em>
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
 	
 				?>%
		     </em>
		    </p>
		    <div class="progress plain">
		      <div class="bar" style="width: <?php echo stripslashes( strip_tags( $options['content'] ) ); ?>%;"></div>
		    </div>
		  </li>
		</ul>
	
	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}