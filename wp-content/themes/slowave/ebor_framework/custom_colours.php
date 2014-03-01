<?php 
	add_action('wp_head','ebor_custom_colours', 100);
	function ebor_custom_colours(){
	
	$highlight = get_option('highlight_colour','#3f8dbf');
	$highlightrgb = ebor_hex2rgb( $highlight );
	$highlight_hover = get_option('highlight_hover_colour','#387eaa');
	$dark_wrapper = get_option('wrapper_background_dark', '#f9f9f9');
	$light_wrapper = get_option('wrapper_background', '#ffffff');
	$header_bg = get_option('header_bg', '#333C45');
	$header_dropdown_bg = get_option('header_dropdown_bg', '#2e353d');
	$footer_bg = get_option('footer_bg', '#2c2c2c');
	$sub_footer_bg = get_option('sub_footer_bg', '#292929');
	$nav_margin = get_option('nav_margin','40');
?>
	
<style type="text/css">
	
	/**
	 * Main Colour
	 */
	a, 
	.colored, 
	.post-title a:hover, 
	.black-wrapper a:hover,
	ul.circled li:before,
	blockquote small,
	.nav > li > a:hover,
	.nav > li.current > a,
	.navbar .nav .open > a,
	.navbar .nav .open > a:hover,
	.navbar .nav .open > a:focus,
	.navbar .dropdown-menu:not(.yamm-dropdown-menu) > li > a:hover,
	.navbar .dropdown-menu:not(.yamm-dropdown-menu) > li > a:focus,
	.navbar .dropdown-submenu:hover > a,
	.navbar .dropdown-submenu:focus > a,
	.navbar .dropdown-menu:not(.yamm-dropdown-menu) > .active > a,
	.navbar .dropdown-menu:not(.yamm-dropdown-menu) > .active > a:hover,
	.navbar .dropdown-menu:not(.yamm-dropdown-menu) > .active > a:focus,
	.yamm .yamm-content a:hover,
	.services .tab:hover .icon i.icn,
	.services .tab.active .icon i.icn,
	.services .tab:hover h4,
	.services .tab.active h4,
	#testimonials .author,
	.col-testimonials .author,
	.panel-title > a:hover,
	.col-services .icon i.icn,
	.image-caption h3 a:hover,
	.black-wrapper .image-caption h3 a:hover,
	.meta a:hover,
	#comments .info h2 a:hover,
	#comments a.reply-link:hover,
	.step h5,
	.progress-list li em,
	.sidebox a:hover,
	.border-list li a:hover,
	.border-list li:hover:after,
	.parallax a:hover,
	.pricing .plan h4 span,
	#ebor-cart-link.active a {
	    color: <?php echo $highlight; ?>;
	}
	.color-wrapper, 
	input[type="submit"],
	.btn,
	.parallax .btn-submit,
	.btn-submit,
	.progress.plain .bar {
	    background: <?php echo $highlight; ?>
	}
	.navbar .dropdown-menu {
	    border-top: 2px solid <?php echo $highlight; ?> !important;
	}
	.services .tab:hover .pin,
	.services .tab.active .pin,
	.col-services-2 .col:hover .icon-border i,
	.step:hover .icon-border i {
	    background-color: <?php echo $highlight; ?>
	}
	.tabs-top .tab a:hover,
	.tabs-top .tab.active a {
	    color: <?php echo $highlight; ?>;
	    border-color: <?php echo $highlight; ?>;
	}
	.more {
	    margin: 0;
	    color: <?php echo $highlight; ?>;
	}
	.pagination ul > li > a:hover,
	.pagination ul > li > a:focus,
	.pagination ul > .active > a,
	.pagination ul > .active > span,
	.navigation a:hover,
	.icon-border i {
	    color: <?php echo $highlight; ?>;
	    border: 2px solid <?php echo $highlight; ?>;
	}
	.tooltip-inner {
	    color: #fff;
	    background-color: <?php echo $highlight; ?>;
	    padding: 5px 12px;
	}
	.tooltip.top .tooltip-arrow,
	.tooltip.top-left .tooltip-arrow,
	.tooltip.top-right .tooltip-arrow {
	    border-top-color: <?php echo $highlight; ?>
	}
	.tooltip.right .tooltip-arrow {
	    border-right-color: <?php echo $highlight; ?>
	}
	.tooltip.left .tooltip-arrow {
	    border-left-color: <?php echo $highlight; ?>
	}
	.tooltip.bottom .tooltip-arrow,
	.tooltip.bottom-left .tooltip-arrow,
	.tooltip.bottom-right .tooltip-arrow {
	    border-bottom-color: <?php echo $highlight; ?>
	}
	@media (max-width: 991px) { 
		.navbar-nav > li > a {
		    color: <?php echo $highlight; ?>
		}
	}
	@media (max-width: 767px) { 
		.services .tab a:hover,
		.services .tab.active a {
		    border-color: <?php echo $highlight; ?>
		}
		.services .tab:hover h4,
		.services .tab.active h4 {
		    color: <?php echo $highlight; ?>
		}
	}
	.icon-overlay a .icn-more {
	    background-color: rgba(<?php echo $highlightrgb; ?>,0.92);
	}
	.dropdowncartcontents {
		border-top: 2px solid <?php echo $highlight; ?> !important;
	}
	
	/**
	 * Main Colour (Darker)
	 */
	.btn:hover,
	.btn:focus,
	.btn:active,
	.btn.active,
	.parallax .btn-submit:hover,
	input[type="submit"]:hover {
	    background: <?php echo $highlight_hover; ?>;
	}
	.btn-border-dark:hover {
	    border: 2px solid <?php echo $highlight_hover; ?>;
	    color: <?php echo $highlight_hover; ?> !important;
	}
	.btn-border-light:hover {
	    border: 2px solid <?php echo $highlight_hover; ?>;
	    color: <?php echo $highlight_hover; ?> !important;
	}
	
	/**
	 * Background Colour
	 */
	.box-layout {
		background-color: #<?php echo get_background_color(); ?>;
	}
	
	/**
	 * Page Wrappers Backgounds
	 */
	.light-wrapper, .image-caption {
	    background: <?php echo $light_wrapper; ?>;
	}
	.dark-wrapper,
	.dslc-modules-section {
	    background: <?php echo $dark_wrapper; ?>;
	}
	
	/**
	 * Header Colours
	 */
	.navbar-header {
		background: <?php echo $header_bg; ?>;
	}
	.navbar .dropdown-menu {
		background: <?php echo $header_dropdown_bg; ?>;
	}
	
	/**
	 * footer Colours
	 */
	footer.black-wrapper {
		background: <?php echo $footer_bg; ?>;
	}
	.sub-footer,
	.newsletter input[type="email"], 
	.widget_ns_mailchimp form input[type="text"] {
	    background: <?php echo $sub_footer_bg; ?>;
	}
	
	/**
	 * navbar settings
	 */
	.navbar-nav > li > a {
	    padding: <?php echo $nav_margin; ?>px 14px;
	}
	
	.navbar.basic .btn.responsive-menu {
		margin: <?php echo ($nav_margin / 2); ?>px 0;
	}
	
	<?php echo get_option('custom_css'); ?>
	
</style>
	
<?php }

add_action('login_head','ebor_custom_admin');
function ebor_custom_admin(){
	if( get_option('custom_login_logo') )
		echo '<style type="text/css">
				.login h1 a { 
					background-image: url("'.get_option('custom_login_logo').'"); 
					background-size: auto 80px;
					width: 100%; 
				} 
			</style>';
}