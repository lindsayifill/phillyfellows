<?php 

add_action('customize_register', 'ebor_theme_customize');
function ebor_theme_customize($wp_customize) {

/* Remove the WordPress background image control. */
$wp_customize->remove_control( 'background_image' );

require_once('theme_options_classes.php');

/* Add our custom background image control. */
$wp_customize->add_control( new JT_Customize_Control_Background_Image( $wp_customize ) );

$social_options = array(
    'pinterest'=> 'Pinterest',
    'rss'=> 'RSS',
    'facebook'=> 'Facebook',
    'twitter'=> 'Twitter',
    'flickr'=> 'Flickr',
    'dribbble'=> 'Dribbble',
    'behance'=> 'Behance',
    'linkedin'=> 'LinkedIn',
    'vimeo'=> 'Vimeo',
    'youtube'=> 'Youtube',
    'kkype'=> 'Skype',
    'tumblr'=> 'Tumblr',
    'delicious'=> 'Delicious',
    '500px'=> '500px',
    'grooveshark'=> 'Grooveshark',
    'forrst'=> 'Forrst',
    'digg'=> 'Digg',
    'blogger'=> 'Blogger',
    'klout'=> 'Klout',
    'dropbox'=> 'Dropbox',
    'github'=> 'Github',
    'songkick'=> 'Singkick',
    'posterous'=> 'Posterous',
    'appnet'=> 'Appnet',
    'gplus'=> 'Google Plus',
    'stumbleupon'=> 'Stumbleupon',
    'lastfm'=> 'LastFM',
    'spotify'=> 'Spotify',
    'instagram'=> 'Instagram',
    'evernote'=> 'Evernote',
    'paypal'=> 'Paypal',
    'picasa'=> 'Picasa',
    'soundcloud'=> 'Soundcloud',
);

/**
 * Ebor Framework
 * Login Section
 * @since version 1.0
 * @author TommusRhodus
 */

/**
 * Create Header Section
 */
$wp_customize->add_section( 'custom_login_section', array(
	'title'          => 'wp-login.php Logo',
	'priority'       => 29,
) );

/**
 * Custom Logo Default
 */
$wp_customize->add_setting('custom_login_logo', array(
    'default'  => '',
    'type' => 'option'

));

/**
 * Custom Logo Control
 */
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_login_logo', array(
    'label'    => __('Custom Login Logo Upload', 'ebor_starter'),
    'section'  => 'custom_login_section',
    'priority'       => 1
)));

/**
 * END LOGIN LOGO SECTION
 */
 

/**
 * Create site settings section
 * @author TommusRhodus
 * @package Slowave
 * @since 1.0.0
 */
$wp_customize->add_section( 'demo_data', array(
	'title'          => 'Import Demo Data',
	'priority'       => 1,
) );

/**
 * Demo Data Defaults
 */
$wp_customize->add_setting( 'import', array(
    'default'        => ''
) );

/**
 * Demo Data Control
 */
$wp_customize->add_control( new Demo_Import_control( $wp_customize, 'import', array(
    'label'   => __('Import Demo Data', 'slowave'),
    'section' => 'demo_data',
    'settings'   => 'import',
    'priority' => 1,
) ) );

/**
 * END DEMO DATA SECTION
 */
 

/**
 * Create site settings section
 * @author TommusRhodus
 * @package Slowave
 * @since 1.0.0
 */
$wp_customize->add_section( 'site_settings', array(
	'title'          => 'Site Settings',
	'priority'       => 29,
) );
 
/**
 * Site Layout Defaults
 */
$wp_customize->add_setting('site_layout', array(
    'default' => 'full-layout',
    'type' => 'option'
));

/**
 * Site Layout Controls
 */
$wp_customize->add_control( 'site_layout', array(
    'label'   => __('Choose Site Layout Style', 'slowave'),
    'section' => 'site_settings',
    'type'    => 'select',
    'priority'       => 1,
    'choices'    => array(
        'full-layout' => 'Full Width',
        'box-layout' => 'Boxed',
    ),
));

