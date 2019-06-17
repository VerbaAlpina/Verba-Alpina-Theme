<?php

/*
 * Template Name: Empty Page
 */
 
if(isset($_REQUEST['format']) && $_REQUEST['format'] == 'iframe'){
    ?>
    <!DOCTYPE html>

    <html>
    	<head>
    		<?php wp_head(); ?>
    	</head>
    	<body>
            <div id="primary" class="site-content" style="background: white;">
            	<div id="content" role="main">
                    <?php
                    echo '<div class="entry-content">' . do_shortcode(apply_filters('the_content', get_post()->post_content)) . '</div>';
                    ?>
            	</div><!-- #content -->
            </div><!-- #primary -->
            <?php wp_footer(); ?>
        	</body>
    </html>
    <?php
}
else {
    get_header(); 
    ?>
    
    <div id="primary" class="site-content">
    	<div id="content" role="main">
    	
    		<?php 
    			echo '<header class="entry-header"><h1 class="entry-title"><span>' . get_the_title() . '</span></h1></header>';
    			echo '<div class="entry-content">' . do_shortcode(apply_filters('the_content', get_post()->post_content)) . '</div>';
    			?>
    
    	</div><!-- #content -->
    </div><!-- #primary -->
    
    <?php //get_sidebar(); ?>
    <?php get_footer(); 
}
?>