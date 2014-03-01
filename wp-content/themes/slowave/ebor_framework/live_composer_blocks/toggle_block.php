<?php

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Accordion" );')
);

class Slowave_Accordion extends DSLC_Module {

	var $module_id = 'Slowave_Accordion';
	var $module_title = 'Slowave Accordion';
	var $module_icon = 'reorder';
	var $module_category = 'Slowave - Tabs';

	function options() {	

		$dslc_options = array(

			array(
				'label' => '(hidden) Accordion Content',
				'id' => 'accordion_content',
				'std' => '',
				'type' => 'textarea',
				'visibility' => 'hidden',
				'section' => 'styling',
			),
			array(
				'label' => '(hidden) Accordion Nav',
				'id' => 'accordion_nav',
				'std' => '',
				'type' => 'textarea',
				'visibility' => 'hidden',
				'section' => 'styling',
			),

			/**
			 * General
			 */

			array(
				'label' => 'BG Color',
				'id' => 'css_bg_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
			),
			array(
				'label' => 'Border Color',
				'id' => 'css_border_color',
				'std' => '#b5b5b5',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
			),
			array(
				'label' => 'Border Width',
				'id' => 'css_border_width',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
			),
			array(
				'label' => 'Borders',
				'id' => 'css_border_trbl',
				'std' => 'top right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => 'Top',
						'value' => 'top'
					),
					array(
						'label' => 'Right',
						'value' => 'right'
					),
					array(
						'label' => 'Bottom',
						'value' => 'bottom'
					),
					array(
						'label' => 'Left',
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
			),
			array(
				'label' => 'Margin Bottom',
				'id' => 'css_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'ext' => 'px',
			),
			array(
				'label' => 'Padding Vertical',
				'id' => 'css_padding_vertical',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
			),
			array(
				'label' => 'Padding Horizontal',
				'id' => 'css_padding_horizontal',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
			),

			/**
			 * Header
			 */

			array(
				'label' => 'BG Color',
				'id' => 'css_header_bg_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => 'header'
			),
			array(
				'label' => 'Border Color',
				'id' => 'css_header_border_color',
				'std' => '#b5b5b5',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => 'header'
			),
			array(
				'label' => 'Border Width',
				'id' => 'css_header_border_width',
				'std' => '1',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'header'
			),
			array(
				'label' => 'Borders',
				'id' => 'css_header_border_trbl',
				'std' => 'top right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => 'Top',
						'value' => 'top'
					),
					array(
						'label' => 'Right',
						'value' => 'right'
					),
					array(
						'label' => 'Bottom',
						'value' => 'bottom'
					),
					array(
						'label' => 'Left',
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => 'header'
			),
			array(
				'label' => 'Margin Bottom',
				'id' => 'css_header_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'header'
			),
			array(
				'label' => 'Padding Vertical',
				'id' => 'css_header_padding_vertical',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'header'
			),
			array(
				'label' => 'Padding Horizontal',
				'id' => 'css_header_padding_horizontal',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'header'
			),

			/**
			 * Title
			 */

			array(
				'label' => 'BG Color',
				'id' => 'css_title_bg_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => 'title'
			),
			array(
				'label' => 'Border Color',
				'id' => 'css_title_border_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => 'title'
			),
			array(
				'label' => 'Border Width',
				'id' => 'css_title_border_width',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'title'
			),
			array(
				'label' => 'Borders',
				'id' => 'css_title_border_trbl',
				'std' => 'top right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => 'Top',
						'value' => 'top'
					),
					array(
						'label' => 'Right',
						'value' => 'right'
					),
					array(
						'label' => 'Bottom',
						'value' => 'bottom'
					),
					array(
						'label' => 'Left',
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => 'title'
			),
			array(
				'label' => 'Color',
				'id' => 'css_title_color',
				'std' => '#9a9a9a',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'title'
			),
			array(
				'label' => 'Font Size',
				'id' => 'css_title_font_size',
				'std' => '14',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'title',
				'ext' => 'px'
			),
			array(
				'label' => 'Font Weight',
				'id' => 'css_title_font_weight',
				'std' => '800',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => 'title',
				'ext' => '',
				'min' => 100,
				'max' => 900,
				'increment' => 100
			),
			array(
				'label' => 'Font Family',
				'id' => 'css_title_font_family',
				'std' => 'Raleway',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'title',
			),
			array(
				'label' => 'Padding Vertical',
				'id' => 'css_title_padding_vertical',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'title'
			),
			array(
				'label' => 'Padding Horizontal',
				'id' => 'css_title_padding_horizontal',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'title'
			),

			/**
			 * Content
			 */

			array(
				'label' => 'BG Color',
				'id' => 'css_content_bg_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => 'content'
			),
			array(
				'label' => 'Border Color',
				'id' => 'css_content_border_color',
				'std' => '#b5b5b5',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => 'content'
			),
			array(
				'label' => 'Border Width',
				'id' => 'css_content_border_width',
				'std' => '1',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'content'
			),
			array(
				'label' => 'Borders',
				'id' => 'css_content_border_trbl',
				'std' => 'right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => 'Top',
						'value' => 'top'
					),
					array(
						'label' => 'Right',
						'value' => 'right'
					),
					array(
						'label' => 'Bottom',
						'value' => 'bottom'
					),
					array(
						'label' => 'Left',
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => 'content'
			),
			array(
				'label' => 'Color',
				'id' => 'css_content_color',
				'std' => '#7a7a7a',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => 'content'
			),
			array(
				'label' => 'Font Size',
				'id' => 'css_content_font_size',
				'std' => '14',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => 'content',
				'ext' => 'px'
			),
			array(
				'label' => 'Font Weight',
				'id' => 'css_content_font_weight',
				'std' => '500',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => 'content',
				'ext' => '',
				'min' => 100,
				'max' => 900,
				'increment' => 100
			),
			array(
				'label' => 'Font Family',
				'id' => 'css_content_font_family',
				'std' => 'Raleway',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => 'content',
			),
			array(
				'label' => 'Line Height',
				'id' => 'css_content_line_height',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => 'content',
				'ext' => 'px'
			),
			array(
				'label' => 'Padding Vertical',
				'id' => 'css_content_padding_vertical',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'content'
			),
			array(
				'label' => 'Padding Horizontal',
				'id' => 'css_content_padding_horizontal',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => 'content'
			),

			/**
			 * Responsive Tablet
			 */

			array(
				'label' => 'Responsive',
				'id' => 'css_res_t',
				'std' => 'disabled',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => 'Disabled',
						'value' => 'disabled'
					),
					array(
						'label' => 'Enabled',
						'value' => 'enabled'
					),
				),
				'section' => 'responsive',
				'tab' => 'tablet',
			),
			array(
				'label' => 'Margin Bottom',
				'id' => 'css_res_t_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px',
			),
			array(
				'label' => 'Padding Vertical',
				'id' => 'css_res_t_padding_vertical',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px',
			),
			array(
				'label' => 'Padding Horizontal',
				'id' => 'css_res_t_padding_horizontal',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px',
			),
			array(
				'label' => 'Header - Margin Bottom',
				'id' => 'css_res_t_header_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px',
			),
			array(
				'label' => 'Header - Padding Vertical',
				'id' => 'css_res_t_header_padding_vertical',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px',
			),
			array(
				'label' => 'Header - Padding Horizontal',
				'id' => 'css_res_t_header_padding_horizontal',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px',
			),
			array(
				'label' => 'Title - Font Size',
				'id' => 'css_res_t_title_font_size',
				'std' => '14',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => 'Title - Padding Vertical',
				'id' => 'css_res_t_title_padding_vertical',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px',
			),
			array(
				'label' => 'Title - Padding Horizontal',
				'id' => 'css_res_t_title_padding_horizontal',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px',
			),
			array(
				'label' => 'Content - Font Size',
				'id' => 'css_res_t_content_font_size',
				'std' => '14',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => 'Content - Line Height',
				'id' => 'css_res_t_content_line_height',
				'std' => '22',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px'
			),
			array(
				'label' => 'Content - Padding Vertical',
				'id' => 'css_res_t_content_padding_vertical',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px',
			),
			array(
				'label' => 'Content - Padding Horizontal',
				'id' => 'css_res_t_content_padding_horizontal',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'tab' => 'tablet',
				'ext' => 'px',
			),

