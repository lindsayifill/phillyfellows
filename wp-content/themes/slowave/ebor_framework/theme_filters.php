<?php

/**
 * Ebor Framework
 * Theme Filters
 * @since version 1.0
 * @author TommusRhodus
 */

if(!( function_exists('mh_youtube_wmode') )){
	function mh_youtube_wmode( $content ) {
		$mh_youtube_regex = "/\<iframe .*\.com.*><\/iframe>/";
		preg_match_all( $mh_youtube_regex , $content, $mh_matches );
		if ( $mh_matches ) {;
	    	for ( $mh_count = 0; $mh_count < count( $mh_matches[0] ); $mh_count++ ){
	            $mh_old = $mh_matches[0][$mh_count];
	            $mh_new = str_replace( "?feature=oembed" , '?wmode=transparent' , $mh_old );
	            $mh_new = preg_replace( '/\><\/iframe>$/' , ' wmode="Opaque"></iframe></figure>' , $mh_new );
	            $mh_new = str_replace( "<iframe" , "<figure class='media-wrapper player'><iframe" , $mh_new );
	            $content = str_replace( $mh_old, $mh_new , $content );
	        }
	    }
		return $content;
	}
}
add_filter( 'the_content' , 'mh_youtube_wmode' , 15 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function _s_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'slowave' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', '_s_wp_title', 10, 2 );

if(!( function_exists('ebor_excerpt_more') )){
	function ebor_excerpt_more( $more ) {
		return '.';
	}
}
add_filter('excerpt_more', 'ebor_excerpt_more');

if(!( function_exists('ebor_excerpt_length') )){
	function ebor_excerpt_length( $length ) {
		return 25;
	}
}
add_filter( 'excerpt_length', 'ebor_excerpt_length', 999 );

add_filter('widget_text', 'do_shortcode');

/**
 * Custom gallery shortcode
 *
 * Filters the standard WordPress gallery shortcode.
 *
 * @since 1.0.0
 */
function ebor_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'large',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }
    
    if( $columns == 1 ){
    	$columns = 12;
    } elseif( $columns == 2 ){
    	$columns = 6;
    } elseif( $columns == 3 ){
    	$columns = 4;
    } elseif( $columns == 4 ){
    	$columns = 3;
    } elseif( $columns == 5 || $columns == 6 ){
    	$columns = 2;
    } else {
    	$columns = 1;
    }

    $output = "<div class='row'>";

    foreach ( $attachments as $id => $attachment ) {
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_url($id, $size, false, false) : wp_get_attachment_url($id, $size, true, false);

        $output .= "<{$itemtag} class='col-sm-$columns'>";
        
        $output .= '<figure class="icon-overlay medium icn-more">
        				<a href="'. $link .'" class="fancybox-media" data-rel="portfolio" rel="portfolio">
        					' . wp_get_attachment_image($id, $size) . '
        				</a>
        			</figure>';
        
        $output .= "</{$itemtag}>";
    }

    $output .= "</div>\n";

    return $output;
}
add_filter( 'post_gallery', 'ebor_post_gallery', 10, 2 );

/**
 * Add Search Link to Menu
 */
function ebor_one_page_nav_rewrite($items, $args) {
	global $post;
	
	if(!( is_page_template('page_one_pager.php') )){
		return str_replace('href="#section', 'href="' . home_url() . '/#section', $items);
	} else {
		return $items;
	}
}
if( get_option('site_version', 'multipage') == 'one-page' )
	add_filter( 'wp_nav_menu_items', 'ebor_one_page_nav_rewrite', 20,2 );
	

function ebor_default_backgrounds( $backgrounds ) {
	
	$i = 0;
	while( $i < 18 ){
		$i++;
	    $backgrounds['background-' . $i] = array(
	        'url'           => '%s/style/images/bg/bg' . $i . '.jpg',
	    );
    }

    return $backgrounds;
}
add_filter( 'jt_default_backgrounds', 'ebor_default_backgrounds' );