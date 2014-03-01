<?php 

/**
 * Get Wrapper Start Title - Uses get_template_part for simple child themeing.
 */
get_template_part('inc/wrapper','starttitle'); 
    
the_title('<h1 class="entry-title">','</h1>');

/**
 * Get Wrapper End title - Uses get_template_part for simple child themeing.
 */
get_template_part('inc/wrapper','endtitle'); 