/**
 * Site Layout Defaults
 */
$wp_customize->add_setting('site_version', array(
    'default' => 'multipage',
    'type' => 'option'
));

/**
 * Site Layout Controls
 */
$wp_customize->add_control( 'site_version', array(
    'label'   => __('Choose Site Version', 'slowave'),
    'section' => 'site_settings',
    'type'    => 'select',
    'priority'       => 1,
    'choices'    => array(
        'multipage' => 'Multipage (Default)',
        'one-page' => 'One Page (Enables URL Rewriting)',
    ),
));

/**
 * END SITE SETTINGS SECTION
 */


///////////////////////////////////////
//     BLOG SECTION                 //
/////////////////////////////////////
	
//CREATE CUSTOM STYLING SUBSECTION
$wp_customize->add_section( 'blog_settings', array(
	'title'          => 'Blog Settings',
	'priority'       => 35,
) );

//blog layout
$wp_customize->add_setting('blog_layout', array(
    'default' => 'bloggrid',
    'type' => 'option'
));

//blog layout
$wp_customize->add_control( 'blog_layout', array(
    'label'   => __('Choose layout for Blog.', 'slowave'),
    'section' => 'blog_settings',
    'type'    => 'select',
    'priority' => 4,
    'choices' => array(
        'bloggrid' => 'Grid Blog',
        'blogfeed' => 'Classic Feed Blog',
        'blogfeedalt' => 'Classic Feed Blog (Alt)',
    ),
));

//comments TITLE
$wp_customize->add_setting( 'blog_title', array(
    'default'        => 'Our Journal',
    'type' => 'option'
) );

//commentstitle
$wp_customize->add_control( 'blog_title', array(
    'label' => __('Blog Title', 'slowave'),
    'type' => 'text',
    'section' => 'blog_settings',
    'priority'       => 4,
) );

//comments TITLE
$wp_customize->add_setting( 'comments_title', array(
    'default'        => 'Would you like to share your thoughts?',
    'type' => 'option'
) );

//commentstitle
$wp_customize->add_control( 'comments_title', array(
    'label' => __('Comments Title', 'slowave'),
    'type' => 'text',
    'section' => 'blog_settings',
    'priority'       => 5,
) );

//comments subTITLE
$wp_customize->add_setting( 'comments_subtitle', array(
    'default'        => 'Your email address will not be published. Required fields are marked *',
    'type' => 'option'
) );

//comments subtitle
$wp_customize->add_control( 'comments_subtitle', array(
    'label' => __('Comments Sub-title', 'slowave'),
    'type' => 'text',
    'section' => 'blog_settings',
    'priority'       => 5,
) );

//blog continue
$wp_customize->add_setting( 'blog_continue', array(
    'default'        => 'Continue Reading',
    'type' => 'option'
) );

//blog continue
$wp_customize->add_control( 'blog_continue', array(
    'label' => __('Blog "Continue Reading" Text', 'slowave'),
    'type' => 'text',
    'section' => 'blog_settings',
    'priority'       => 6,
) );

//blog continue
$wp_customize->add_setting( 'author_details_title', array(
    'default'        => 'About the author',
    'type' => 'option'
) );

//blog continue
$wp_customize->add_control( 'author_details_title', array(
    'label' => __('SIGNLE - Author Details Title', 'slowave'),
    'type' => 'text',
    'section' => 'blog_settings',
    'priority'       => 6,
) );

//index date
$wp_customize->add_setting( 'index_sidebar', array(
    'default' => 1,
    'type' => 'option'
) );

//index date
$wp_customize->add_control( 'index_sidebar', array(
    'label' => __('BLOG FEED - Use Sidebar?', 'slowave'),
    'type' => 'checkbox',
    'section' => 'blog_settings',
    'priority'       => 7,
) );

//index date
$wp_customize->add_setting( 'index_date', array(
    'default' => 1,
    'type' => 'option'
) );

//index date
$wp_customize->add_control( 'index_date', array(
    'label' => __('META - INDEX - Show date?', 'slowave'),
    'type' => 'checkbox',
    'section' => 'blog_settings',
    'priority'       => 7,
) );

