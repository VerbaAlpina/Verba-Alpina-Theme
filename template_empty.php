<?php

/*
 * Template Name: Empty Page
 */
 
get_header(); 
?>

<div id="primary" class="site-content">
	<div id="content" role="main">
	
		<?php 
			echo '<header class="entry-header"><h1 class="entry-title"><span>' . get_the_title() . '</span></h1></header>';
			echo '<div class="entry-content">' . do_shortcode(get_post()->post_content) . '</div>';
			?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>