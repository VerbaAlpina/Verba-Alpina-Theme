<?php

/*
 * Template Name: Empty Page
 * Description: Shows the page without footer
 */
 
get_header(); 
?>

<div id="primary" class="site-content">
	<div id="content" role="main">
		
	
		<?php //while ( have_posts() ) : the_post();
				//get_template_part( 'content', 'page' );
				//the_content();
			//endwhile; // end of the loop. 
			echo '<div class="entry-content">' . do_shortcode(get_post()->post_content) . '</div><br /><br /><br /><br /><br />';
			?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>