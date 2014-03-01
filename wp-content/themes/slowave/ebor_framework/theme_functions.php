<?php

/**
 * Hook in on activation
 */
global $pagenow;

if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) 
	add_action( 'init', 'ebor_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes
 */
function ebor_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '440',	// px
		'height'	=> '295',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '400',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '120',	// px
		'height'	=> '120',	// px
		'crop'		=> 0 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

/**
 * Add additional styling options to TinyMCE
 */
function ebor_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'ebor_mce_buttons_2' );

/**
 * Add additional styling options to TinyMCE
 */
function ebor_mce_before_init( $settings ) {

    $style_formats = array(
    	array(
    		'title' => 'Subheading Paragraph',
    		'selector' => 'p',
    		'classes' => 'lead',
    	),
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}
add_filter( 'tiny_mce_before_init', 'ebor_mce_before_init' );

/**
 * Add an additional link to the theme options on the dashboard
 */
function ebor_add_customize_page() {
	add_dashboard_page( 'Slowave Theme Options', 'Slowave Theme Options', 'edit_theme_options', 'customize.php' );
}
add_action ('admin_menu', 'ebor_add_customize_page');

if(!( function_exists('ebor_load_favicons') )){
	function ebor_load_favicons() { ?>
		<?php if ( get_option('144_favicon') !='' ) : ?><link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_option('144_favicon'); ?>"><?php endif; ?>
		<?php if ( get_option('114_favicon') !='' ) : ?><link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_option('114_favicon'); ?>"><?php endif; ?>
		<?php if ( get_option('72_favicon') !='' ) : ?><link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_option('72_favicon'); ?>"><?php endif; ?>
		<?php if ( get_option('mobile_favicon') !='' ) : ?><link rel="apple-touch-icon-precomposed" href="<?php echo get_option('mobile_favicon'); ?>"><?php endif; ?>
		<?php if ( get_option('custom_favicon') !='' ) : ?><link rel="shortcut icon" href="<?php echo get_option('custom_favicon'); ?>"><?php endif; ?>
	<?php }
}
add_action('wp_head', 'ebor_load_favicons');


if(!( function_exists('tcb_add_post_thumbnail_column') )){
	function tcb_add_post_thumbnail_column($cols){
	  $cols['tcb_post_thumb'] = __('Featured Image','slowave');
	  return $cols;
	}
}
add_filter('manage_posts_columns', 'tcb_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'tcb_add_post_thumbnail_column', 5);


if(!( function_exists('tcb_display_post_thumbnail_column') )){
	function tcb_display_post_thumbnail_column($col, $id){
	  switch($col){
	    case 'tcb_post_thumb':
	      if( function_exists('the_post_thumbnail') )
	        echo the_post_thumbnail( 'admin-list-thumb' );
	      else
	        echo 'Not supported in theme';
	      break;
	  }
	}
}
add_action('manage_posts_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);

if(!( function_exists('ebor_wpml_cleaner') )){
	function ebor_wpml_cleaner($items,$args) {
	      
	    if($args->theme_location == 'primary'){
	          
	        if (function_exists('icl_get_languages')) {
	            $items = str_replace('sub-menu', 'dropdown-menu', $items);
	            $items = str_replace('onclick="return false"', 'class="dropdown-toggle js-activated"', $items);
	            $items = str_replace('menu-item-language', 'menu-item-language dropdown', $items);
	        }
	  
	        return $items;
	    }
	    else
	        return $items;
	}
}
add_filter( 'wp_nav_menu_items', 'ebor_wpml_cleaner', 20,2 );


/**
 * HEX to RGB Converter
 *
 * Converts a HEX input to an RGB array.
 * @param $hex - the inputted HEX code, can be full or shorthand, #ffffff or #fff
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('ebor_hex2rgb') )){
	function ebor_hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
}

/**
 * Portfolio taxonomy terms output.
 *
 * Checks that terms exist in the portfolio-category taxonomy, then returns a comma seperated string of results.
 * @todo Allow for taxonomy input for differing taxonmoies through the same function.
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('ebor_the_simple_terms') )){
	function ebor_the_simple_terms() {
	global $post;
		if( get_the_terms($post->ID,'dslc_projects_cats') !='' ) {
			$terms = get_the_terms($post->ID,'dslc_projects_cats','',', ','');
			$terms = array_map('_simple_cb', $terms);
			return implode(', ', $terms);
		}
	}
}

/**
 * Term name return
 *
 * Returns the Pretty Name of a term array
 * @param $t - the term array object
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('_simple_cb') )){
	function _simple_cb($t) {  return $t->name; }
}

/**
 * Portfolio taxonomy terms output.
 *
 * Checks that terms exist in the portfolio-category taxonomy, then returns a space seperated string of results.
 * @todo Allow for taxonomy input for differing taxonmoies through the same function.
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('ebor_the_isotope_terms') )){
	function ebor_the_isotope_terms() {
	global $post;
		if( get_the_terms($post->ID,'dslc_projects_cats') ) {
			$terms = get_the_terms($post->ID,'dslc_projects_cats','','','');
			$terms = array_map('_isotope_cb', $terms);
			return implode(' ', $terms);
		}
	}
}

/**
 * Term Slug Return
 *
 * Returns the slug of a term array
 * @param $t - the term array object
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('_isotope_cb') )){
	function _isotope_cb($t) {  return $t->slug; }
}


/**
 * Portfolio taxonomy terms output.
 *
 * Checks that terms exist in the portfolio-category taxonomy, then returns a comma seperated string of results.
 * @todo Allow for taxonomy input for differing taxonmoies through the same function.
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('ebor_the_simple_terms_links') )){
	function ebor_the_simple_terms_links() {
	global $post;
		if( get_the_terms($post->ID,'dslc_projects_cats') !=='' ) {
			$terms = get_the_terms($post->ID,'dslc_projects_cats','',', ','');
			$terms = array_map('_simple_link', $terms);
			return implode(' ', $terms);
		}
	}
}

/**
 * Term name return
 *
 * Returns the Pretty Name of a term array
 * @param $t - the term array object
 * @since 1.0.0
 * @return string
 */
if(!( function_exists('_simple_link') )){
	function _simple_link($t) {  return '<a href="'.get_term_link( $t, 'portfolio-category' ).'">'.$t->name.'</a>'; }
}

if(!( function_exists('ebor_pagination') )){
	function ebor_pagination($pages = '', $range = 2){
		$showitems = ($range * 2)+1;
		
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
				if(!$pages) {
					$pages = 1;
				}
		}
		
		$output = '';
		
		if(1 != $pages){
			$output .= "<div class='pagination'><ul>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) $output .= "<li><a href='".get_pagenum_link(1)."'>".__('First','slowave')."</a></li> ";
			
			for ($i=1; $i <= $pages; $i++){
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					$output .= ($paged == $i)? "<li class='active'><a href='".get_pagenum_link($i)."'>".$i."</a></li> ":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li> ";
				}
			}
		
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $output .= "<li><a href='".get_pagenum_link($pages)."'>".__('Last','slowave')."</a></li> ";
			$output.= "</ul></div>";
		}
		
		return $output;
	}
}

if(!( function_exists('ebor_custom_comment') )){
	function ebor_custom_comment($comment, $args, $depth) { 
	$GLOBALS['comment'] = $comment; 
	?>
	
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	  <div class="user"><?php echo get_avatar( $comment->comment_author_email, 70 ); ?></div>
	  <div class="message">
	    <div class="image-caption">
	      <div class="info">
	        <?php printf('<h2>%s</h2>', get_comment_author_link()); ?>
	        <div class="meta">
	        	<div class="date"><?php echo get_comment_date(); ?></div>
	        	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
	        </div>
	      </div>
	      <?php echo wpautop( get_comment_text() ); ?>
	      <?php if ($comment->comment_approved == '0') : ?>
	      <p><em><?php _e('Your comment is awaiting moderation.', 'slowave') ?></em></p>
	      <?php endif; ?>
	    </div>
	  </div>
	</li>
	
	<?php }
}

if(!( function_exists('ebor_picons') )){
	function ebor_picons(){
		return array(
			'icon-picons-abacus',
			'icon-picons-add',
			'icon-picons-airplay',
			'icon-picons-alert',
			'icon-picons-alert-2',
			'icon-picons-alert-error',
			'icon-picons-alert-error-2',
			'icon-picons-anchor',
			'icon-picons-animal-foot',
			'icon-picons-answer',
			'icon-picons-archive',
			'icon-picons-arrow-left',
			'icon-picons-arrow-right',
			'icon-picons-arrows',
			'icon-picons-arrows-2',
			'icon-picons-arrows-3',
			'icon-picons-arrows-4',
			'icon-picons-arrows-5',
			'icon-picons-article',
			'icon-picons-attachment',
			'icon-picons-award',
			'icon-picons-backup',
			'icon-picons-badge',
			'icon-picons-badge-2',
			'icon-picons-bag',
			'icon-picons-bag-2',
			'icon-picons-ball',
			'icon-picons-bandage',
			'icon-picons-basket',
			'icon-picons-basket-2',
			'icon-picons-battery',
			'icon-picons-battery-2',
			'icon-picons-battery-3',
			'icon-picons-battery-4',
			'icon-picons-battery-5',
			'icon-picons-battery-6',
			'icon-picons-bicycle',
			'icon-picons-bicycle-chain',
			'icon-picons-bill',
			'icon-picons-binary',
			'icon-picons-bomb',
			'icon-picons-book',
			'icon-picons-book-shelf',
			'icon-picons-book-shelf-2',
			'icon-picons-bookmark',
			'icon-picons-bookmark-2',
			'icon-picons-bowling',
			'icon-picons-box',
			'icon-picons-box-archive',
			'icon-picons-box-export',
			'icon-picons-box-import',
			'icon-picons-brain',
			'icon-picons-brain-2',
			'icon-picons-broken-heart',
			'icon-picons-brush',
			'icon-picons-brush-2',
			'icon-picons-bubble-cloud',
			'icon-picons-bubble-cloud-2',
			'icon-picons-bubble-comment',
			'icon-picons-bug',
			'icon-picons-building',
			'icon-picons-building-2',
			'icon-picons-bulb',
			'icon-picons-bulb-2',
			'icon-picons-bulb-3',
			'icon-picons-bus',
			'icon-picons-business-man',
			'icon-picons-calculator',
			'icon-picons-calculator-2',
			'icon-picons-calendar',
			'icon-picons-calendar-2',
			'icon-picons-candle',
			'icon-picons-car',
			'icon-picons-car-steering',
			'icon-picons-cards',
			'icon-picons-cart',
			'icon-picons-cart-2',
			'icon-picons-cart-3',
			'icon-picons-casette',
			'icon-picons-cd',
			'icon-picons-chain',
			'icon-picons-chart',
			'icon-picons-chart-2',
			'icon-picons-chart-3',
			'icon-picons-chart-4',
			'icon-picons-chart-5',
			'icon-picons-chart-6',
			'icon-picons-chart-7',
			'icon-picons-chart-8',
			'icon-picons-chart-9',
			'icon-picons-chat',
			'icon-picons-check',
			'icon-picons-checked',
			'icon-picons-checked-2',
			'icon-picons-clock',
			'icon-picons-clock3',
			'icon-picons-clock-2',
			'icon-picons-close',
			'icon-picons-closed-store',
			'icon-picons-cloud',
			'icon-picons-cloud-backup',
			'icon-picons-cloud-error',
			'icon-picons-cloud-rain',
			'icon-picons-cloud-synce',
			'icon-picons-cocktail',
			'icon-picons-coffee',
			'icon-picons-coins',
			'icon-picons-color',
			'icon-picons-comment',
			'icon-picons-comment-2',
			'icon-picons-compass',
			'icon-picons-compose',
			'icon-picons-computer',
			'icon-picons-computer-2',
			'icon-picons-cone',
			'icon-picons-configuration',
			'icon-picons-configuration-2',
			'icon-picons-contract',
			'icon-picons-cooking',
			'icon-picons-couch',
			'icon-picons-cpu',
			'icon-picons-credit-card',
			'icon-picons-crop',
			'icon-picons-crown',
			'icon-picons-cv',
			'icon-picons-cv3',
			'icon-picons-cv-2',
			'icon-picons-dangerous',
			'icon-picons-database',
			'icon-picons-database-2',
			'icon-picons-database-3',
			'icon-picons-date',
			'icon-picons-date-2',
			'icon-picons-decoration',
			'icon-picons-delivery',
			'icon-picons-desktop',
			'icon-picons-desktop-cloud',
			'icon-picons-desktop-preferences',
			'icon-picons-desktop-security',
			'icon-picons-desktop-users',
			'icon-picons-diagram',
			'icon-picons-diagram-2',
			'icon-picons-diamond',
			'icon-picons-directions',
			'icon-picons-directions-2',
			'icon-picons-disc',
			'icon-picons-discount',
			'icon-picons-doc',
			'icon-picons-dock',
			'icon-picons-document',
			'icon-picons-document-settings',
			'icon-picons-documents-box',
			'icon-picons-dollar',
			'icon-picons-dollar-2',
			'icon-picons-dollars-euro',
			'icon-picons-dont-touch',
			'icon-picons-dont-touch-2',
			'icon-picons-download',
			'icon-picons-download-2',
			'icon-picons-download-3',
			'icon-picons-download-cloud',
			'icon-picons-download-drive',
			'icon-picons-drawing',
			'icon-picons-drink',
			'icon-picons-drop',
			'icon-picons-dropdown',
			'icon-picons-drums',
			'icon-picons-earth',
			'icon-picons-education',
			'icon-picons-envelope',
			'icon-picons-error',
			'icon-picons-euro',
			'icon-picons-export',
			'icon-picons-eye',
			'icon-picons-eye-dropper',
			'icon-picons-factory',
			'icon-picons-favorite',
			'icon-picons-feather',
			'icon-picons-file',
			'icon-picons-file-photo',
			'icon-picons-find',
			'icon-picons-fingerprint',
			'icon-picons-fire',
			'icon-picons-fire-estinguisher',
			'icon-picons-firewall',
			'icon-picons-flag',
			'icon-picons-flashlight',
			'icon-picons-flight',
			'icon-picons-flower',
			'icon-picons-folder',
			'icon-picons-folder-2',
			'icon-picons-folder-backup',
			'icon-picons-folder-documents',
			'icon-picons-folder-locked',
			'icon-picons-folder-photos',
			'icon-picons-folder-preferences',
			'icon-picons-folder-schedule',
			'icon-picons-folder-upload',
			'icon-picons-font',
			'icon-picons-free',
			'icon-picons-fuel',
			'icon-picons-full-documents',
			'icon-picons-funnel',
			'icon-picons-gamepad',
			'icon-picons-garbage',
			'icon-picons-garbage-2',
			'icon-picons-gauge',
			'icon-picons-gauge-2',
			'icon-picons-gauge-3',
			'icon-picons-gift',
			'icon-picons-glasses',
			'icon-picons-hamburger',
			'icon-picons-hammer',
			'icon-picons-heart',
			'icon-picons-heart-add',
			'icon-picons-holiday',
			'icon-picons-home',
			'icon-picons-home-2',
			'icon-picons-house',
			'icon-picons-id',
			'icon-picons-id-2',
			'icon-picons-image',
			'icon-picons-image-2',
			'icon-picons-image-3',
			'icon-picons-image-4',
			'icon-picons-image-5',
			'icon-picons-image-6',
			'icon-picons-image-7',
			'icon-picons-image-8',
			'icon-picons-image-9',
			'icon-picons-image-10',
			'icon-picons-import',
			'icon-picons-information',
			'icon-picons-ipad',
			'icon-picons-iphone',
			'icon-picons-ipod',
			'icon-picons-ipod-2',
			'icon-picons-keyboard',
			'icon-picons-keyboard-2',
			'icon-picons-keyboard-3',
			'icon-picons-keyboard-4',
			'icon-picons-lab',
			'icon-picons-language',
			'icon-picons-laptop-download',
			'icon-picons-laptop-statistics',
			'icon-picons-laptop-user',
			'icon-picons-laptop-web',
			'icon-picons-law',
			'icon-picons-law-2',
			'icon-picons-layers',
			'icon-picons-leaf',
			'icon-picons-leaf-2',
			'icon-picons-light',
			'icon-picons-like',
			'icon-picons-list',
			'icon-picons-list-bullets',
			'icon-picons-list-check',
			'icon-picons-list-favorites',
			'icon-picons-list-grid',
			'icon-picons-list-radio',
			'icon-picons-list-select',
			'icon-picons-list-thumbs',
			'icon-picons-location',
			'icon-picons-location-map',
			'icon-picons-lock',
			'icon-picons-lock-2',
			'icon-picons-lock-3',
			'icon-picons-lock-4',
			'icon-picons-logout',
			'icon-picons-magnet',
			'icon-picons-manual',
			'icon-picons-maximize',
			'icon-picons-medal',
			'icon-picons-medal-2',
			'icon-picons-medicine',
			'icon-picons-megaphone',
			'icon-picons-microphone',
			'icon-picons-microphone-2',
			'icon-picons-milk',
			'icon-picons-minus-down',
			'icon-picons-mobile-call',
			'icon-picons-mobile-chat',
			'icon-picons-mobile-payment',
			'icon-picons-mobile-phone',
			'icon-picons-mobile-ring',
			'icon-picons-mobile-sms',
			'icon-picons-molecular',
			'icon-picons-money',
			'icon-picons-moon',
			'icon-picons-mouse',
			'icon-picons-mouse-2',
			'icon-picons-moustache',
			'icon-picons-move',
			'icon-picons-music',
			'icon-picons-music-2',
			'icon-picons-music-3',
			'icon-picons-music-4',
			'icon-picons-music-5',
			'icon-picons-needle',
			'icon-picons-network',
			'icon-picons-network-2',
			'icon-picons-network-3',
			'icon-picons-new',
			'icon-picons-new-badge',
			'icon-picons-news',
			'icon-picons-next',
			'icon-picons-notebook',
			'icon-picons-notebook-2',
			'icon-picons-nuclear',
			'icon-picons-offee-2',
			'icon-picons-open-24-7',
			'icon-picons-open-box',
			'icon-picons-open-store',
			'icon-picons-package',
			'icon-picons-package-2',
			'icon-picons-paper',
			'icon-picons-paper-2',
			'icon-picons-paper-shredder',
			'icon-picons-paperclip',
			'icon-picons-password',
			'icon-picons-pds',
			'icon-picons-pencil',
			'icon-picons-pencil-ruler',
			'icon-picons-petition',
			'icon-picons-phone-book',
			'icon-picons-phone-book-2',
			'icon-picons-phone-book-3',
			'icon-picons-phone-book-4',
			'icon-picons-phone-book-5',
			'icon-picons-picnic',
			'icon-picons-pin',
			'icon-picons-pin-2',
			'icon-picons-pin-3',
			'icon-picons-pin-4',
			'icon-picons-plane',
			'icon-picons-plant',
			'icon-picons-plug',
			'icon-picons-plus-up',
			'icon-picons-postcard',
			'icon-picons-power',
			'icon-picons-preferences',
			'icon-picons-preferences-2',
			'icon-picons-presentation',
			'icon-picons-previous',
			'icon-picons-printer',
			'icon-picons-profile',
			'icon-picons-profile-2',
			'icon-picons-pulse',
			'icon-picons-puzzle',
			'icon-picons-question',
			'icon-picons-quote',
			'icon-picons-radio',
			'icon-picons-read',
			'icon-picons-recording',
			'icon-picons-recycle',
			'icon-picons-recycle-bin',
			'icon-picons-register',
			'icon-picons-remote',
			'icon-picons-remove',
			'icon-picons-remove-2',
			'icon-picons-repeat',
			'icon-picons-resize',
			'icon-picons-restaurant',
			'icon-picons-ringer',
			'icon-picons-ringer-mute',
			'icon-picons-road',
			'icon-picons-rocket',
			'icon-picons-rotate',
			'icon-picons-rotate-left',
			'icon-picons-rotate-lock',
			'icon-picons-rotate-right',
			'icon-picons-ruler',
			'icon-picons-safe',
			'icon-picons-savings',
			'icon-picons-scissors',
			'icon-picons-search',
			'icon-picons-search3',
			'icon-picons-search-2',
			'icon-picons-sent',
			'icon-picons-server',
			'icon-picons-settings',
			'icon-picons-settings-2',
			'icon-picons-shield',
			'icon-picons-ship',
			'icon-picons-shopping',
			'icon-picons-shuffle',
			'icon-picons-signing',
			'icon-picons-sim-card',
			'icon-picons-smiley-happy',
			'icon-picons-smiley-neutral',
			'icon-picons-smiley-sad',
			'icon-picons-snow',
			'icon-picons-socket',
			'icon-picons-speaker',
			'icon-picons-star',
			'icon-picons-star-2',
			'icon-picons-star-add',
			'icon-picons-step',
			'icon-picons-store',
			'icon-picons-store-2',
			'icon-picons-suitcase',
			'icon-picons-suitcase-2',
			'icon-picons-suitcase-3',
			'icon-picons-suitcase-secure',
			'icon-picons-sun',
			'icon-picons-support',
			'icon-picons-support-2',
			'icon-picons-support-3',
			'icon-picons-surveillance',
			'icon-picons-switch-off',
			'icon-picons-switch-on',
			'icon-picons-sync',
			'icon-picons-table',
			'icon-picons-tag',
			'icon-picons-tag-2',
			'icon-picons-tag-price',
			'icon-picons-target',
			'icon-picons-telephone',
			'icon-picons-telephone-2',
			'icon-picons-telephone-3',
			'icon-picons-telephone-busy',
			'icon-picons-telephone-call',
			'icon-picons-temperature',
			'icon-picons-temperature-2',
			'icon-picons-thumbs-down',
			'icon-picons-thumbs-up',
			'icon-picons-thunderbolt-connect',
			'icon-picons-ticket',
			'icon-picons-tie',
			'icon-picons-time',
			'icon-picons-time3',
			'icon-picons-time-2',
			'icon-picons-tools',
			'icon-picons-traffic-light',
			'icon-picons-train',
			'icon-picons-tree',
			'icon-picons-tree-2',
			'icon-picons-truck',
			'icon-picons-tshirt',
			'icon-picons-tv',
			'icon-picons-twitter',
			'icon-picons-umbrella',
			'icon-picons-unavailable',
			'icon-picons-undo',
			'icon-picons-upload',
			'icon-picons-upload-2',
			'icon-picons-upload-cloud',
			'icon-picons-url',
			'icon-picons-usb',
			'icon-picons-usb-connect',
			'icon-picons-user',
			'icon-picons-user-2',
			'icon-picons-user-3',
			'icon-picons-user-add',
			'icon-picons-user-boy',
			'icon-picons-user-chat',
			'icon-picons-user-female',
			'icon-picons-user-password',
			'icon-picons-user-remove',
			'icon-picons-user-tag',
			'icon-picons-users',
			'icon-picons-users-2',
			'icon-picons-vector',
			'icon-picons-vehicle',
			'icon-picons-video',
			'icon-picons-video-2',
			'icon-picons-video-3',
			'icon-picons-video-4',
			'icon-picons-video-5',
			'icon-picons-video-6',
			'icon-picons-vinyl',
			'icon-picons-volume',
			'icon-picons-volume-2',
			'icon-picons-volume-3',
			'icon-picons-volume-4',
			'icon-picons-wallet',
			'icon-picons-wallet-2',
			'icon-picons-webcam',
			'icon-picons-wifi',
			'icon-picons-wifi-2',
			'icon-picons-window',
			'icon-picons-window-alert',
			'icon-picons-window-command',
			'icon-picons-window-cursor',
			'icon-picons-window-error',
			'icon-picons-window-layout',
			'icon-picons-window-layout-2',
			'icon-picons-window-layout-3',
			'icon-picons-window-layout-4',
			'icon-picons-window-settings',
			'icon-picons-wine',
			'icon-picons-winner',
			'icon-picons-wireless',
			'icon-picons-write',
			'icon-picons-writing',
			'icon-picons-writing-2',
			'icon-picons-youtube',
			'icon-picons-zip',
			'icon-picons-zoom-in',
			'icon-picons-zoom-out',
		);
	}
}

/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class ebor_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children && $depth == 0 ){
				$class_names .= ' dropdown';
			} elseif ( $args->has_children ){
				$class_names .= ' dropdown-submenu';
			}

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= '#';
				$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle js-activated';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			if ( ! empty( $item->attr_title ) )
				$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			else
				$item_output .= '<a'. $attributes .'>';

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && 0 === $depth ) ? '</a>' : '</a>';
			$item_output .= $args->after;
			
			/**
			 * Check if menu item object is a mega menu object.
			 * If it is, display the mega menu content.
			 * Otherwise render elements as normal
			 */
			if( $item->object == 'mega_menu' ) {
				$output .= '<div class="yamm-content row">' . apply_filters('the_content', get_post_field('post_content', $item->object_id)) . '</div>';
			} else {
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}

		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}