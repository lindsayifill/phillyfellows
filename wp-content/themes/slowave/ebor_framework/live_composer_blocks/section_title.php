<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Section_Title" );')
);

class Slowave_Section_Title extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Section_Title';
    var $module_title = 'Section Title';
    var $module_icon = 'font';
    var $module_category = 'Slowave - Misc';
 
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
			array(
				'label' => 'Disable Icon & Underline',
				'id' => 'disable',
				'std' => 'none',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => 'No - Show Both',
						'value' => 'none'
					),
					array(
						'label' => 'Disable Icon',
						'value' => 'icon'
					),
					array(
						'label' => 'Disable Underline & Icon',
						'value' => 'underline'
					),
				)
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
			array(
				'label' => 'Title Color',
				'id' => 'css_nav_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.section-title h2',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Colors'
			),
			array(
				'label' => 'Line Color',
				'id' => 'css_line_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.section-title .icon:after, .section-title .icon:before',
				'affect_on_change_rule' => 'border-bottom-color',
				'section' => 'styling',
				'tab' => 'Colors'
			),
			array(
				'label' => 'Icon Color',
				'id' => 'css_icon_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.section-title .icon',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Colors'
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
		<div class="section-title text-center">
		  <h2>
		  	<?php 
		  	        		        
				if ( $dslc_active ) {
					?><div class="dslca-editable-content" data-id="title"><?php
				}
				
					$output_content = strip_tags(stripslashes( $options['title'] ));
					echo $output_content;

				if ( $dslc_active ) {
					?></div><!-- .dslca-editable-content --><?php
				}

			?>
		  </h2>
		  
		  <?php if( $options['disable'] !== 'underline' ) : ?>
		  <span class="icon">
		  <?php 
		  	              		        
  			if ( $dslc_active ) {
  				?><div class="dslca-editable-content" data-id="title"><?php
  			}
  				if( $options['disable'] !== 'icon' ){
  					$output_content =  '<i class="'. $options["icon"] .' icn"></i>';
  					echo $output_content;
  				}
  
  			if ( $dslc_active ) {
  				?></div><!-- .dslca-editable-content --><?php
  			}
  
  		  ?> 
		  </span> 
		  <?php endif; ?>
		  
		</div>
		
	<?php 
		if( $options['dark_bg'] == 'yes' )
			echo '</div>'
	?>
	
	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}