//index comments
$wp_customize->add_setting( 'index_comments', array(
    'default' => 1,
    'type' => 'option'
) );

//index comments
$wp_customize->add_control( 'index_comments', array(
    'label' => __('META - INDEX - Show comments?', 'slowave'),
    'type' => 'checkbox',
    'section' => 'blog_settings',
    'priority'       => 9,
) );

//single date
$wp_customize->add_setting( 'single_date', array(
    'default' => 1,
    'type' => 'option'
) );

//single date
$wp_customize->add_control( 'single_date', array(
    'label' => __('META - SINGLE - Show date?', 'slowave'),
    'type' => 'checkbox',
    'section' => 'blog_settings',
    'priority'       => 11,
) );

//single categories
$wp_customize->add_setting( 'single_categories', array(
    'default' => 1,
    'type' => 'option'
) );

//single categories
$wp_customize->add_control( 'single_categories', array(
    'label' => __('META - SINGLE - Show Categories?', 'slowave'),
    'type' => 'checkbox',
    'section' => 'blog_settings',
    'priority'       => 12,
) );

//single comments
$wp_customize->add_setting( 'single_comments', array(
    'default' => 1,
    'type' => 'option'
) );

//single comments
$wp_customize->add_control( 'single_comments', array(
    'label' => __('META - SINGLE - Show comments?', 'slowave'),
    'type' => 'checkbox',
    'section' => 'blog_settings',
    'priority'       => 13,
) );

//blog social
$wp_customize->add_setting( 'blog_social', array(
    'default' => 1,
    'type' => 'option'
) );

//blog social
$wp_customize->add_control( 'blog_social', array(
    'label' => __('META - SINGLE - Show Social Sharing Buttons?', 'slowave'),
    'type' => 'checkbox',
    'section' => 'blog_settings',
    'priority'       => 13,
) );

//blog author
$wp_customize->add_setting( 'blog_author', array(
    'default' => 1,
    'type' => 'option'
) );

//blog author
$wp_customize->add_control( 'blog_author', array(
    'label' => __('META - SINGLE - Show post author details?', 'slowave'),
    'type' => 'checkbox',
    'section' => 'blog_settings',
    'priority'       => 13,
) );
	
	
///////////////////////////////////////
//     PORTFOLIO SECTION            //
/////////////////////////////////////
	
//CREATE CUSTOM STYLING SUBSECTION
$wp_customize->add_section( 'portfolio_settings', array(
	'title'          => 'Portfolio Settings',
	'priority'       => 36,
) ); 

//blog layout
$wp_customize->add_setting('portfolio_layout', array(
    'default' => '4',
    'type' => 'option'
));

//blog layout
$wp_customize->add_control( 'portfolio_layout', array(
    'label'   => __('Choose layout for Portfolio Archives.', 'slowave'),
    'section' => 'portfolio_settings',
    'type'    => 'select',
    'priority' => 1,
    'choices'    => array(
        '3' => '4 Columns',
        '4' => '3 Columns',
    ),
));

//blog layout
$wp_customize->add_setting('portfolio_link', array(
    'default' => 'lightbox',
    'type' => 'option'
));

//blog layout
$wp_customize->add_control( 'portfolio_link', array(
    'label'   => __('Portfolio Images Should Link To?', 'slowave'),
    'section' => 'portfolio_settings',
    'type'    => 'select',
    'priority' => 1,
    'choices'    => array(
        'lightbox' => 'Lightbox of Larger Image',
        'permalink' => 'The Project Post',
    ),
));

//comments TITLE
$wp_customize->add_setting( 'portfolio_sharing_title', array(
    'default' => 'Share This Work',
    'type' => 'option'
) );

//commentstitle
$wp_customize->add_control( 'portfolio_sharing_title', array(
    'label' => __('SINGLE - Sharing Buttons Title', 'slowave'),
    'type' => 'text',
    'section' => 'portfolio_settings',
    'priority'       => 2,
) );

