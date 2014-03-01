<div class="light-wrapper">
  <div class="container inner">
  
    <div class="section-title text-center">
      <h2><?php echo get_option('portfolio_sharing_title', 'Share This Work'); ?></h2>
      <span class="icon"><i class="icon-picons-earth"></i></span> 
    </div>
    
   <?php get_template_part('loop/content','sharing'); ?>
    
  </div>
</div>