<?php

if ( dslc_is_module_active( 'DSLC_Galleries' ) )
	include DS_LIVE_COMPOSER_ABS . '/modules/galleries/functions.php';

class DSLC_Galleries extends DSLC_Module {

	var $module_id = 'DSLC_Galleries';
	var $module_title = 'Galleries';
	var $module_icon = 'picture';
	var $module_category = 'posts';

	function options() {

		$cats = get_terms( 'dslc_galleries_cats' );
		$cats_choices = array();

		foreach ( $cats as $cat ) {
			$cats_choices[] = array(
				'label' => $cat->name,
				'value' => $cat->slug
			);
		}

		$dslc_options = array(
			array(
				'label' => __( 'Type', 'dslc_string' ),
				'id' => 'type',
				'std' => 'masonry',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Grid', 'dslc_string' ),
						'value' => 'grid'
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
				'label' => __( 'Posts Per Row', 'dslc_string' ),
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

			array(
				'label' => __( 'Thumbnail - Link Behaviour', 'dslc_string' ),
				'id' => 'thumb_link_behaviour',
				'std' => 'regular',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Normal', 'dslc_string' ),
						'value' => 'regular'
					),
					array(
						'label' => __( 'Lightbox', 'dslc_string' ),
						'value' => 'lightbox'
					)
				),
				'tab' => 'other'
			),
			array(
				'label' => __( 'Title - Link Behaviour', 'dslc_string' ),
				'id' => 'title_link_behaviour',
				'std' => 'regular',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Normal', 'dslc_string' ),
						'value' => 'regular'
					),
					array(
						'label' => __( 'Lightbox', 'dslc_string' ),
						'value' => 'lightbox'
					)
				),
				'tab' => 'other'
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
				'std' => 'thumbnail count title separator excerpt',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Thumbnail', 'dslc_string' ),
						'value' => 'thumbnail',
					),
					array(
						'label' => __( 'Count', 'dslc_string' ),
						'value' => 'count',
					),
					array(
						'label' => __( 'Title', 'dslc_string' ),
						'value' => 'title',
					),
					array(
						'label' => __( 'Separator', 'dslc_string' ),
						'value' => 'separator'
					),
					array(
						'label' => __( 'Excerpt', 'dslc_string' ),
						'value' => 'excerpt'
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
				'affect_on_change_el' => '.dslc-galleries',
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
				'std' => '#ffffff',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => 'Thumbnail'
			),			
			array(
				'label' => __( 'Border Color', 'dslc_string' ),
				'id' => 'css_thumb_border_color',
				'std' => '#dbdbdb',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb-inner',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => 'Thumbnail'
			),
			array(
				'label' => __( 'Border Width', 'dslc_string' ),
				'id' => 'css_thumb_border_width',
				'std' => '1',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb-inner',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Thumbnail'
			),
			array(
				'label' => __( 'Borders', 'dslc_string' ),
				'id' => 'css_thumb_border_trbl',
				'std' => 'top right left',
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
				'affect_on_change_el' => '.dslc-gallery-thumb-inner',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => 'Thumbnail',
			),	
			array(
				'label' => __( 'Border Radius - Top', 'dslc_string' ),
				'id' => 'css_thumbnail_border_radius_top',
				'std' => '3',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb-inner, .dslc-gallery-thumb img',
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
				'affect_on_change_el' => '.dslc-gallery-thumb-inner, .dslc-gallery-thumb img',
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
				'affect_on_change_el' => '.dslc-gallery-thumb',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Thumbnail'
			),
			array(
				'label' => __( 'Padding Vertical', 'dslc_string' ),
				'id' => 'css_thumbnail_padding_vertical',
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb-inner',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Thumbnail'
			),
			array(
				'label' => __( 'Padding Horizontal', 'dslc_string' ),
				'id' => 'css_thumbnail_padding_horizontal',
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb-inner',
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
			 * Count
			 */

			array(
				'label' => __( 'BG Color', 'dslc_string' ),
				'id' => 'css_count_bg_color',
				'std' => '#0f54bd',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-bg',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => 'Count'
			),
			array(
				'label' => __( 'Border Color', 'dslc_string' ),
				'id' => 'css_count_border_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-bg',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => 'Count'
			),
			array(
				'label' => __( 'Border Width', 'dslc_string' ),
				'id' => 'css_count_border_width',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-bg',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Count'
			),
			array(
				'label' => __( 'Borders', 'dslc_string' ),
				'id' => 'css_count_border_trbl',
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
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-bg',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => 'Count',
			),
			array(
				'label' => __( 'Border Radius', 'dslc_string' ),
				'id' => 'css_count_border_radius',
				'std' => '100',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-bg',
				'affect_on_change_rule' => 'border-radius',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Count'
			),
			array(
				'label' => __( 'Margin', 'dslc_string' ),
				'id' => 'css_count_margin',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count',
				'affect_on_change_rule' => 'margin',
				'section' => 'styling',
				'tab' => 'Count',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Opacity', 'dslc_string' ),
				'id' => 'css_count_bg_opacity',
				'std' => '0.6',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-bg',
				'affect_on_change_rule' => 'opacity',
				'section' => 'styling',
				'tab' => 'Count',
				'min' => 0,
				'max' => 1,
				'increment' => 0.01
			),
			array(
				'label' => __( 'Position', 'dslc_string' ),
				'id' => 'count_pos',
				'std' => 'center',
				'type' => 'select',
				'section' => 'styling',
				'tab' => 'Count',
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
			array(
				'label' => __( 'Padding', 'dslc_string' ),
				'id' => 'css_count_padding',
				'std' => '20',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count',
				'affect_on_change_rule' => 'padding',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Count'
			),
			array(
				'label' => __( 'Count - Color', 'dslc_string' ),
				'id' => 'css_count_num_color',
				'std' => '#ffffff',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-num',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Count'
			),
			array(
				'label' => __( 'Count - Font Size', 'dslc_string' ),
				'id' => 'css_count_num_font_size',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-num',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'Count',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Count - Font Weight', 'dslc_string' ),
				'id' => 'css_count_num_font_weight',
				'std' => '400',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-num',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => 'Count',
				'ext' => '',
				'min' => 100,
				'max' => 900,
				'increment' => 100
			),
			array(
				'label' => __( 'Count - Font Family', 'dslc_string' ),
				'id' => 'css_count_num_color_font_family',
				'std' => 'Roboto',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-num',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'Count',
			),
			array(
				'label' => __( 'Count - Margin Bottom', 'dslc_string' ),
				'id' => 'css_count_num_margin_bottom',
				'std' => '8',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-num',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => 'Count',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Text', 'dslc_string' ),
				'id' => 'count_text',
				'std' => 'IMAGES',
				'type' => 'text',
				'section' => 'styling',
				'tab' => 'Count',
			),
			array(
				'label' => __( 'Text - Color', 'dslc_string' ),
				'id' => 'css_count_txt_color',
				'std' => '#fff',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-txt',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Count'
			),
			array(
				'label' => __( 'Text - Font Size', 'dslc_string' ),
				'id' => 'css_count_txt_font_size',
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-txt',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'Count',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Text - Font Weight', 'dslc_string' ),
				'id' => 'css_count_txt_font_weight',
				'std' => '400',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-txt',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => 'Count',
				'ext' => '',
				'min' => 100,
				'max' => 900,
				'increment' => 100
			),
			array(
				'label' => __( 'Text - Font Family', 'dslc_string' ),
				'id' => 'css_count_txt_color_font_family',
				'std' => 'Bitter',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-txt',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'Count',
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
				'affect_on_change_el' => '.dslc-gallery-main',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => 'Main'
			),
			array(
				'label' => __( 'Border Color', 'dslc_string' ),
				'id' => 'css_main_border_color',
				'std' => '#dbdbdb',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-main',
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
				'affect_on_change_el' => '.dslc-gallery-main',
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
				'affect_on_change_el' => '.dslc-gallery-main',
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
				'affect_on_change_el' => '.dslc-gallery-main',
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
				'affect_on_change_el' => '.dslc-gallery-main',
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
				'affect_on_change_el' => '.dslc-gallery-main',
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
				'affect_on_change_el' => '.dslc-gallery-main',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Main'
			),
			array(
				'label' => __( 'Padding Horizontal', 'dslc_string' ),
				'id' => 'css_main_padding_horizontal',
				'std' => '35',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-main',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'Main'
			),
			array(
				'label' => __( 'Text Align', 'dslc_string' ),
				'id' => 'css_main_text_align',
				'std' => 'center',
				'type' => 'select',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-main',
				'affect_on_change_rule' => 'text-align',
				'section' => 'styling',
				'tab' => 'Main',
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
			 * Title
			 */

			array(
				'label' => __( 'Color', 'dslc_string' ),
				'id' => 'css_title_color',
				'std' => '#7d7d7d',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title h2 a',
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
				'affect_on_change_el' => '.dslc-gallery-title h2:hover a',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Title'
			),
			array(
				'label' => __( 'Font Size', 'dslc_string' ),
				'id' => 'css_title_font_size',
				'std' => '18',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title h2,.dslc-gallery-title h2 a',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'Title',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'dslc_string' ),
				'id' => 'css_title_font_weight',
				'std' => '400',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title h2,.dslc-gallery-title h2 a',
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
				'std' => 'Raleway',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title h2,.dslc-gallery-title h2 a',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'Title',
			),
			array(
				'label' => __( 'Line Height', 'dslc_string' ),
				'id' => 'title_line_height',
				'std' => '24',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title h2,.dslc-gallery-title h2 a',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => 'Title',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'dslc_string' ),
				'id' => 'css_title_margin_bottom',
				'std' => '18',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => 'Title',
				'ext' => 'px'
			),

			/**
			 * Separator
			 */

			array(
				'label' => __( 'Color', 'dslc_string' ),
				'id' => 'css_sep_color',
				'std' => '#e3e3e3',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-sep',
				'affect_on_change_rule' => 'border-bottom-color',
				'section' => 'styling',
				'tab' => 'Separator'
			),
			array(
				'label' => __( 'Margin Bottom', 'dslc_string' ),
				'id' => 'css_sep_margin_bottom',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-sep',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => 'Separator',
				'ext' => 'px'
			),

			/**
			 * Excerpt
			 */

			array(
				'label' => __( 'Color', 'dslc_string' ),
				'id' => 'css_excerpt_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-excerpt',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'Excerpt'
			),
			array(
				'label' => __( 'Font Size', 'dslc_string' ),
				'id' => 'css_excerpt_font_size',
				'std' => '12',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-excerpt',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'Excerpt',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'dslc_string' ),
				'id' => 'css_excerpt_font_weight',
				'std' => '400',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-excerpt',
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
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-excerpt',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'Excerpt',
			),
			array(
				'label' => __( 'Line Height', 'dslc_string' ),
				'id' => 'css_excerpt_line_height',
				'std' => '22',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-excerpt',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => 'Excerpt',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Max Length ( amount of words )', 'dslc_string' ),
				'id' => 'excerpt_length',
				'std' => '25',
				'type' => 'text',
				'section' => 'styling',
				'tab' => 'Excerpt'
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
				'affect_on_change_el' => '.dslc-galleries',
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
				'label' => __( 'Thumbnail - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_t_thumbnail_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Thumbnail - Padding Vertical', 'dslc_string' ),
				'id' => 'css_res_t_thumbnail_padding_vertical',
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb-inner',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Thumbnail - Padding Horizontal', 'dslc_string' ),
				'id' => 'css_res_t_thumbnail_padding_horizontal',
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb-inner',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Count Margin', 'dslc_string' ),
				'id' => 'css_res_t_count_margin',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count',
				'affect_on_change_rule' => 'margin',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Count Padding', 'dslc_string' ),
				'id' => 'css_res_t_count_padding',
				'std' => '20',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count',
				'affect_on_change_rule' => 'padding',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Count Num - Font Size', 'dslc_string' ),
				'id' => 'css_res_t_count_num_font_size',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-num',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Count Num - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_t_count_num_margin_bottom',
				'std' => '8',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-num',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Count Text - Font Size', 'dslc_string' ),
				'id' => 'css_res_t_count_txt_font_size',
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-txt',
				'affect_on_change_rule' => 'font-size',
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
				'affect_on_change_el' => '.dslc-gallery-main',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Main - Padding Horizontal', 'dslc_string' ),
				'id' => 'css_res_t_main_padding_horizontal',
				'std' => '35',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-main',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'tablet'
			),
			array(
				'label' => __( 'Title - Font Size', 'dslc_string' ),
				'id' => 'css_res_t_title_font_size',
				'std' => '18',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title h2,.dslc-gallery-title h2 a',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Title - Line Height', 'dslc_string' ),
				'id' => 'css_res_t_title_line_height',
				'std' => '24',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title h2,.dslc-gallery-title h2 a',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Title - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_t_title_margin_bottom',
				'std' => '18',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Separator - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_t_sep_margin_bottom',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-sep',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Excerpt - Font Size', 'dslc_string' ),
				'id' => 'css_res_t_excerpt_font_size',
				'std' => '12',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-excerpt',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Excerpt - Line Height', 'dslc_string' ),
				'id' => 'css_res_t_excerpt_line_height',
				'std' => '22',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-excerpt',
				'affect_on_change_rule' => 'line-height',
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
				'affect_on_change_el' => '.dslc-galleries',
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
				'label' => __( 'Thumbnail - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_p_thumbnail_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Thumbnail - Padding Vertical', 'dslc_string' ),
				'id' => 'css_res_p_thumbnail_padding_vertical',
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb-inner',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Thumbnail - Padding Horizontal', 'dslc_string' ),
				'id' => 'css_res_p_thumbnail_padding_horizontal',
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb-inner',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Count Margin', 'dslc_string' ),
				'id' => 'css_res_p_count_margin',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count',
				'affect_on_change_rule' => 'margin',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Count Padding', 'dslc_string' ),
				'id' => 'css_res_p_count_padding',
				'std' => '20',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count',
				'affect_on_change_rule' => 'padding',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Count Num - Font Size', 'dslc_string' ),
				'id' => 'css_res_p_count_num_font_size',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-num',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Count Num - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_p_count_num_margin_bottom',
				'std' => '8',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-num',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Count Text - Font Size', 'dslc_string' ),
				'id' => 'css_res_p_count_txt_font_size',
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-thumb .dslc-gallery-images-count-txt',
				'affect_on_change_rule' => 'font-size',
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
				'affect_on_change_el' => '.dslc-gallery-main',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Main - Padding Horizontal', 'dslc_string' ),
				'id' => 'css_res_p_main_padding_horizontal',
				'std' => '35',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-main',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'ext' => 'px',
				'tab' => 'phone'
			),
			array(
				'label' => __( 'Title - Font Size', 'dslc_string' ),
				'id' => 'css_res_p_title_font_size',
				'std' => '18',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title h2,.dslc-gallery-title h2 a',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Title - Line Height', 'dslc_string' ),
				'id' => 'css_res_p_title_line_height',
				'std' => '24',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title h2,.dslc-gallery-title h2 a',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Title - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_p_title_margin_bottom',
				'std' => '18',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-title',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Separator - Margin Bottom', 'dslc_string' ),
				'id' => 'css_res_p_sep_margin_bottom',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-sep',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Excerpt - Font Size', 'dslc_string' ),
				'id' => 'css_res_p_excerpt_font_size',
				'std' => '12',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-excerpt',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => __( 'Excerpt - Line Height', 'dslc_string' ),
				'id' => 'css_res_p_excerpt_line_height',
				'std' => '22',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-gallery-excerpt',
				'affect_on_change_rule' => 'line-height',
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

		return apply_filters( 'dslc_module_options', $dslc_options, $this->module_id );

	}

	function output( $options ) {

		global $dslc_active;

		if ( $dslc_active && is_user_logged_in() && current_user_can( DS_LIVE_COMPOSER_CAPABILITY ) )
			$dslc_is_admin = true;
		else
			$dslc_is_admin = false;

		$this->module_start( $options );

		if ( ! isset( $options['count_pos'] ) )
			$options['count_pos'] = 'center';

		/* Module output stars here */

			if ( ! isset( $options['excerpt_length'] ) ) $options['excerpt_length'] = 20;

			if( is_front_page() ) { $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; } else { $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; }
			$args = array(
				'paged' => $paged, 
				'post_type' => 'dslc_galleries',
				'posts_per_page' => $options['amount'],
				'order' => $options['order'],
				'orderby' => $options['orderby'],
				'offset' => $options['offset']
			);

			if ( isset( $options['categories'] ) && $options['categories'] != '' ) {
				
				$cats_array = explode( ' ', trim( $options['categories'] ));

				$args['tax_query'] = array(
					array(
						'taxonomy' => 'dslc_galleries_cats',
						'field' => 'slug',
						'terms' => $cats_array
					)
				);
				
			}

			$dslc_query = new WP_Query( $args );

			$wrapper_class = '';
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

			$container_class = 'dslc-posts dslc-galleries dslc-clearfix ';

			if ( $options['type'] == 'masonry' )
				$container_class .= 'dslc-init-masonry ';
			elseif ( $options['type'] == 'carousel' )
				$container_class .= 'dslc-init-carousel ';
			elseif ( $options['type'] == 'grid' )
				$container_class .= 'dslc-init-grid ';

			/* Element Class */

			$element_class = 'dslc-post dslc-gallery ';

			if ( $options['type'] == 'masonry' )
				$element_class .= 'dslc-masonry-item ';
			elseif ( $options['type'] == 'carousel' )
				$element_class .= 'dslc-carousel-item ';

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

										$post_cats = get_the_terms( get_the_ID(), 'dslc_galleries_cats' );
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

						if ( $count == $max_count ) {
							$count = 0;
							$extra_class = ' dslc-last-col';
						} elseif ( $count == $increment ) {
							$extra_class = ' dslc-first-col';
						} else {
							$extra_class = '';
						}

						$gallery_images = get_post_meta( get_the_ID(), 'dslc_gallery_images', true );
						$gallery_images_count = 0;
						
						if ( $gallery_images )
							$gallery_images = explode( ' ', trim( $gallery_images ) );

						if ( is_array( $gallery_images ) ) {
							$gallery_images_count = count( $gallery_images );
						}

						$post_cats = get_the_terms( get_the_ID(), 'dslc_galleries_cats' );
						$post_cats_data = '';
						if ( ! empty( $post_cats ) ) {
							foreach( $post_cats as $post_cat ) {
								$post_cats_data .= $post_cat->slug . ' ';
							}
						}

						$thumb_anchor_class = '';
						$title_anchor_class = '';

						if ( $options['title_link_behaviour'] == 'lightbox' ) {
							$title_anchor_class = 'dslc-trigger-lightbox-gallery';
						}

						if ( $options['thumb_link_behaviour'] == 'lightbox' ) {
							$thumb_anchor_class = 'dslc-trigger-lightbox-gallery';
						}

						?>

						<div class="<?php echo $element_class . $columns_class . $extra_class; ?>" data-cats="<?php echo $post_cats_data; ?>">

							<?php if ( $post_elements == 'all' || in_array( 'thumbnail', $post_elements ) ) : ?>

								<div class="dslc-gallery-thumb">

									<div class="dslc-gallery-thumb-inner dslca-post-thumb">

										<?php
											$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 
											$thumb_url = $thumb_url[0];
										?>
									
										<?php if ( isset( $options['thumb_resize_height'] ) && ! empty( $options['thumb_resize_height'] ) ) : ?>
											<a href="<?php the_permalink(); ?>" class="<?php echo $thumb_anchor_class; ?>"><img src="<?php $res_img = dslc_aq_resize( $thumb_url, $options['thumb_resize_width'], $options['thumb_resize_height'], true ); echo $res_img; ?>" /></a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>" class="<?php echo $thumb_anchor_class; ?>"><?php the_post_thumbnail( 'full' ); ?></a>
										<?php endif; ?>

										<?php if ( $post_elements == 'all' || in_array( 'count', $post_elements ) ) : ?>
											<a href="<?php the_permalink(); ?>" class="<?php echo $thumb_anchor_class; ?> dslc-gallery-images-count dslc-init-square dslc-init-<?php echo $options['count_pos']; ?>">
												<span class="dslc-gallery-images-count-bg"></span>
												<span class="dslc-gallery-images-count-main">
													<span class="dslc-gallery-images-count-num"><?php echo $gallery_images_count; ?></span>
													<span class="dslc-gallery-images-count-txt"><?php echo $options['count_text']; ?></span>
												</span>
											</a><!-- .dslc-gallery-images-count -->
										<?php endif; ?>

									</div><!-- .dslc-gallery-thumb-inner -->

								</div><!-- .dslc-gallery-thumb -->

							<?php endif; ?>

							<?php if ( $post_elements == 'all' || in_array( 'title', $post_elements ) || in_array( 'excerpt', $post_elements ) ) : ?>

								<div class="dslc-gallery-main">

									<?php if ( $post_elements == 'all' || in_array( 'title', $post_elements ) ) : ?>

										<div class="dslc-gallery-title">
											<h2><a href="<?php the_permalink(); ?>" class="<?php echo $title_anchor_class; ?>"><?php the_title(); ?></a></h2>
										</div><!-- .dslc-gallery-title -->

									<?php endif; ?>

									<?php if ( $post_elements == 'all' || in_array( 'separator', $post_elements ) ) : ?>
										<span class="dslc-gallery-sep"></span>
									<?php endif; ?>									

									<?php if ( $post_elements == 'all' || in_array( 'excerpt', $post_elements ) ) : ?>

										<div class="dslc-gallery-excerpt">
											<?php echo wp_trim_words( get_the_excerpt(), $options['excerpt_length'] ); ?>
										</div><!-- .dslc-gallery-excerpt -->

									<?php endif; ?>

								</div><!-- .dslc-gallery-main -->

							<?php endif; ?>

							<?php if ( $gallery_images_count > 0 ) : ?>

								<div class="dslc-lightbox-gallery">
									
									<?php foreach ( $gallery_images as $gallery_image ) : ?>

										<?php
											$gallery_image_src = wp_get_attachment_image_src( $gallery_image, 'full' );
											$gallery_image_src = $gallery_image_src[0];
										?>

										<a href="<?php echo $gallery_image_src; ?>"></a>

									<?php endforeach; ?>

								</div><!-- .dslc-gallery-lightbox -->

							<?php endif; ?>

						</div><!-- .dslc-gallery -->

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
					?><div class="dslc-notification dslc-red">You do not have any galleries at the moment. Go to <strong>WP Admin &rarr; Galleries</strong> to add some. <span class="dslca-refresh-module-hook dslc-icon dslc-icon-refresh"></span></span></div><?php
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