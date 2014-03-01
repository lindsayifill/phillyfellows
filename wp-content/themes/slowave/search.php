<?php 
	/**
	 * search.php
	 * The search results template used in Slowave
	 * @author TommusRhodus
	 * @package Slowave
	 * @since 1.0.0
	 */
	get_header(); 
	global $wp_query;
	$total_results = $wp_query->found_posts;
	( $total_results == '1' ) ? $items = __('Item','slowave') : $items = __('Items','slowave'); 
	
	/**
	 * Get Wrapper Start Title - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','starttitle'); 
?>
    
      <h1 class="pull-left">
      		<?php 
      			echo sprintf( __('Your Search For:','slowave') . ' %s, ' . __( 'returned:', 'slowave' ) . ' %s %s ', get_search_query(), $total_results, $items);
      		?>
      </h1>
      
      <div class="navigation pull-right"> 
      	<?php
      		previous_posts_link("<i class='icon-left-open-1'></i>" );
      		echo ' ';
      		next_posts_link("<i class='icon-right-open-1'></i>" ); 
      	?>
      </div>
  
<?php 
	/**
	 * Get Wrapper End title - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','endtitle'); 
	
	/**
	 * Get Wrapper Start - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','start'); 
	
	get_template_part('loop/loop','blogfeed'); 
	
	/**
	 * Get Wrapper End - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','end'); 
	
	get_footer();