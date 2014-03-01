<?php

/**
 * Load scripts for the tutorial
 *
 * @since 1.0
 */

function dslc_tut_load_scripts() {

	wp_enqueue_style( 'dslc-tut-css', DS_LIVE_COMPOSER_URL . 'tutorial/tutorial.css');

	if ( isset( $_GET['dslc_tut'] ) &&  $_GET['dslc_tut'] == 'start' ) {

		wp_enqueue_script( 'dslc-tut-js', DS_LIVE_COMPOSER_URL . 'tutorial/tutorial.js', array( 'jquery' ) );

	} elseif( isset( $_GET['dslc_tut'] ) &&  $_GET['dslc_tut'] == 'ask' ) {

		wp_enqueue_script( 'dslc-tut-ask-js', DS_LIVE_COMPOSER_URL . 'tutorial/tutorial-ask.js', array( 'jquery' ) );

	}

} add_action( 'wp_enqueue_scripts', 'dslc_tut_load_scripts' );

/**
 * Display modal for the tutorial
 *
 * @since 1.0
 */

function dslc_tut_modal() {

	if ( isset( $_GET['dslc_tut'] ) ) {

		?>
			<input type="hidden" name="dslc_tut_settings" id="dslc_tut_settings" data-post-id="<?php echo get_the_ID(); ?>" />
		<?php

	}

	if ( isset( $_GET['dslc_tut'] ) &&  $_GET['dslc_tut'] == 'ask' ) {

		?>

			<div class="dslca-tut-modal">
					
				<div class="dslca-tut-modal-content">

					<div class="dslca-tut-modal-msg">

						<span class="dslca-tut-modal-title">Welcome to Live Composer Tutorial</span>
						<span class="dslca-tut-modal-descr">Sed sagittis lacus nec nisi viverra, sed consequat felis ultricies. Aliquam varius porttitor odio, eget condimentum massa suscipit eu.</span>

					</div><!-- .dslca-tut-modal-msg -->

					<div class="dslca-tut-modal-actions">

						<a href="http://livecomposerplugin.com/sandbox/tutorial/?dslc=active&dslc_tut=start" class="dslca-tut-modal-confirm-hook"><span class="dslc-icon dslc-icon-rocket"></span>Launch tutorial</a>
						<a href="http://livecomposerplugin.com/sandbox" class="dslca-tut-modal-cancel-hook"><span class="dslc-icon dslc-icon-share-alt"></span>Skip it</a>

					</div>

				</div><!-- .dslca-tut-modal-content -->

			</div><!-- .dslca-tut-modal -->

		<?php

	}

} add_action( 'wp_footer', 'dslc_tut_modal' );