<?php
/**
 * Template Name: Plugin Fullscreen Template CS
 * Description: Display Plugin in Fullscreen CS
 *
 * 
 * 
 * 
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1 user-scalable=0">

	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
		
	<?php wp_head(); ?>

	<style>
	
	html{
	 overflow: hidden;
	}

	</style>
</head>
<body>


		<?php 
			echo '<div class="entry-content">' . do_shortcode(get_post()->post_content) . '</div>';
			?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <?php //echo do_shortcode('[clean-login-register]'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

	</div><!-- #content -->
</div><!-- #primary -->


<?php
wp_footer();
 ?>
 </body>
 </html>