			/**
			 * Responsive phone
			 */

			array(
				'label' => 'Responsive',
				'id' => 'css_res_p',
				'std' => 'disabled',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => 'Disabled',
						'value' => 'disabled'
					),
					array(
						'label' => 'Enabled',
						'value' => 'enabled'
					),
				),
				'section' => 'responsive',
				'tab' => 'phone',
			),
			array(
				'label' => 'Margin Bottom',
				'id' => 'css_res_p_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px',
			),
			array(
				'label' => 'Padding Vertical',
				'id' => 'css_res_p_padding_vertical',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px',
			),
			array(
				'label' => 'Padding Horizontal',
				'id' => 'css_res_p_padding_horizontal',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px',
			),
			array(
				'label' => 'Header - Margin Bottom',
				'id' => 'css_res_p_header_margin_bottom',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px',
			),
			array(
				'label' => 'Header - Padding Vertical',
				'id' => 'css_res_p_header_padding_vertical',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px',
			),
			array(
				'label' => 'Header - Padding Horizontal',
				'id' => 'css_res_p_header_padding_horizontal',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-header',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px',
			),
			array(
				'label' => 'Title - Font Size',
				'id' => 'css_res_p_title_font_size',
				'std' => '14',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => 'Title - Padding Vertical',
				'id' => 'css_res_p_title_padding_vertical',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px',
			),
			array(
				'label' => 'Title - Padding Horizontal',
				'id' => 'css_res_p_title_padding_horizontal',
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-title',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px',
			),
			array(
				'label' => 'Content - Font Size',
				'id' => 'css_res_p_content_font_size',
				'std' => '14',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => 'Content - Line Height',
				'id' => 'css_res_p_content_line_height',
				'std' => '22',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px'
			),
			array(
				'label' => 'Content - Padding Vertical',
				'id' => 'css_res_p_content_padding_vertical',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px',
			),
			array(
				'label' => 'Content - Padding Horizontal',
				'id' => 'css_res_p_content_padding_horizontal',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-accordion-content',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'tab' => 'phone',
				'ext' => 'px',
			),

		);

		return apply_filters( 'dslc_module_options', $dslc_options, $this->module_id );

	}

	function output( $options ) {

		global $dslc_active;

		if ( $dslc_active && is_user_logged_in() && current_user_can( DS_LIVE_COMPOSER_CAPABILITY ) )
			$dslc_is_admin = true;
		else
			$dslc_is_admin = false;		

		$this->module_start( $options );

		/* Module output stars here */ 

			$accordion_nav = explode( '(dslc_sep)', trim( $options['accordion_nav'] ) );

			if ( empty( $options['accordion_content'] ) )
				$accordion_contents = false;
			else
				$accordion_contents = explode( '(dslc_sep)', trim( $options['accordion_content'] ) );

			$count = 0;

		?>	<div class="divide10"></div>
				<div class="dslc-accordion">

					<?php if ( is_array( $accordion_contents ) && count( $accordion_contents ) > 0 ) : ?>

						<?php foreach ( $accordion_contents as $accordion_content ) : ?>

							<div class="dslc-accordion-item">

								<div class="dslc-accordion-header dslc-accordion-hook">
									<span class="dslc-accordion-title" <?php if ( $dslc_is_admin ) echo 'contenteditable'; ?>><?php echo $accordion_nav[$count]; ?></span>
									<?php if ( $dslc_is_admin ) : ?>
										<span class="dslca-delete-accordion-hook"><span class="dslca-icon dslc-icon-remove"></span></span>
									<?php endif; ?>
								</div>

								<div class="dslc-accordion-content" <?php if ( $dslc_is_admin ) echo 'contenteditable'; ?>>
									<?php echo stripslashes( $accordion_content ); ?>
								</div><!-- .dslc-accordion-content -->

							</div><!-- .dslc-accordion-item -->

						<?php $count++; endforeach; ?>

					<?php else : ?>

						<div class="dslc-accordion-item">

							<div class="dslc-accordion-header dslc-accordion-hook">
								<span class="dslc-accordion-title" <?php if ( $dslc_is_admin ) echo 'contenteditable'; ?>>CLICK TO EDIT</span>
								<?php if ( $dslc_is_admin ) : ?>
									<span class="dslca-delete-accordion-hook"><span class="dslca-icon dslc-icon-remove"></span></span>
								<?php endif; ?>
							</div>

							<div class="dslc-accordion-content" <?php if ( $dslc_is_admin ) echo 'contenteditable'; ?>>
								Placeholder content, click to edit. Lorem ipsum dolor sit amet, consectetur
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							</div><!-- .dslc-accordion-content -->

						</div><!-- .dslc-accordion-item -->

					<?php endif; ?>

					<?php if ( $dslc_is_admin ) : ?>
						<div class="dslca-add-accordion">
							<span class="dslca-add-accordion-hook"><span class="dslca-icon dslc-icon-plus"></span></span>
						</div>
					<?php endif; ?>

				</div><!-- .dslc-accordion -->

		<?php /* Module output ends here */

		$this->module_end( $options );

	}

}