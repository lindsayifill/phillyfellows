<?php 

/**
 * Load all custom blocks
 */
require_once('live_composer_blocks/blog_classic_block.php');
require_once('live_composer_blocks/blog_classic_alt_block.php');
require_once('live_composer_blocks/blog_block.php');
require_once('live_composer_blocks/blog_grid_block.php');
require_once('live_composer_blocks/blog_carousel_block.php');
require_once('live_composer_blocks/client_carousel_block.php');
require_once('live_composer_blocks/portfolio_block.php');
require_once('live_composer_blocks/portfolio_carousel_block.php');
require_once('live_composer_blocks/team_carousel_block.php');
require_once('live_composer_blocks/team_block.php');
require_once('live_composer_blocks/text_block.php');
require_once('live_composer_blocks/text_icon_block.php');
require_once('live_composer_blocks/section_title.php');
require_once('live_composer_blocks/section_subtitle.php');
require_once('live_composer_blocks/step_block.php');
require_once('live_composer_blocks/toggle_block.php');
require_once('live_composer_blocks/tabs_block.php');
require_once('live_composer_blocks/seperator_block.php');
require_once('live_composer_blocks/testimonial_slider_block.php');
require_once('live_composer_blocks/testimonial_block.php');
require_once('live_composer_blocks/pricing_table_block.php');
require_once('live_composer_blocks/image_block.php');
require_once('live_composer_blocks/alert_block.php');
require_once('live_composer_blocks/skill_bar_block.php');
require_once('live_composer_blocks/map_block.php');
require_once('live_composer_blocks/call_to_action_block.php');
require_once('live_composer_blocks/video_block.php');
require_once('live_composer_blocks/sharing_block.php');
require_once('live_composer_blocks/services_block.php');
require_once('live_composer_blocks/code_block.php');

/**
 * Unregister default modules
 */
function ebor_unregister_modules(){
     dslc_unregister_module( 'DSLC_Accordion' );
     dslc_unregister_module( 'DSLC_Tabs' );
}
add_action('dslc_hook_register_modules', 'ebor_unregister_modules');