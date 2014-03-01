<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Services_Block" );')
);

class Slowave_Services_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Services_Block';
    var $module_title = 'Animated Services';
    var $module_icon = 'circle';
    var $module_category = 'Slowave - Tabs';
 
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
    			'label' => 'Tab Icon',
    			'id' => 'icon1',
    			'std' => 'icon-picons-bulb',
    			'type' => 'select',
    			'choices' => $cats_choices,
    			'section' => 'styling',
    			'tab' => 'Tab 1'
    		),
    		array(
    			'label' => 'Tab Title',
    			'id' => 'title1',
    			'std' => 'Creative Ideas',
    			'type' => 'text',
    			'section' => 'styling',
    			'tab' => 'Tab 1'
    		),
    		array(
    			'label' => 'Main Title',
    			'id' => 'maintitle1',
    			'std' => '<span class="colored">Creativity</span> is important for us',
    			'type' => 'textarea',
    			'section' => 'styling',
    			'tab' => 'Tab 1'
    		),
			array(
				'label' => 'Main Content',
				'id' => 'content1',
				'std' => 'Donec ullamcorper nulla non metus auctor fringilla. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec ullamcorper nulla non metus auctor fringilla. Curabitur blandit tempus porttitor.',
				'type' => 'textarea',
				'section' => 'styling',
				'tab' => 'Tab 1'
			),
			array(
				'label' => 'Tab Icon',
				'id' => 'icon2',
				'std' => 'icon-picons-rocket',
				'type' => 'select',
				'choices' => $cats_choices,
				'section' => 'styling',
				'tab' => 'Tab 2'
			),
			array(
				'label' => 'Tab Title',
				'id' => 'title2',
				'std' => 'Rapid Solutions',
				'type' => 'text',
				'section' => 'styling',
				'tab' => 'Tab 2'
			),
			array(
				'label' => 'Main Title',
				'id' => 'maintitle2',
				'std' => 'We Bring <span class="colored">Rapid Solutions</span>',
				'type' => 'textarea',
				'section' => 'styling',
				'tab' => 'Tab 2'
			),
			array(
				'label' => 'Main Content',
				'id' => 'content2',
				'std' => 'Donec ullamcorper nulla non metus auctor fringilla. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec ullamcorper nulla non metus auctor fringilla. Curabitur blandit tempus porttitor.',
				'type' => 'textarea',
				'section' => 'styling',
				'tab' => 'Tab 2'
			),
			array(
				'label' => 'Tab Icon',
				'id' => 'icon3',
				'std' => 'icon-picons-lab',
				'type' => 'select',
				'choices' => $cats_choices,
				'section' => 'styling',
				'tab' => 'Tab 3'
			),
			array(
				'label' => 'Tab Title',
				'id' => 'title3',
				'std' => 'Magic Touch',
				'type' => 'text',
				'section' => 'styling',
				'tab' => 'Tab 3'
			),
			array(
				'label' => 'Main Title',
				'id' => 'maintitle3',
				'std' => '<span class="colored">Magic Touch</span> is the key',
				'type' => 'textarea',
				'section' => 'styling',
				'tab' => 'Tab 3'
			),
			array(
				'label' => 'Main Content',
				'id' => 'content3',
				'std' => 'Donec ullamcorper nulla non metus auctor fringilla. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec ullamcorper nulla non metus auctor fringilla. Curabitur blandit tempus porttitor.',
				'type' => 'textarea',
				'section' => 'styling',
				'tab' => 'Tab 3'
			),
			array(
				'label' => 'Tab Icon',
				'id' => 'icon4',
				'std' => 'icon-picons-award',
				'type' => 'select',
				'choices' => $cats_choices,
				'section' => 'styling',
				'tab' => 'Tab 4'
			),
			array(
				'label' => 'Tab Title',
				'id' => 'title4',
				'std' => 'Award Winning',
				'type' => 'text',
				'section' => 'styling',
				'tab' => 'Tab 4'
			),
			array(
				'label' => 'Main Title',
				'id' => 'maintitle4',
				'std' => 'Our designs won <span class="colored">many awards</span>',
				'type' => 'textarea',
				'section' => 'styling',
				'tab' => 'Tab 4'
			),
			array(
				'label' => 'Main Content',
				'id' => 'content4',
				'std' => 'Donec ullamcorper nulla non metus auctor fringilla. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec ullamcorper nulla non metus auctor fringilla. Curabitur blandit tempus porttitor.',
				'type' => 'textarea',
				'section' => 'styling',
				'tab' => 'Tab 4'
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
		
		if ( $dslc_active )
			echo '<h3 class="text-center">Visit the settings for this block to edit all content<br /><small>This message will disappear after leaving edit mode.</small></h3><div class="divide30"></div>';
	?>
	
		<div class="tabs services tab-container">
		
			<div class="panel-container">
			
				<?php
					$i = 0;
					while( $i++ < 4 ) :
				?>
				
					  <div class="tab-block" id="tab-<?php echo $i; ?>">
					    <h2 class="slab"><?php echo htmlspecialchars_decode( stripslashes( $options["maintitle$i"] )); ?></h2>
					    <p class="lead"><?php echo htmlspecialchars_decode( stripslashes( $options["content$i"] ) ); ?></p>
					  </div>
				  
				<?php
					endwhile;
				?>

			</div>

			<ul class="etabs row">
			
				<?php
					$i = 0;
					while( $i++ < 4 ) :
				?>
				
					  <li class="tab col-sm-3">
					    <a href="#tab-<?php echo $i; ?>">
						    <div class="pin"></div>
						    <div class="root"></div>
						    <div class="icon"><i class="<?php echo $options["icon$i"]; ?> icn"></i></div>
						    <h4><?php echo htmlspecialchars_decode( $options["title$i"] ); ?></h4>
					    </a>
					  </li>
				    
				 <?php
				 	endwhile;
				 ?>

			</ul><!-- /.etabs --> 
			
		</div><!-- /.tabs --> 
	
	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}