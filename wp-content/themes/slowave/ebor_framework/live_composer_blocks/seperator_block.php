<?php

add_action('dslc_hook_register_modules',
     create_function('', 'return dslc_register_module( "Slowave_Separator" );')
);


class Slowave_Separator extends DSLC_Module {

	var $module_id = 'Slowave_Separator';
	var $module_title = 'Separator';
	var $module_icon = 'minus';
	var $module_category = 'Slowave - Misc';

	function options() {		

		$dslc_options = array(
			array(
				'label' => ' Color',
				'id' => 'css_border_color',
				'std' => '#dadada',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-separator',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
			),
			array(
				'label' => 'Height',
				'id' => 'height',
				'std' => '55',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-separator',
				'affect_on_change_rule' => 'margin-bottom,padding-bottom',
				'ext' => 'px',
				'min' => 1,
				'max' => 300,
				'section' => 'styling',
			),
			array(
				'label' => 'Style',
				'id' => 'style',
				'std' => 'solid',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => 'Invisible',
						'value' => 'invisible'
					),
					array(
						'label' => 'Solid',
						'value' => 'solid'
					),
					array(
						'label' => 'Dashed',
						'value' => 'dashed'
					),
					array(
						'label' => 'Dotted',
						'value' => 'dotted'
					),
				),
				'section' => 'styling',
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
				'label' => 'Height',
				'id' => 'res_t_height',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-separator',
				'affect_on_change_rule' => 'margin-bottom,padding-bottom',
				'ext' => 'px',
				'min' => 1,
				'max' => 300,
				'section' => 'responsive',
				'tab' => 'tablet',
			),

			/**
			 * Responsive Phone
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
				'label' => 'Height',
				'id' => 'res_p_height',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-separator',
				'affect_on_change_rule' => 'margin-bottom,padding-bottom',
				'ext' => 'px',
				'min' => 1,
				'max' => 300,
				'section' => 'responsive',
				'tab' => 'phone',
			),

		);

		return apply_filters( 'dslc_module_options', $dslc_options, $this->module_id );

	}

	function output( $options ) {

		global $dslc_active;

		$this->module_start( $options );

		/* Module output stars here */

			?>

			<div class="dslc-separator dslc-separator-style-<?php echo $options['style']; ?>">
				<?php if ( $options['style'] == 'invisible' && $dslc_active && is_user_logged_in() && current_user_can( DS_LIVE_COMPOSER_CAPABILITY ) ) : ?>
					<div class="dslca-separator-empty"><span>TRANSPARENT SEPARATOR</span></div>
				<?php endif; ?>
			</div>

			<?php

		/* Module output ends here */

		$this->module_end( $options );

	}

}