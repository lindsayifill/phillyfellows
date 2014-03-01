<?php
/**
 * @author 		TommusRhodus
 * @package 	Slowave
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;
?>

<div id="product-<?php the_ID(); ?>" <?php post_class('item post'); ?>>
	
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
	<?php
		/**
		 * woocommerce_before_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
	?>
	
	<div class="image-caption clearfix">
		
		<h3 class="post-title">
			<?php 
				the_title('<a href="' . get_permalink() . '">','</a>'); 
			?>
		</h3>
		
		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
		
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	
	</div>
  
</div>