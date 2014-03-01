<?php 
	/**
	 * footer.php
	 * The footer used in Slowave
	 * @author TommusRhodus
	 * @package Slowave
	 * @since 1.0.0
	 */
?>

<footer class="black-wrapper" style="padding-top: 40px;">
    <div class="container inner text-center">
      
      <?php echo wpautop(htmlspecialchars_decode(get_option('copyright', 'Configure this message in "appearance" => "customize"'))); ?>
      
      <ul class="social">
        
        <?php 
        	$i = 1; 
        	while( $i < 11 ){
        		if( get_option("footer_social_link_$i") ) {
            		echo '<li><a href="' . esc_url(get_option("footer_social_link_$i")) . '" target="_blank"><i class="icon-s-' . get_option("footer_social_$i") . '"></i></a></li>';
        		}
        		$i++;
        	} 
        ?>
        
      </ul>
      
    </div>
  </footer>
  
</div>

<?php wp_footer(); ?>
</body>
</html>