<?php 
	/**
	 * single.php
	 * The single blog post template in Slowave
	 * @author TommusRhodus
	 * @package Slowave
	 * @since 1.0.0
	 */
	get_header(); 
	the_post();	
	
	$format = get_post_format(); 
	if( false === $format ) 
		$format = 'standard';
		
	/**
	 * Get Wrapper Start Title - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','starttitle'); 
?>
    
      <h1 class="pull-left"><?php echo get_option('blog_title','Our Journal'); ?></h1>
  
<?php
	get_template_part('loop/content','postnav');
	
	/**
	 * Get Wrapper End title - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','endtitle'); 
	
	/**
	 * Get Wrapper Start - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','start'); 
?>
    
  <div class="row">
  
    <div class="col-sm-8 content">
      <div class="classic-blog single">
      
        <div id="post-<?php the_ID(); ?>" <?php post_class('post format-image'); ?>>
        
          <?php get_template_part('postformats/format', $format); ?>
          
          <div class="post-content image-caption">

            <?php 
            	the_title('<h1 class="post-title entry-title">','</h1>'); 
            	get_template_part('loop/content','metapost');
            	the_content(); 
            	wp_link_pages();
            ?>
              
            <div class="meta tags"><?php the_tags('', ', ', ''); ?></div>
            
            <?php
            	 if( get_option('blog_social','1') == 1 )
            		get_template_part('loop/content','sharing');
            ?>
            
          </div><!-- /.post-content --> 
          
        </div><!-- /.post .format-image --> 
        
      </div>
      
      <?php 
      	if( get_option('blog_author','1') == 1 )
      		get_template_part('loop/content','author'); 
      	
      	if( comments_open() ) 
      		comments_template(); 
      ?>
      
    </div>
    
    <?php get_sidebar(); ?>
    
  </div><!-- /.row --> 
  
<?php 
	/**
	 * Get Wrapper End - Uses get_template_part for simple child themeing.
	 */
	get_template_part('inc/wrapper','end'); 
	
	get_footer(); ?>