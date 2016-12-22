<?php

/*
 * Template Name: Empty Page (Dev)
 * Description: Shows the page without footer
 */
 
get_header(); 
?>

<style type="text/css">

@media screen and (min-width: 600px) {
.site {
    max-width: 2000px
}
}
.wrapper {
	width: 100%;
}

.site-content {
	width: 85%
}

#content {
	float: none;
	margin-left: auto;
  	margin-right: auto;
  	width: 58.28569rem;
}


.widget-area {
    width: 15%;
}

</style>

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