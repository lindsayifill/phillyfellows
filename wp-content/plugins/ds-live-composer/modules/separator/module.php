<?php

class DSLC_Separator extends DSLC_Module {

	var $module_id = 'DSLC_Separator';
	var $module_title = 'Separator';
	var $module_icon = 'minus';
	var $module_category = 'elements';

	function options() {		

		$dslc_options = array(
			array(
				'label' => __( ' Color', 'dslc_string' ) ,
				'id' => 'css_border_color',
				'std' => '#ededed',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-separator',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
			),
			array(
				'label' => __( 'Height', 'dslc_string' ) ,
				'id' => 'height',
				'std' => '25',
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
				'label' => __( 'Style', 'dslc_string' ) ,
				'id' => 'style',
				'std' => 'solid',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Invisible', 'dslc_string' ) ,
						'value' => 'invisible'
					),
					array(
						'label' => __( 'Solid', 'dslc_string' ) ,
						'value' => 'solid'
					),
					array(
						'label' => __( 'Dashed', 'dslc_string' ) ,
						'value' => 'dashed'
					),
					array(
						'label' => __( 'Dotted', 'dslc_string' ) ,
						'value' => 'dotted'
					),
				),
				'section' => 'styling',
			),

			/**
			 * Responsive Tablet
			 */

			array(
				'label' => __( 'Responsive', 'dslc_string' ) ,
				'id' => 'css_res_t',
				'std' => 'disabled',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Disabled', 'dslc_string' ) ,
						'value' => 'disabled'
					),
					array(
						'label' => __( 'Enabled', 'dslc_string' ) ,
						'value' => 'enabled'
					),
				),
				'section' => 'responsive',
				'tab' => 'tablet',
			),
			array(
				'label' => __( 'Height', 'dslc_string' ) ,
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
				'label' => __( 'Responsive', 'dslc_string' ) ,
				'id' => 'css_res_p',
				'std' => 'disabled',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Disabled', 'dslc_string' ) ,
						'value' => 'disabled'
					),
					array(
						'label' => __( 'Enabled', 'dslc_string' ) ,
						'value' => 'enabled'
					),
				),
				'section' => 'responsive',
				'tab' => 'phone',
			),
			array(
				'label' => __( 'Height', 'dslc_string' ) ,
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
					<div class="dslca-separator-empty"><span><?php _e( 'TRANSPARENT SEPARATOR', 'dslc_string' ); ?></span></div>
				<?php endif; ?>
			</div>

			<?php

		/* Module output ends here */

		$this->module_end( $options );

	}

}