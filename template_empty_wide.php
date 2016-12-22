<?php

/*
 * Template Name: Empty Page Wide
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

.widget-area {
    width: 15%;
}

.site-content {
	width: 85%;
	margin : 0 0 0;
}

body .site {
	margin-bottom : 0;
}

footer[role="contentinfo"] {
	padding : 0.2rem;
	margin-top : 0.2rem;
	max-width : none;
}
</style>

<div id="primary" class="site-content">
	<div id="content" role="main">

	
		<?php echo do_shortcode(get_post()->post_content);?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>