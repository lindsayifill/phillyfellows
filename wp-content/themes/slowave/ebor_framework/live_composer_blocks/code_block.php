<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Code_Block" );')
);

class Slowave_Code_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Code_Block';
    var $module_title = 'Code';
    var $module_icon = 'code';
    var $module_category = 'Slowave - Misc';
 
 	// Module Options
    function options() { 
		
				
    	// The options array
    	$dslc_options = array(
			array(
				'label' => 'Content',
				'id' => 'content',
				'std' => 'Visit Settings (Click on Cog Icon) to add your code',
				'type' => 'textarea',
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
		
		<h3>
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
		</h3>
<pre class="prettyprint linenums">
<?php 
$content = stripcslashes( $options['content'] );
echo htmlspecialchars( $content );
?>
</pre>
	
	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}