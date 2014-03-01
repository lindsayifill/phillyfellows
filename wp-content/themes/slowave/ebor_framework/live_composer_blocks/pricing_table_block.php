<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Pricing_Table_Block" );')
);

class Slowave_Pricing_Table_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Pricing_Table_Block';
    var $module_title = 'Pricing Table';
    var $module_icon = 'dollar';
    var $module_category = 'Slowave - Elements';
 
 	// Module Options
    function options() { 
		
				
    	// The options array
    	$dslc_options = array(
			array(
				'label' => 'Content',
				'id' => 'content',
				'std' => 'Visit Settings To Add Feature Lines. Hit Return Key To Start New Feature.',
				'type' => 'textarea',
				'section' => 'styling'
			),
			array(
				'label' => 'Button Link URL',
				'id' => 'button_link',
				'std' => '#',
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
			array(
				'label' => 'Currency',
				'id' => 'currency',
				'std' => '$',
				'type' => 'textarea',
				'visibility' => 'hidden',
				'section' => 'styling'
			),
			array(
				'label' => 'Price',
				'id' => 'price',
				'std' => '20',
				'type' => 'textarea',
				'visibility' => 'hidden',
				'section' => 'styling'
			),
			array(
				'label' => 'Button Text',
				'id' => 'buttontext',
				'std' => 'Select Plan',
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
	?>
		
		<div class="pricing plan">
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
		  <h4>
		  	<span class="amount">
		  		<span>
		  			<?php 
		  			    				  	        		        
						if ( $dslc_active ) {
							?><div class="dslca-editable-content" data-id="currency" style="display: inline;"><?php
						}
						
							$output_content = stripslashes( strip_tags( $options['currency'] ) );
							echo $output_content;
		
						if ( $dslc_active ) {
							?></div><!-- .dslca-editable-content --><?php
						}
		
					?>
		  		</span>
		  		<?php 
		  		    				  	        		        
					if ( $dslc_active ) {
						?><div class="dslca-editable-content" data-id="price" style="display: inline;"><?php
					}
					
						$output_content = stripslashes( strip_tags( $options['price'] ) );
						echo $output_content;
	
					if ( $dslc_active ) {
						?></div><!-- .dslca-editable-content --><?php
					}
	
				?>
		  	</span>
		  </h4>
		  <div class="features">
		  	<ul>
		  		<?php 
					$content = stripcslashes( $options['content'] );
					$items = preg_split( '/\r\n|\r|\n/', $content );

					$output = '';
					foreach($items as $item){
					   	  
					   $output .= '<li>' . htmlspecialchars_decode( $item ) . '</li>';
					   
					}
					
					echo $output;
				?>
		   </ul>
		  </div>
		  <div class="select">
		    <div> 
		    	<a href="<?php echo esc_url( $options['button_link'] ); ?>" class="btn inverse">
		    	<?php
					$output_content = stripslashes( $options['buttontext'] );
					echo $output_content;
				?>
				</a>
		    </div>
		  </div>
		</div>
	
	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}