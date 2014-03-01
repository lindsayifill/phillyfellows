<?php 

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Map_Block" );')
);

class Slowave_Map_Block extends DSLC_Module {
 		
 	// Module Attributes
    var $module_id = 'Slowave_Map_Block';
    var $module_title = 'Map';
    var $module_icon = 'map-marker';
    var $module_category = 'Slowave - Elements';
 
 	// Module Options
    function options() { 
	
    	// The options array
    	$dslc_options = array(
			array(
				'label' => 'Map Address, Use a Plain Text Address',
				'id' => 'title',
				'std' => 'London, UK',
				'type' => 'textarea',
				'section' => 'styling'
			),
			array(
				'label' => 'Map Height',
				'id' => 'height',
				'std' => '200',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.map',
				'affect_on_change_rule' => 'height',
				'ext' => 'px',
				'min' => 100,
				'max' => 1000,
				'section' => 'styling',
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
		
		<div class="divide10"></div>
		<div class="map"></div>
		<div class="divide20"></div>
		
		<script type="text/javascript">
			/*-----------------------------------------------------------------------------------*/
			/*	MAP
			/*-----------------------------------------------------------------------------------*/
			jQuery(document).ready(function($){
			'use strict';
			
				jQuery('.map').goMap({ address: '<?php echo $options['title']; ?>',
					  zoom: 14,
					  mapTypeControl: false,
				      draggable: false,
				      scrollwheel: false,
				      streetViewControl: false,
				      maptype: 'ROADMAP',
			    	  markers: [
			    		{ 'address' : '<?php echo $options['title']; ?>' }
			    	  ],
					  addMarker: false
				});
			
			});
		</script>
	
	<?php
    	// REQUIRED
    	$this->module_end( $options );

    }
 
}