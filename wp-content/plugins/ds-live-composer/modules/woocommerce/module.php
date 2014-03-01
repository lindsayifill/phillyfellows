<?php

class DSLC_WooCommerce_Products extends DSLC_Module {

	var $module_id = 'DSLC_WooCommerce_Products';
	var $module_title = 'Products (Woo)';
	var $module_icon = 'dollar';
	var $module_category = 'posts';

	function options() {		

		$cats = get_terms( 'product_cat' );
		$cats_choices = array();

		if ( $cats ) {
			foreach ( $cats as $cat ) {
				$cats_choices[] = array(
					'label' => $cat->name,
					'value' => $cat->slug
				);
			}
		}

		$dslc_options = array(
			array(
				'label' => __( 'Type', 'dslc_string' ),
				'id' => 'type',
				'std' => 'grid',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Grid', 'dslc_string' ),
						'value' => 'grid',
					),
					array(
						'label' => __( 'Masonry Grid', 'dslc_string' ),
						'value' => 'masonry'
					),
					array(
						'label' => __( 'Carousel', 'dslc_string' ),
						'value' => 'carousel'
					)
				)
			),
			array(
				'label' => __( 'Posts Per Page', 'dslc_string' ),
				'id' => 'amount',
				'std' => '8',
				'type' => 'text',
			),
			array(
				'label' => __( 'Pagination', 'dslc_string' ),
				'id' => 'pagination_type',
				'std' => 'disabled',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Disabled', 'dslc_string' ),
						'value' => 'disabled',
					),
					array(
						'label' => __( 'Numbered', 'dslc_string' ),
						'value' => 'numbered',
					)
				),
			),
			array(
				'label' => __( 'Items Per Row', 'dslc_string' ),
				'id' => 'columns',
				'std' => '3',
				'type' => 'select',
				'choices' => $this->posts_per_row_choices
			),
			array(
				'label' => __( 'Categories', 'dslc_string' ),
				'id' => 'categories',
				'std' => '',
				'type' => 'checkbox',
				'choices' => $cats_choices
			),
			array(
				'label' => __( 'Order By', 'dslc_string' ),
				'id' => 'orderby',
				'std' => 'date',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Publish Date', 'dslc_string' ),
						'value' => 'date'
					),
					array(
						'label' => __( 'Modified Date', 'dslc_string' ),
						'value' => 'modified'
					),
					array(
						'label' => __( 'Random', 'dslc_string' ),
						'value' => 'rand'
					),
					array(
						'label' => __( 'Alphabetic', 'dslc_string' ),
						'value' => 'title'
					),
					array(
						'label' => __( 'Comment Count', 'dslc_string' ),
						'value' => 'comment_count'
					),
					array(
						'label' => __( 'Price', 'dslc_string' ),
						'value' => 'price'
					),
				)
			),
			array(
				'label' => __( 'Order', 'dslc_string' ),
				'id' => 'order',
				'std' => 'DESC',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Ascending', 'dslc_string' ),
						'value' => 'ASC'
					),
					array(
						'label' => __( 'Descending', 'dslc_string' ),
						'value' => 'DESC'
					)
				)
			),
			array(
				'label' => __( 'Offset', 'dslc_string' ),
				'id' => 'offset',
				'std' => '0',
				'type' => 'text',
			),

			/**
			 * General
			 */

			array(
				'label' => __( 'Elements', 'dslc_string' ),
				'id' => 'elements',
				'std' => '',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Heading', 'dslc_string' ),
						'value' => 'main_heading'
					),
					array(
						'label' => __( 'Filters', 'dslc_string' ),
						'value' => 'filters'
					),
				),
				'section' => 'styling'
			),

			array(
				'label' => __( 'Post Elements', 'dslc_string' ),
				'id' => 'post_elements',
				'std' => 'thumbnail price title separator exceprt price_2 addtocart details',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Thumbnail', 'dslc_string' ),
						'value' => 'thumbnail',
					),
					array(
						'label' => __( 'Price', 'dslc_string' ),
						'value' => 'price',
					),
					array(
						'label' => __( 'Title', 'dslc_string' ),
						'value' => 'title',
					),
					array(
						'label' => __( 'Separator', 'dslc_string' ),
						'value' => 'separator',
					),
					array(
						'label' => __( 'Excerpt', 'dslc_string' ),
						'value' => 'excerpt',
					),
					array(
						'label' => __( 'Price Secondary', 'dslc_string' ),
						'value' => 'price_2',
					),
					array(
						'label' => __( 'Add to cart', 'dslc_string' ),
						'value' => 'addtocart',
					),
					array(
						'label' => __( 'Details', 'dslc_string' ),
						'value' => 'details'
					)
				),
				'section' => 'styling'
			),

			array(
				'label' => __( 'Carousel Elements', 'dslc_string' ),
				'id' => 'carousel_elements',
				'std' => 'arrows circles',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Arrows', 'dslc_string' ),
						'value' => 'arrows'
					),
					array(
						'label' => __( 'Circles', 'dslc_string' ),
						'value' => 'circles'
					),
				),
				'section' => 'styling'
			),
			array(
				'label' => __( 'Margin Bottom', 'dslc_string' ),
				'id' => 'css_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-products',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'ext' => 'px',
			),

			/**
			 * Separator
			 */

			array(
				'label' => __( 'Color', 'dslc_string' ),
				'id' => 'css_sep_border_color',
				'std' => '#ededed',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-post-separator',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => 'Row Separator'
			),
			array(
				'label' => __( 'Height', 'dslc_string' ),
				'id' => 'css_sep_height',
				'std' => '32',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-post-separator',
				'affect_on_change_rule' => 'margin-bottom,padding-bottom',
				'ext' => 'px',
				'min' => 1,
				'max' => 300,
				'section' => 'styling',
				'tab' => 'Row Separator'
			),
			array(
				'label' => __( 'Style', 'dslc_string' ),
				'id' => 'css_sep_style',
				'std' => 'dashed',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Invisible', 'dslc_string' ),
						'value' => 'none'
					),
					array(
						'label' => __( 'Solid', 'dslc_string' ),
						'value' => 'solid'
					),
					array(
						'label' => __( 'Dashed', 'dslc_string' ),
						'value' => 'dashed'
					),
					array(
						'label' => __( 'Dotted', 'dslc_string' ),
						'value' => 'dotted'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-post-separator',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => 'Row Separator'
			),

			/**
			 * Thumbnail
			 */

			array(
				'label' => __( 'BG Color', 'dslc_string' ),
				'id' => 'css_thumbnail_bg_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => 'Thumbnail'
			),			
			array(
				'label' => __( 'Border Color', 'dslc_string' ),
				'id' => 'css_thumb_border_color',
				'std' => '#e6e6e6',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb-inner',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => 'Thumbnail'
			),
			array(
				'label' => __( 'Border Width', 'dslc_string' ),
				'id' => 'css_thumb_border_width',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb-inner',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Thumbnail'
			),
			array(
				'label' => __( 'Borders', 'dslc_string' ),
				'id' => 'css_thumb_border_trbl',
				'std' => 'top right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Top', 'dslc_string' ),
						'value' => 'top'
					),
					array(
						'label' => __( 'Right', 'dslc_string' ),
						'value' => 'right'
					),
					array(
						'label' => __( 'Bottom', 'dslc_string' ),
						'value' => 'bottom'
					),
					array(
						'label' => __( 'Left', 'dslc_string' ),
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb-inner',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => 'Thumbnail',
			),	
			array(
				'label' => __( 'Border Radius - Top', 'dslc_string' ),
				'id' => 'css_thumbnail_border_radius_top',
				'std' => '5',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb-inner, .dslc-product-thumb img',
				'affect_on_change_rule' => 'border-top-left-radius,border-top-right-radius',
				'section' => 'styling',
				'tab' => 'Thumbnail',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Border Radius - Bottom', 'dslc_string' ),
				'id' => 'css_thumbnail_border_radius_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb-inner, .dslc-product-thumb img',
				'affect_on_change_rule' => 'border-bottom-left-radius,border-bottom-right-radius',
				'section' => 'styling',
				'tab' => 'Thumbnail',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'dslc_string' ),
				'id' => 'css_thumbnail_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Thumbnail'
			),
			array(
				'label' => __( 'Padding Vertical', 'dslc_string' ),
				'id' => 'css_thumbnail_padding_vertical',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb-inner',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Thumbnail'
			),
			array(
				'label' => __( 'Padding Horizontal', 'dslc_string' ),
				'id' => 'css_thumbnail_padding_horizontal',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb-inner',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Thumbnail'
			),
			array(
				'label' => __( 'Resize - Height', 'dslc_string' ),
				'id' => 'thumb_resize_height',
				'std' => '',
				'type' => 'text',
				'section' => 'styling',
				'tab' => 'thumbnail'
			),
			array(
				'label' => __( 'Resize - Width', 'dslc_string' ),
				'id' => 'thumb_resize_width',
				'std' => '',
				'type' => 'text',
				'section' => 'styling',
				'tab' => 'thumbnail',
				'visibility' => 'hidden'
			),

			/**
			 * Price
			 */

			array(
				'label' => __( 'BG Color', 'dslc_string' ),
				'id' => 'css_price_bg_color',
				'std' => '#437bcf',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price-bg',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => 'Price'
			),
			array(
				'label' => __( 'Border Color', 'dslc_string' ),
				'id' => 'css_price_border_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price-bg',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => 'Price'
			),
			array(
				'label' => __( 'Border Width', 'dslc_string' ),
				'id' => 'css_price_border_width',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price-bg',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Price'
			),
			array(
				'label' => __( 'Borders', 'dslc_string' ),
				'id' => 'css_price_border_trbl',
				'std' => 'top right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Top', 'dslc_string' ),
						'value' => 'top'
					),
					array(
						'label' => __( 'Right', 'dslc_string' ),
						'value' => 'right'
					),
					array(
						'label' => __( 'Bottom', 'dslc_string' ),
						'value' => 'bottom'
					),
					array(
						'label' => __( 'Left', 'dslc_string' ),
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price-bg',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => 'Price',
			),
			array(
				'label' => __( 'Color', 'dslc_string' ),
				'id' => 'css_price_color',
				'std' => '#ffffff',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Price'
			),
			array(
				'label' => __( 'Border Radius', 'dslc_string' ),
				'id' => 'css_price_border_radius',
				'std' => '6',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price-bg',
				'affect_on_change_rule' => 'border-radius',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Price'
			),
			array(
				'label' => __( 'Font Size', 'dslc_string' ),
				'id' => 'css_price_font_size',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'Price',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'dslc_string' ),
				'id' => 'css_price_font_weight',
				'std' => '400',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => 'Price',
				'ext' => '',
				'min' => 100,
				'max' => 900,
				'increment' => 100
			),
			array(
				'label' => __( 'Font Family', 'dslc_string' ),
				'id' => 'css_price_font_family',
				'std' => 'Oswald',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'Price'
			),
			array(
				'label' => __( 'Margin', 'dslc_string' ),
				'id' => 'css_price_margin',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'margin',
				'section' => 'styling',
				'tab' => 'Price',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Opacity', 'dslc_string' ),
				'id' => 'css_price_bg_opacity',
				'std' => '0.82',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price-bg',
				'affect_on_change_rule' => 'opacity',
				'section' => 'styling',
				'tab' => 'Price',
				'min' => 0,
				'max' => 1,
				'increment' => 0.01
			),
			array(
				'label' => __( 'Padding', 'dslc_string' ),
				'id' => 'css_price_padding',
				'std' => '24',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'padding',
				'section' => 'styling',
				'tab' => 'Price',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Position', 'dslc_string' ),
				'id' => 'price_pos',
				'std' => 'center',
				'type' => 'select',
				'section' => 'styling',
				'tab' => 'Price',
				'choices' => array(
					array(
						'label' => __( 'Top Left', 'dslc_string' ),
						'value' => 'topleft'
					),
					array(
						'label' => __( 'Top Right', 'dslc_string' ),
						'value' => 'topright'
					),
					array(
						'label' => __( 'Center', 'dslc_string' ),
						'value' => 'center'
					),
					array(
						'label' => __( 'Bottom Left', 'dslc_string' ),
						'value' => 'bottomleft'
					),
					array(
						'label' => __( 'Bottom Right', 'dslc_string' ),
						'value' => 'bottomright'
					),
				)
			),

			/** 
			 * Main
			 */

			array(
				'label' => __( 'BG Color', 'dslc_string' ),
				'id' => 'css_main_bg_color',
				'std' => '#ffffff',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => 'Main'
			),
			array(
				'label' => __( 'Border Color', 'dslc_string' ),
				'id' => 'css_main_border_color',
				'std' => '#e8e8e8',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => 'Main'
			),
			array(
				'label' => __( 'Border Width', 'dslc_string' ),
				'id' => 'css_main_border_width',
				'std' => '1',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Main'
			),
			array(
				'label' => __( 'Borders', 'dslc_string' ),
				'id' => 'css_main_border_trbl',
				'std' => 'right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Top', 'dslc_string' ),
						'value' => 'top'
					),
					array(
						'label' => __( 'Right', 'dslc_string' ),
						'value' => 'right'
					),
					array(
						'label' => __( 'Bottom', 'dslc_string' ),
						'value' => 'bottom'
					),
					array(
						'label' => __( 'Left', 'dslc_string' ),
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => 'Main',
			),
			array(
				'label' => __( 'Border Radius - Top', 'dslc_string' ),
				'id' => 'css_main_border_radius_top',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'border-top-left-radius,border-top-right-radius',
				'section' => 'styling',
				'tab' => 'Main',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Border Radius - Bottom', 'dslc_string' ),
				'id' => 'css_main_border_radius_bottom',
				'std' => '3',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'border-bottom-left-radius,border-bottom-right-radius',
				'section' => 'styling',
				'tab' => 'Main',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Minimum Height', 'dslc_string' ),
				'id' => 'css_main_min_height',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'min-height',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Main',
				'min' => 0,
				'max' => 500
			),
			array(
				'label' => __( 'Padding Vertical', 'dslc_string' ),
				'id' => 'css_main_padding_vertical',
				'std' => '20',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Main'
			),
			array(
				'label' => __( 'Padding Horizontal', 'dslc_string' ),
				'id' => 'css_main_padding_horizontal',
				'std' => '20',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Main'
			),

			/**
			 * Title
			 */

			array(
				'label' => __( 'Align', 'dslc_string' ),
				'id' => 'css_title_align',
				'std' => 'center',
				'type' => 'select',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2',
				'affect_on_change_rule' => 'text-align',
				'section' => 'styling',
				'tab' => 'Title',
				'choices' => array(
					array(
						'label' => __( 'Left', 'dslc_string' ),
						'value' => 'left',
					),
					array(
						'label' => __( 'Center', 'dslc_string' ),
						'value' => 'center',
					),
					array(
						'label' => __( 'Right', 'dslc_string' ),
						'value' => 'right',
					),
				)
			),
			array(
				'label' => __( 'Color', 'dslc_string' ),
				'id' => 'css_title_color',
				'std' => '#636363',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2 a',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Title'
			),
			array(
				'label' => __( 'Color - Hover', 'dslc_string' ),
				'id' => 'css_title_color_hover',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2:hover a,.dslc-product-title h2 a:hover',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Title'
			),
			array(
				'label' => __( 'Font Size', 'dslc_string' ),
				'id' => 'css_title_font_size',
				'std' => '12',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2,.dslc-product-title h2 a',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'Title',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'dslc_string' ),
				'id' => 'css_title_font_weight',
				'std' => '700',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2,.dslc-product-title h2 a',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => 'Title',
				'ext' => '',
				'min' => 100,
				'max' => 900,
				'increment' => 100
			),
			array(
				'label' => __( 'Font Family', 'dslc_string' ),
				'id' => 'css_title_font_family',
				'std' => 'Lato',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2,.dslc-product-title h2 a',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'Title',
			),
			array(
				'label' => __( 'Line Height', 'dslc_string' ),
				'id' => 'css_title_line_height',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2,.dslc-product-title h2 a',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => 'Title',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'dslc_string' ),
				'id' => 'css_title_margin_bottom',
				'std' => '16',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => 'Title',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Horizontal', 'dslc_string' ),
				'id' => 'css_title_margin_hor',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2 a',
				'affect_on_change_rule' => 'margin-left,margin-right',
				'section' => 'styling',
				'tab' => 'Title',
				'ext' => 'px'
			),

			/**
			 * Excerpt
			 */

			array(
				'label' => __( 'Border Bottom Color', 'dslc_string' ),
				'id' => 'css_excerpt_border_color',
				'std' => '#e8e8e8',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'border-bottom-color',
				'section' => 'styling',
				'tab' => 'Excerpt'
			),
			array(
				'label' => __( 'Border Bottom Width', 'dslc_string' ),
				'id' => 'css_excerpt_border_width',
				'std' => '1',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'border-bottom-width',
				'section' => 'styling',
				'tab' => 'Excerpt',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Color', 'dslc_string' ),
				'id' => 'css_excerpt_color',
				'std' => '#adadad',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Excerpt'
			),
			array(
				'label' => __( 'Font Size', 'dslc_string' ),
				'id' => 'css_excerpt_font_size',
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'Excerpt',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'dslc_string' ),
				'id' => 'css_excerpt_font_weight',
				'std' => '500',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => 'Excerpt',
				'ext' => '',
				'min' => 100,
				'max' => 900,
				'increment' => 100
			),
			array(
				'label' => __( 'Font Family', 'dslc_string' ),
				'id' => 'css_excerpt_font_family',
				'std' => 'Muli',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'Excerpt',
			),
			array(
				'label' => __( 'Line Height', 'dslc_string' ),
				'id' => 'css_excerpt_line_height',
				'std' => '23',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt, .dslc-product-excerpt p',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => 'Excerpt',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'dslc_string' ),
				'id' => 'excerpt_margin',
				'std' => '17',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'excerpt'
			),
			array(
				'label' => __( 'Max Length ( amount of words )', 'dslc_string' ),
				'id' => 'excerpt_length',
				'std' => '17',
				'type' => 'text',
				'section' => 'styling',
				'tab' => 'Excerpt'
			),
			array(
				'label' => __( 'Padding Bottom', 'dslc_string' ),
				'id' => 'css_excerpt_padding',
				'std' => '17',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'excerpt'
			),
			array(
				'label' => __( 'Text Align', 'dslc_string' ),
				'id' => 'css_excerpt_text_align',
				'std' => 'center',
				'type' => 'select',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'text-align',
				'section' => 'styling',
				'tab' => 'excerpt',
				'choices' => array(
					array(
						'label' => __( 'Left', 'dslc_string' ),
						'value' => 'left',
					),
					array(
						'label' => __( 'Center', 'dslc_string' ),
						'value' => 'center',
					),
					array(
						'label' => __( 'Right', 'dslc_string' ),
						'value' => 'right',
					),
				)
			),

			/**
			 * Price Secondary
			 */

			array(
				'label' => __( 'Color', 'dslc_string' ),
				'id' => 'css_price_2_color',
				'std' => '#5890e5',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title .dslc-product-price-secondary',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Price Secondary'
			),
			array(
				'label' => __( 'Color ( Non-discount price )', 'dslc_string' ),
				'id' => 'css_price_2_non_discount_color',
				'std' => '#d1d1d1',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title .dslc-product-price-secondary del',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Price Secondary'
			),
			array(
				'label' => __( 'Font Size', 'dslc_string' ),
				'id' => 'css_price_2_font_size',
				'std' => '16',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title .dslc-product-price-secondary',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'Price Secondary',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'dslc_string' ),
				'id' => 'css_price_2_font_weight',
				'std' => '400',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title .dslc-product-price-secondary',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => 'Price Secondary',
				'ext' => '',
				'min' => 100,
				'max' => 900,
				'increment' => 100
			),
			array(
				'label' => __( 'Font Family', 'dslc_string' ),
				'id' => 'css_price_2_font_family',
				'std' => 'Oswald',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title .dslc-product-price-secondary',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'Price Secondary',
			),
			array(
				'label' => __( 'Position', 'dslc_string' ),
				'id' => 'css_price_2_pos',
				'std' => 'right',
				'type' => 'select',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title .dslc-product-price-secondary',
				'affect_on_change_rule' => 'float',
				'section' => 'styling',
				'tab' => 'Price Secondary',
				'choices' => array(
					array(
						'label' => __( 'Left', 'dslc_string' ),
						'value' => 'left',
					),
					array(
						'label' => __( 'Right', 'dslc_string' ),
						'value' => 'right',
					),
				)
			),

			/**
			 * Separator
			 */

			array(
				'label' => __( 'Color', 'dslc_string' ),
				'id' => 'css_sep_color',
				'std' => '#ebebeb',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-sep',
				'affect_on_change_rule' => 'border-bottom-color',
				'section' => 'styling',
				'tab' => 'Separator'
			),
			array(
				'label' => __( 'Margin Bottom', 'dslc_string' ),
				'id' => 'css_sep_margin_bottom',
				'std' => '17',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-sep',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => 'Separator',
				'ext' => 'px'
			),

			/** 
			 * Other
			 */

			array(
				'label' => __( 'Add to cart - Text', 'dslc_string' ),
				'id' => 'addtocart_text',
				'std' => 'Add to cart',
				'type' => 'text',
				'section' => 'styling',
				'tab' => 'Other'
			),	
			array(
				'label' => __( 'Add to cart - Color', 'dslc_string' ),
				'id' => 'css_addtocart_color',
				'std' => '#5890e5',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-add-to-cart',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Other'
			),
			array(
				'label' => __( 'Add to cart - Font Size', 'dslc_string' ),
				'id' => 'css_addtocart_font_size',
				'std' => '11',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-add-to-cart',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'Other',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Add to cart - Font Weight', 'dslc_string' ),
				'id' => 'css_addtocart_font_weight',
				'std' => '700',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-add-to-cart',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => 'Other',
				'ext' => '',
				'min' => 100,
				'max' => 900,
				'increment' => 100
			),
			array(
				'label' => __( 'Add to cart - Font Family', 'dslc_string' ),
				'id' => 'css_addtocart_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-add-to-cart',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'Other',
			),
			array(
				'label' => __( 'Details - Text', 'dslc_string' ),
				'id' => 'details_text',
				'std' => 'Details',
				'type' => 'text',
				'section' => 'styling',
				'tab' => 'Other'
			),	
			array(
				'label' => __( 'Details - Color', 'dslc_string' ),
				'id' => 'css_details_color',
				'std' => '#8d8d8d',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-details',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Other'
			),
			array(
				'label' => __( 'Details - Font Size', 'dslc_string' ),
				'id' => 'css_details_font_size',
				'std' => '11',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-details',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'Other',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Details - Font Weight', 'dslc_string' ),
				'id' => 'css_details_font_weight',
				'std' => '600',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-details',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => 'Other',
				'ext' => '',
				'min' => 100,
				'max' => 900,
				'increment' => 100
			),
			array(
				'label' => __( 'Details - Font Family', 'dslc_string' ),
				'id' => 'css_details_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-details',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'Other',
			),

			/**
			 * Responsive Tablet
			 */

			array(
				'label' => __( 'Responsive', 'dslc_string' ),
				'id' => 'css_res_t',
				'std' => 'disabled',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Disabled', 'dslc_string' ),
						'value' => 'disabled'
					),
					array(
						'label' => __( 'Enabled', 'dslc_string' ),
						'value' => 'enabled'
					),
				),
				'section' => 'responsive',
				'tab' => 'tablet',
			),
			array(
				'label' => __( 'Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_t_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-products',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px',
			),
			array(
				'label' => __( 'Row Separator - Height', 'dslc_string' ),
				'id' => 'css_res_t_sep_height',
				'std' => '32',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-post-separator',
				'affect_on_change_rule' => 'margin-bottom,padding-bottom',
				'ext' => 'px',
				'min' => 1,
				'max' => 300,
				'section' => 'responsive',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Thumbnail - Padding Vertical', 'dslc_string' ),
				'id' => 'css_res_t_thumbnail_padding_vertical',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb-inner',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Thumbnail - Padding Horizontal', 'dslc_string' ),
				'id' => 'css_res_t_thumbnail_padding_horizontal',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb-inner',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Price - Font Size', 'dslc_string' ),
				'id' => 'css_res_t_price_font_size',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Price - Margin', 'dslc_string' ),
				'id' => 'css_res_t_price_margin',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'margin',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Price - Padding', 'dslc_string' ),
				'id' => 'css_res_t_price_padding',
				'std' => '24',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'padding',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Main - Padding Vertical', 'dslc_string' ),
				'id' => 'css_res_t_main_padding_vertical',
				'std' => '20',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Main - Padding Horizontal', 'dslc_string' ),
				'id' => 'css_res_t_main_padding_horizontal',
				'std' => '20',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Title - Font Size', 'dslc_string' ),
				'id' => 'css_res_t_title_font_size',
				'std' => '12',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Title - Line Height', 'dslc_string' ),
				'id' => 'css_res_t_title_line_height',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Title - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_t_title_margin_bottom',
				'std' => '16',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Title - Margin Horizontal', 'dslc_string' ),
				'id' => 'css_res_t_title_margin_hor',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2 a',
				'affect_on_change_rule' => 'margin-left,margin-right',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Excerpt - Font Size', 'dslc_string' ),
				'id' => 'css_res_t_excerpt_font_size',
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Excerpt - Line Height', 'dslc_string' ),
				'id' => 'css_res_t_excerpt_line_height',
				'std' => '23',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt, .dslc-product-excerpt p',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Excerpt - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_t_excerpt_margin',
				'std' => '17',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Excerpt - Padding Bottom', 'dslc_string' ),
				'id' => 'css_res_t_excerpt_padding',
				'std' => '17',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'padding-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Price 2nd - Font Size', 'dslc_string' ),
				'id' => 'css_res_t_price_2_font_size',
				'std' => '16',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title .dslc-product-price-secondary',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Separator - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_t_sep_margin_bottom',
				'std' => '17',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-sep',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Add to cart - Font Size', 'dslc_string' ),
				'id' => 'css_res_t_addtocart_font_size',
				'std' => '11',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-add-to-cart',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Details - Font Size', 'dslc_string' ),
				'id' => 'css_res_t_details_font_size',
				'std' => '11',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-details',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),

			/**
			 * Responsive Phone
			 */

			array(
				'label' => __( 'Responsive', 'dslc_string' ),
				'id' => 'css_res_p',
				'std' => 'disabled',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Disabled', 'dslc_string' ),
						'value' => 'disabled'
					),
					array(
						'label' => __( 'Enabled', 'dslc_string' ),
						'value' => 'enabled'
					),
				),
				'section' => 'responsive',
				'tab' => 'phone',
			),
			array(
				'label' => __( 'Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_p_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-products',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px',
			),
			array(
				'label' => __( 'Row Separator - Height', 'dslc_string' ),
				'id' => 'css_res_p_sep_height',
				'std' => '32',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-post-separator',
				'affect_on_change_rule' => 'margin-bottom,padding-bottom',
				'ext' => 'px',
				'min' => 1,
				'max' => 300,
				'section' => 'responsive',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Thumbnail - Padding Vertical', 'dslc_string' ),
				'id' => 'css_res_p_thumbnail_padding_vertical',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb-inner',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Thumbnail - Padding Horizontal', 'dslc_string' ),
				'id' => 'css_res_p_thumbnail_padding_horizontal',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb-inner',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Price - Font Size', 'dslc_string' ),
				'id' => 'css_res_p_price_font_size',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Price - Margin', 'dslc_string' ),
				'id' => 'css_res_p_price_margin',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'margin',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Price - Padding', 'dslc_string' ),
				'id' => 'css_res_p_price_padding',
				'std' => '24',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-thumb .dslc-product-price',
				'affect_on_change_rule' => 'padding',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Main - Padding Vertical', 'dslc_string' ),
				'id' => 'css_res_p_main_padding_vertical',
				'std' => '20',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Main - Padding Horizontal', 'dslc_string' ),
				'id' => 'css_res_p_main_padding_horizontal',
				'std' => '20',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-main',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Title - Font Size', 'dslc_string' ),
				'id' => 'css_res_p_title_font_size',
				'std' => '12',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Title - Line Height', 'dslc_string' ),
				'id' => 'css_res_p_title_line_height',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Title - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_p_title_margin_bottom',
				'std' => '16',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Title - Margin Horizontal', 'dslc_string' ),
				'id' => 'css_res_p_title_margin_hor',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title h2 a',
				'affect_on_change_rule' => 'margin-left,margin-right',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Excerpt - Font Size', 'dslc_string' ),
				'id' => 'css_res_p_excerpt_font_size',
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Excerpt - Line Height', 'dslc_string' ),
				'id' => 'css_res_p_excerpt_line_height',
				'std' => '23',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt, .dslc-product-excerpt p',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Excerpt - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_p_excerpt_margin',
				'std' => '17',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Excerpt - Padding Bottom', 'dslc_string' ),
				'id' => 'css_res_p_excerpt_padding',
				'std' => '17',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-excerpt',
				'affect_on_change_rule' => 'padding-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Price 2nd - Font Size', 'dslc_string' ),
				'id' => 'css_res_p_price_2_font_size',
				'std' => '16',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-title .dslc-product-price-secondary',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Separator - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_p_sep_margin_bottom',
				'std' => '17',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-sep',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Add to cart - Font Size', 'dslc_string' ),
				'id' => 'css_res_p_addtocart_font_size',
				'std' => '11',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-add-to-cart',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Details - Font Size', 'dslc_string' ),
				'id' => 'css_res_p_details_font_size',
				'std' => '11',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-product-extra .dslc-product-details',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),

		);

		$dslc_options = array_merge( $dslc_options, $this->heading_options );
		$dslc_options = array_merge( $dslc_options, $this->filters_options );
		$dslc_options = array_merge( $dslc_options, $this->carousel_arrows_options );
		$dslc_options = array_merge( $dslc_options, $this->carousel_circles_options );
		$dslc_options = array_merge( $dslc_options, $this->pagination_options );
		return $dslc_options;

	}

	function output( $options ) {

		global $dslc_active;

		if ( $dslc_active && is_user_logged_in() && current_user_can( DS_LIVE_COMPOSER_CAPABILITY ) )
			$dslc_is_admin = true;
		else
			$dslc_is_admin = false;		

		$this->module_start( $options );

		if ( ! isset( $options['price_pos'] ) )
			$options['price_pos'] = 'center';

		if ( class_exists( 'Woocommerce' ) ) :

			/* Module output stars here */

				if ( $options['orderby'] == 'price' ) {
					$options['orderby'] = 'meta_value_num';
					$orderby = 'price';
				}

				if( is_front_page() ) { $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; } else { $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; }
				$args = array(
					'paged' => $paged, 
					'post_type' => 'product',
					'posts_per_page' => $options['amount'],
					'order' => $options['order'],
					'orderby' => $options['orderby'],
					'offset' => $options['offset']
				);

				if ( isset( $options['categories'] ) && $options['categories'] != '' ) {
					
					$cats_array = explode( ' ', trim( $options['categories'] ));

					$args['tax_query'] = array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'slug',
							'terms' => $cats_array
						)
					);
					
				}

				if ( isset( $orderby ) && $orderby == 'price' ) {				

					$args['meta_key'] = '_price';

				}

				$dslc_query = new WP_Query( $args );

				$columns_class = 'dslc-col dslc-' . $options['columns'] . '-col ';
				$count = 0;
				$real_count = 0;
				$increment = $options['columns'];
				$max_count = 12;

			/**
			 * Elements to show
			 */
				
				// Main Elements
				$elements = $options['elements'];
				if ( ! empty( $elements ) )
					$elements = explode( ' ', trim( $elements ) );
				else
					$elements = array();
				

				// Post Elements
				$post_elements = $options['post_elements'];
				if ( ! empty( $post_elements ) )
					$post_elements = explode( ' ', trim( $post_elements ) );
				else
					$post_elements = 'all';

				// Carousel Elements
				$carousel_elements = $options['carousel_elements'];
				if ( ! empty( $carousel_elements ) )
					$carousel_elements = explode( ' ', trim( $carousel_elements ) );
				else
					$carousel_elements = array();

				/* Container Class */

				$container_class = 'dslc-posts dslc-products dslc-clearfix dslc-products-type-' . $options['type'] . ' ';

				if ( $options['type'] == 'masonry' )
					$container_class .= 'dslc-init-masonry ';
				elseif ( $options['type'] == 'grid' )
					$container_class .= 'dslc-init-grid ';

				/* Element Class */

				$element_class = 'dslc-post dslc-product ';

				if ( $options['type'] == 'masonry' )
					$element_class .= 'dslc-masonry-item ';
				elseif ( $options['type'] == 'carousel' )
					$element_class .= 'dslc-carousel-item ';

				// Responsive
				//$element_class .= 'dslc-res-sm-' . $options['res_sm_columns'] . ' ';
				//$element_class .= 'dslc-res-tp-' . $options['res_tp_columns'] . ' ';

			/**
			 * What is shown
			 */

				$show_header = false;
				$show_heading = false;
				$show_filters = false;
				$show_carousel_arrows = false;
				$show_view_all_link = false;

				if ( in_array( 'main_heading', $elements ) )
					$show_heading = true;		

				if ( ( $elements == 'all' || in_array( 'filters', $elements ) ) && $options['type'] !== 'carousel' )
					$show_filters = true;

				if ( $options['type'] == 'carousel' && in_array( 'arrows', $carousel_elements ) )
					$show_carousel_arrows = true;

				if ( $show_heading || $show_filters || $show_carousel_arrows )
					$show_header = true;

			/**
			 * Carousel Items
			 */
			
				switch ( $options['columns'] ) {
					case 12 :
						$carousel_items = 1;
						break;
					case 6 :
						$carousel_items = 2;
						break;
					case 4 :
						$carousel_items = 3;
						break;
					case 3 :
						$carousel_items = 4;
						break;
					case 2 :
						$carousel_items = 6;
						break;
					default:
						$carousel_items = 6;
						break;
				}

			/**
			 * Heading ( output )
			 */

				if ( $show_header ) :
					?>
						<div class="dslc-module-heading">
							
							<!-- Heading -->

							<?php if ( $show_heading ) : ?>

								<h2 class="dslca-editable-content" data-id="main_heading_title" data-type="simple" <?php if ( $dslc_is_admin ) echo 'contenteditable'; ?> ><?php echo $options['main_heading_title']; ?></h2>

								<!-- View all -->

								<?php if ( isset( $options['view_all_link'] ) && $options['view_all_link'] !== '' ) : ?>

									<span class="dslc-module-heading-view-all"><a href="<?php echo $options['view_all_link']; ?>" class="dslca-editable-content" data-id="main_heading_link_title" data-type="simple" <?php if ( $dslc_is_admin ) echo 'contenteditable'; ?> ><?php echo $options['main_heading_link_title']; ?></a></span>

								<?php endif; ?>

							<?php endif; ?>

							<!-- Filters -->

							<?php

								if ( $show_filters ) {

									$cats_array = array();

									if ( $dslc_query->have_posts() ) {

										while ( $dslc_query->have_posts() ) {

											$dslc_query->the_post(); 

											$post_cats = get_the_terms( get_the_ID(), 'product_cat' );
											if ( ! empty( $post_cats ) ) {
												foreach( $post_cats as $post_cat ) {
													$cats_array[$post_cat->slug] = $post_cat->name;
												}
											}

										}

									}

									?>

										<div class="dslc-post-filters">

											<span class="dslc-post-filter dslc-active" data-id=" "><?php _e( 'All', 'Post Filter', 'dslc_string' ); ?></span>

											<?php foreach ( $cats_array as $cat_slug => $cat_name ) : ?>
												<span class="dslc-post-filter dslc-inactive" data-id="<?php echo $cat_slug; ?>"><?php echo $cat_name; ?></span>
											<?php endforeach; ?>

										</div><!-- .dslc-post-filters -->

									<?php

								}

							?>

							<!-- Carousel -->

							<?php if ( $show_carousel_arrows ) : ?>
								<span class="dslc-carousel-nav fr">
									<span class="dslc-carousel-nav-inner">
										<a href="#" class="dslc-carousel-nav-prev"><span class="dslc-icon-chevron-left dslc-init-center"></span></a>
										<a href="#" class="dslc-carousel-nav-next"><span class="dslc-icon-chevron-right dslc-init-center"></span></a>
									</span>
								</span><!-- .carousel-nav -->
							<?php endif; ?>

						</div><!-- .dslc-module-heading -->
					<?php

				endif;

			/**
			 * Posts ( output )
			 */

				if ( $dslc_query->have_posts() ) :

					?><div class="<?php echo $container_class; ?>"><?php

						if ( $options['type'] == 'carousel' ) :

							?><div class="dslc-loader"></div><div class="dslc-carousel" data-columns="<?php echo $carousel_items; ?>" data-pagination="<?php if ( in_array( 'circles', $carousel_elements ) ) echo 'true'; else echo 'false'; ?>"><?php

						endif;

						while ( $dslc_query->have_posts() ) : $dslc_query->the_post(); $count += $increment; $real_count++;

							global $product;

							if ( $count == $max_count ) {
								$count = 0;
								$extra_class = ' dslc-last-col';
							} elseif ( $count == $increment ) {
								$extra_class = ' dslc-first-col';
							} else {
								$extra_class = '';
							}


							$post_cats = get_the_terms( get_the_ID(), 'product_cat' );
							$post_cats_data = '';
							if ( ! empty( $post_cats ) ) {
								foreach( $post_cats as $post_cat ) {
									$post_cats_data .= $post_cat->slug . ' ';
								}
							}

							?>

							<div class="<?php echo $element_class . $columns_class . $extra_class; ?>" data-cats="<?php echo $post_cats_data; ?>">

								<?php if ( $post_elements == 'all' || in_array( 'thumbnail', $post_elements ) ) : ?>

									<div class="dslc-product-thumb">

										<?php
											$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 
											$thumb_url = $thumb_url[0];
										?>


										<div class="dslc-product-thumb-inner dslca-post-thumb">

											<?php if ( isset( $options['thumb_resize_height'] ) && ! empty( $options['thumb_resize_height'] ) ) : ?>
												<a href="<?php the_permalink(); ?>"><img src="<?php $res_img = dslc_aq_resize( $thumb_url, $options['thumb_resize_width'], $options['thumb_resize_height'], true ); echo $res_img; ?>" /></a>
											<?php else : ?>
												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
											<?php endif; ?>

											<?php if ( $post_elements == 'all' || in_array( 'price', $post_elements ) ) : ?>
												<a href="<?php echo do_shortcode( '[add_to_cart_url id="' . get_the_ID() . '"]' ); ?>" class="dslc-product-price dslc-init-square dslc-init-<?php echo $options['price_pos']; ?>"><span class="dslc-product-price-bg"></span><span class="dslc-product-price-main"><?php echo $product->get_price_html(); ?></span></a>
											<?php endif; ?>

										</div><!-- .dslc-product-thumb-inner -->

									</div><!-- .dslc-product-thumb -->

								<?php endif; ?>

								<div class="dslc-product-main">					

									<?php if ( $post_elements == 'all' || in_array( 'title', $post_elements ) ) : ?>

										<div class="dslc-product-title dslc-clearfix">
											<?php if ( $post_elements == 'all' || in_array( 'price_2', $post_elements ) ) : ?>
												<span class="dslc-product-price-secondary"><?php echo $product->get_price_html(); ?></span>
											<?php endif; ?>
											<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										</div><!-- .dslc-product-title -->

									<?php endif; ?>

									<?php if ( $post_elements == 'all' || in_array( 'separator', $post_elements ) ) : ?>

										<span class="dslc-product-sep"></span>

									<?php endif; ?>

									<?php if ( $post_elements == 'all' || in_array( 'excerpt', $post_elements ) ) : ?>

										<div class="dslc-product-excerpt">
											<?php echo wp_trim_words( get_the_excerpt(), $options['excerpt_length'] ); ?>
										</div><!-- .dslc-product-excerpt -->

									<?php endif; ?>

									<div class="dslc-product-extra dslc-clearfix">

										<?php if ( $post_elements == 'all' || in_array( 'addtocart', $post_elements ) ) : ?>
											<a href="<?php echo do_shortcode( '[add_to_cart_url id="' . get_the_ID() . '"]' ); ?>" class="dslc-product-add-to-cart"><span class="dslc-icon dslc-icon-shopping-cart"></span><?php echo $options['addtocart_text']; ?></a>
										<?php endif; ?>

										<?php if ( $post_elements == 'all' || in_array( 'details', $post_elements ) ) : ?>
											<a href="<?php the_permalink(); ?>" class="dslc-product-details"><span class="dslc-icon dslc-icon-file-text"></span><?php echo $options['details_text']; ?></a>
										<?php endif; ?>

									</div><!-- .dslc-product-extra -->

								</div><!-- .dslc-product-main -->

							</div><!-- .dslc-product -->

							<?php

							// Row Separator
							if ( $options['type'] == 'grid' && $count == 0 && $real_count != $dslc_query->found_posts && $real_count != $options['amount'] ) {
								echo '<div class="dslc-post-separator"></div>';
							}

						endwhile;

						if ( $options['type'] == 'carousel' ) :

							?></div><?php

						endif;

					?></div><?php

				else :

					if ( $dslc_is_admin ) :
						?><div class="dslc-notification dslc-red">You do not have products at the moment. Go to <strong>WP Admin &rarr; Products</strong> to add some. <span class="dslca-refresh-module-hook dslc-icon dslc-icon-refresh"></span></span></div><?php
					endif;

				endif;

			else :

				if ( $dslc_is_admin ) :
					?><div class="dslc-notification dslc-red">You do not have WooCommerce installed at the moment. You need to install it to use this module. <span class="dslca-refresh-module-hook dslc-icon dslc-icon-refresh"></span></span></div><?php
				endif;

			endif;

			/**
			 * Pagination
			 */
			
			if ( isset( $options['pagination_type'] ) && $options['pagination_type'] == 'numbered' ) {
				$num_pages = $dslc_query->max_num_pages;
				dslc_post_pagination( array( 'pages' => $num_pages ) ); 
			}

			wp_reset_query();

		/* Module output ends here */

		$this->module_end( $options );

	}

}