//comments TITLE
$wp_customize->add_setting( 'portfolio_related_title', array(
    'default' => 'Related Works',
    'type' => 'option'
) );

//commentstitle
$wp_customize->add_control( 'portfolio_related_title', array(
    'label' => __('SINGLE - Related Work Title', 'slowave'),
    'type' => 'text',
    'section' => 'portfolio_settings',
    'priority'       => 3,
) );

//disable ajax
$wp_customize->add_setting( 'portfolio_related', array(
    'default' => 0,
    'type' => 'option'
) );

//disable ajax
$wp_customize->add_control( 'portfolio_related', array(
    'label' => 'SINGLE - Show related posts?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
    'priority' => 4
) );

//index categories
$wp_customize->add_setting( 'portfolio_index_categories', array(
    'default' => 1,
    'type' => 'option'
) );

//index categories
$wp_customize->add_control( 'portfolio_index_categories', array(
    'label' => __('META - INDEX - Show categories?', 'slowave'),
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
) );

//portfolio date
$wp_customize->add_setting( 'portfolio_date', array(
    'default' => 1,
    'type' => 'option'
) );

//portfolio date
$wp_customize->add_control( 'portfolio_date', array(
    'label' => 'META - SINGLE - Show project date?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
) );

//portfolio categories
$wp_customize->add_setting( 'portfolio_categories', array(
    'default' => 1,
    'type' => 'option'
) );

//portfolio categories
$wp_customize->add_control( 'portfolio_categories', array(
    'label' => 'META - SINGLE - Show project categories?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
) );

//portfolio client
$wp_customize->add_setting( 'portfolio_client', array(
    'default' => 1,
    'type' => 'option'
) );

//portfolio client
$wp_customize->add_control( 'portfolio_client', array(
    'label' => 'META - SINGLE - Show project client?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
) );

//portfolio url
$wp_customize->add_setting( 'portfolio_url', array(
    'default' => 1,
    'type' => 'option'
) );

//portfolio url
$wp_customize->add_control( 'portfolio_url', array(
    'label' => 'META - SINGLE - Show project URL?',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
) );

//portfolio url
$wp_customize->add_setting( 'portfolio_share', array(
    'default' => 1,
    'type' => 'option'
) );

//portfolio url
$wp_customize->add_control( 'portfolio_share', array(
    'label' => 'SINGLE - Show Social Share Buttons',
    'type' => 'checkbox',
    'section' => 'portfolio_settings',
) );
	

/**
 * Create colors section
 * @author TommusRhodus
 * @package Slowave
 * @since 1.0.0
 */

/**
 * highlight settings
 */
$wp_customize->add_setting('highlight_colour', array(
    'default'           => '#3f8dbf',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

/**
 * highlight controls
 */
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'highlight_colour', array(
    'label'    => __('GLOBAL - Main Colour', 'slowave'),
    'section'  => 'colors',
    'priority' => 100,
)));

/**
 * highlight hover settings
 */
$wp_customize->add_setting('highlight_hover_colour', array(
    'default'           => '#387eaa',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

/**
 * highlight hover controls
 */
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'highlight_hover_colour', array(
    'label'    => __('GLOBAL - Main Colour Hover (Darker)', 'slowave'),
    'section'  => 'colors',
    'priority' => 105,
)));

/**
 * wrapper light settings settings
 */
$wp_customize->add_setting('wrapper_background', array(
    'default'           => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

/**
 * wrapper light control
 */
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wrapper_background', array(
    'label'    => __('GLOBAL - Page Backgrounds', 'slowave'),
    'section'  => 'colors',
    'priority' => 110,
)));

/**
 * wrapper dark settings
 */
$wp_customize->add_setting('wrapper_background_dark', array(
    'default'           => '#f9f9f9',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

/**
 * wrapper dark control
 */
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wrapper_background_dark', array(
    'label'    => __('GLOBAL - Page Backgrounds (Darker)', 'slowave'),
    'section'  => 'colors',
    'priority' => 115,
)));

/**
 * header background settings
 */
