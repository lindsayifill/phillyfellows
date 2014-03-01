<?php


function woocommerce_template_loop_product_thumbnail(){
	global $post;
	$details = get_option('shop_catalog_image_size');
	$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
	$resized_image = aq_resize($url[0], $details['width'], $details['height'], $details['crop']);
	echo '<figure class="icon-overlay medium icn-link"><a href="' . get_permalink() . '"><img src="' . $resized_image . '" alt="' . get_the_title() . '" width="'.$details['width'].'" height="'.$details['height'].'" /></a></figure>';
}


// Load local WooCommerce Styles
function ebor_woocommerce_load_scripts() {
	wp_deregister_script( 'prettyPhoto' );
	wp_deregister_script( 'prettyPhoto-init' );
	wp_deregister_style( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
}
add_action('wp_enqueue_scripts', 'ebor_woocommerce_load_scripts', 100);

//Open Page Wrapper
add_action('woocommerce_after_shop_loop', 'woocommerce_get_sidebar', 5);
add_action('woocommerce_after_shop_loop_item_title', 'ebor_product_break', 7);

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
	woocommerce_related_products( array(4,4) ); // Display 3 products in rows of 3
}

function ebor_product_break(){
	echo '<hr />';
}

/**
 * Add Shop Link to Menu
 */
function ebor_search_icon($items, $args) {

	if($args->theme_location == 'primary'){
	
		$items .= ebor_dropdown();
		return $items;
		
	} else {
	
		return $items;
		
	}
	
}
add_filter( 'wp_nav_menu_items', 'ebor_search_icon', 20,2 );

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<ul class="ebor_cart_list">
	
	<?php 				
		foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
			
			$_product = $cart_item['data'];
			
			if ($_product->exists() && $cart_item['quantity']>0) :
				echo '<li><div class="dropdowncartimage">';
				echo '<a href="'.get_permalink($cart_item['product_id']).'">';				
				if (has_post_thumbnail($cart_item['product_id'])) :					
					echo get_the_post_thumbnail($cart_item['product_id'], 'shop_thumbnail'); 
				else :					 
					echo '<img src="'.$woocommerce->plugin_url(). '/assets/images/placeholder.png" alt="Placeholder" width="'.$woocommerce->get_image_size('shop_thumbnail_image_width').'" height="'.$woocommerce->get_image_size('shop_thumbnail_image_height').'" />'; 				
				endif;				
				echo '</a>';
				echo '</div>';
				
				echo '<div class="dropdowncartproduct">';
				echo '<a href="'.get_permalink($cart_item['product_id']).'">';				
				echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product);				
				if ($_product instanceof woocommerce_product_variation && is_array($cart_item['variation'])) :
					echo woocommerce_get_formatted_variation( $cart_item['variation'] );
					endif;
				echo '<span class="quantity">' .$cart_item['quantity'].' &times; '.woocommerce_price($_product->get_price()).'</span>
					  </a></div><div class="clear"></div></li>';
				
			endif;
		endforeach; ?>
		
		</ul>
	<?php
	
	$fragments['ul.ebor_cart_list'] = ob_get_clean();
	
	return $fragments;
	
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment_total');
function woocommerce_header_add_to_cart_fragment_total( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<p class="total text-center"><strong>
	
	<?php	
	if (get_option('js_prices_include_tax')=='yes') :
		_e('Total', 'slowave');
	else :
		_e('Subtotal', 'slowave');
	endif;
	
	echo ':</strong><span class="contents">'.$woocommerce->cart->get_cart_total().'</span></p>';
	
	$fragments['p.total'] = ob_get_clean();
	
	return $fragments;
	
}

function ebor_dropdown() {
	global $woocommerce; 
	
	if (is_cart()) 
		return;
	
	$output = '';
	
	$output .= '<li id="ebor-cart-link"><a href="'.$woocommerce->cart->get_cart_url().'"><i class="icon-basket-1"></i></a></li>';
		  
	if (sizeof($woocommerce->cart->cart_contents)>0) : 
	
	$output .=  '
	<div class="dropdowncartcontents">
	<ul class="ebor_cart_list">';
					
		foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :

			$_product = $cart_item['data'];
			
			if ($_product->exists() && $cart_item['quantity']>0) :
				$output .=  '<li><div class="dropdowncartimage">';
				$output .=  '<a href="'.get_permalink($cart_item['product_id']).'">';				
				if (has_post_thumbnail($cart_item['product_id'])) :					
					$output .=  get_the_post_thumbnail($cart_item['product_id'], 'shop_thumbnail'); 
				else :					 
					$output .=  '<img src="'.$woocommerce->plugin_url(). '/assets/images/placeholder.png" alt="Placeholder" width="'.$woocommerce->get_image_size('shop_thumbnail_image_width').'" height="'.$woocommerce->get_image_size('shop_thumbnail_image_height').'" />'; 				
				endif;				
				$output .=  '</a>';
				$output .=  '</div>';
				
				$output .=  '<div class="dropdowncartproduct">';
				$output .=  '<a href="'.get_permalink($cart_item['product_id']).'">';				
				$output .=  apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product);				
				if ($_product instanceof woocommerce_product_variation && is_array($cart_item['variation'])) :
					$output .=  woocommerce_get_formatted_variation( $cart_item['variation'] );
				endif;
				$output .=  '<span class="quantity">' .$cart_item['quantity'].' &times; '.woocommerce_price($_product->get_price()).'</span>
					  </a></div><div class="clear"></div></li>';
				
			endif;
		endforeach;
		
		if(!( $woocommerce->cart->cart_contents ))
		$output .= '<li>' . __('Your Cart is currently empty.','slowave') . '</li>';
		
		$output .= '</ul>';
	
	endif;
	
	if (sizeof($woocommerce->cart->cart_contents)>0) :
	
	$output .=  '<p class="total text-center"><strong>';
		
	if (get_option('js_prices_include_tax')=='yes') :
		$output .= __('Total', 'slowave');
	else :
		$output .= __('Subtotal', 'slowave');
	endif;
	
	$output .=  ':</strong><span class="contents">'.$woocommerce->cart->get_cart_total().'</span></p>';
		
	do_action( 'woocommerce_widget_shopping_cart_before_buttons' );
		
	$output .=  '<p class="buttons text-center">
		  <a href="'.$woocommerce->cart->get_cart_url().'" class="btn">'.__('View Cart &rarr;', 'slowave').'</a> 
		  <a href="'.$woocommerce->cart->get_checkout_url().'" class="btn checkout">'.__('Checkout &rarr;', 'slowave').'</a>
		  </p></div>';
	endif;
	
	return $output;
}