$wp_customize->add_setting('header_bg', array(
    'default'           => '#333C45',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

/**
 * header background control
 */
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg', array(
    'label'    => __('GLOBAL - Header Background', 'slowave'),
    'section'  => 'colors',
    'priority' => 120,
)));

/**
 * header dropdown background settings
 */
$wp_customize->add_setting('header_dropdown_bg', array(
    'default'           => '#2e353d',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

/**
 * header dropdown background control
 */
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_dropdown_bg', array(
    'label'    => __('GLOBAL - Header Dropdown Background', 'slowave'),
    'section'  => 'colors',
    'priority' => 125,
)));

/**
 * footer background settings
 */
$wp_customize->add_setting('footer_bg', array(
    'default'           => '#2c2c2c',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

/**
 * footer background control
 */
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg', array(
    'label'    => __('GLOBAL - Main Footer Background', 'slowave'),
    'section'  => 'colors',
    'priority' => 130,
)));

/**
 * sub footer background settings
 */
$wp_customize->add_setting('sub_footer_bg', array(
    'default'           => '#292929',
    'sanitize_callback' => 'sanitize_hex_color',
    'type' => 'option'
));

/**
 * sub footer background control
 */
$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sub_footer_bg', array(
    'label'    => __('GLOBAL - Sub Footer Background', 'slowave'),
    'section'  => 'colors',
    'priority' => 135,
)));

/**
 *  END COLOURS SECTION
 */


///////////////////////////////////////
//     CUSTOM LOGO SECTION          //
/////////////////////////////////////
	
//CREATE CUSTOM LOGO SUBSECTION
$wp_customize->add_section( 'custom_logo_section', array(
	'title'          => 'Header Settings & Logo',
	'priority'       => 30,
) );

//CUSTOM LOGO SETTINGS
$wp_customize->add_setting('custom_logo', array(
    'default'  => get_template_directory_uri() . '/style/images/logo.png',
    'type' => 'option'

));

//CUSTOM LOGO
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_logo', array(
    'label'    => __('Custom Logo Upload', 'slowave'),
    'section'  => 'custom_logo_section',
    'priority'       => 1
)));

//CUSTOM RETINA LOGO SETTINGS
$wp_customize->add_setting('custom_logo_retina', array(
    'default'  => get_template_directory_uri() . '/style/images/logo@2x.png',
    'type' => 'option'

));

//CUSTOM RETINA LOGO
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_logo_retina', array(
    'label'    => __('Retina Logo - Needs @2x on the file e.g logo@2x.png', 'slowave'),
    'section'  => 'custom_logo_section',
    'priority'       => 1
)));

//logo alt text
$wp_customize->add_setting( 'custom_logo_alt_text', array(
    'default'        => 'Alt Text',
    'type' => 'option'
) );

//logo alt text
$wp_customize->add_control( 'custom_logo_alt_text', array(
    'label' => __('Custom Logo Alt Text', 'slowave'),
    'type' => 'text',
    'section' => 'custom_logo_section',
) );

//gallery height
$wp_customize->add_setting( 'nav_margin', array(
    'default' => '40',
    'type' => 'option'
) );

//header height
$wp_customize->add_control( new Ebor_Customizer_Number_Control( $wp_customize, 'nav_margin', array(
    'label' => __('HEADER - Adjust Nav Margin, Use to Centre Nav if using Larger / Smaller Logo.', 'marble'),
    'type' => 'number',
    'section' => 'custom_logo_section',
    'priority'       => 20,
) ) );
    

///////////////////////////////////////
//     CUSTOM FAVICON SECTION       //
/////////////////////////////////////
	

//CUSTOM FAVICON SETTINGS
$wp_customize->add_setting('custom_favicon', array(
    'default'           => '',
    'type' => 'option'

));

//CUSTOM FAVICON
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'custom_favicon', array(
    'label'    => __('Custom Favicon Upload', 'slowave'),
    'section'  => 'title_tagline',
    'settings' => 'custom_favicon',
    'priority'       => 21,
)));

//CUSTOM FAVICON SETTINGS
$wp_customize->add_setting('mobile_favicon', array(
    'default'           => '',
    'type' => 'option'

));

//CUSTOM FAVICON
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'mobile_favicon', array(
    'label'    => __('Non-Retina Mobile Favicon Upload', 'slowave'),
    'section'  => 'title_tagline',
    'settings' => 'mobile_favicon',
    'priority'       => 22,
)));

//CUSTOM FAVICON SETTINGS
$wp_customize->add_setting('72_favicon', array(
    'default'           => '',
    'type' => 'option'
));

//CUSTOM FAVICON
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, '72_favicon', array(
    'label'    => __('1st & 2nd Generation iPad Favicon (72x72px)', 'slowave'),
    'section'  => 'title_tagline',
    'settings' => '72_favicon',
    'priority'       => 23,
)));

//CUSTOM FAVICON SETTINGS
$wp_customize->add_setting('114_favicon', array(
   'default'           => '',
   'type' => 'option'
));

//CUSTOM FAVICON
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, '114_favicon', array(
   'label'    => __('Retina iPhone Favicon (114x114px)', 'slowave'),
   'section'  => 'title_tagline',
   'settings' => '114_favicon',
   'priority'       => 24,
)));

//CUSTOM FAVICON SETTINGS
$wp_customize->add_setting('144_favicon', array(
    'default'           => '',
    'type' => 'option'
));

//CUSTOM FAVICON
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, '144_favicon', array(
    'label'    => __('Retina iPad Favicon (144x144px)', 'slowave'),
    'section'  => 'title_tagline',
    'settings' => '144_favicon',
    'priority'       => 25,
)));

///////////////////////////////////////
//     CUSTOM CSS SECTION           //
/////////////////////////////////////

//CREATE CUSTOM CSS SUBSECTION
$wp_customize->add_section( 'custom_css_section', array(
	'title'          => 'Custom CSS',
	'priority'       => 200,
) ); 
      
$wp_customize->add_setting( 'custom_css', array(
  'default'        => '',
  'type'           => 'option',
) );

$wp_customize->add_control( new Ebor_Customize_Textarea_Control( $wp_customize, 'custom_css', array(
  'label'   => __('Custom CSS', 'slowave'),
  'section' => 'custom_css_section',
  'settings'   => 'custom_css',
) ) );


///////////////////////////////////////
//     FOOTER SETTINGS             //
/////////////////////////////////////
	
//CREATE CUSTOM CSS SUBSECTION
$wp_customize->add_section( 'footer_section', array(
	'title'          => 'Footer Settings',
	'priority'       => 40,
) );

//copyright text
$wp_customize->add_setting( 'copyright', array(
    'default'        => 'Configure in "Appearance" => "Customise new" => "Footer"',
    'type' => 'option'
) );

//copyright text
$wp_customize->add_control( new Ebor_Customize_Textarea_Control( $wp_customize, 'copyright', array(
    'label'   => __('SubFooter Copyright Text', 'slowave'),
    'section' => 'footer_section',
    'settings'   => 'copyright',
    'priority' => 1,
) ) );

$i = 1;
while( $i < 11 ){
	//footer social 1
	$wp_customize->add_setting("footer_social_$i", array(
	    'default'        => 'pinterest',
	    'type' => 'option'
	));
	
	//footer social 1
	$wp_customize->add_control( "footer_social_$i", array(
	    'label'   => __("Footer Social Icon $i (Single Page Version Only)", 'slowave'),
	    'section' => 'footer_section',
	    'type'    => 'select',
	    'priority' => 10 + $i + $i,
	    'choices'    => $social_options
	));
	
	//footer social 1 link
	$wp_customize->add_setting( "footer_social_link_$i", array(
	    'default'        => '',
	    'type' => 'option'
	) );
	
	//footer social 1 link
	$wp_customize->add_control( "footer_social_link_$i", array(
	    'label' => __("Footer Social Link $i (Single Page Version Only)", 'slowave'),
	    'type' => 'text',
	    'section' => 'footer_section',
	    'priority' => 11 + $i + $i,
	) );
	$i++;
}
      	
}