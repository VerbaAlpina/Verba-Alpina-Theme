<?php 
/*
 * This is the page users will see logged in. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>
<style type="text/css">



#wp-logout-icon:hover{
    opacity: 0.75;
    cursor: pointer;
}

</style>

<div class="lwa" style="padding-top:5px; padding-right:5px;">
	<?php 
		$user = wp_get_current_user();
	?>
	<!--<span class="lwa-title-sub" style="display:none"><?php echo __( 'Hi', 'login-with-ajax' ) . " " . $user->display_name  ?></span>-->
	<!--<table>
		<tr>-->
			<!--<td class="avatar lwa-avatar">
				<?php //echo get_avatar( $user->ID, $size = '50' );  ?>
			</td>-->
			<td class="lwa-info">

				<?php
					//Admin URL
					if ( $lwa_data['profile_link'] == '1' ) {
						if( function_exists('bp_loggedin_user_link') ){
							?>
							<a href="<?php bp_loggedin_user_link(); ?>"><?php esc_html_e('Profile','login-with-ajax') ?></a><br/>
							<?php	
						}else{
							?>
							<a href="<?php echo trailingslashit(get_admin_url()); ?>profile.php"><?php esc_html_e('Profile','login-with-ajax') ?></a><br/>
							<?php	
						}
					}
					//Logout URL
					?>
					<!-- class="btn btn-outline-secondary btn-sm"  role="button" -->
					<!-- <i class="fa fa-camera-retro fa-lg"></i> -->
					<a  style="color: white;  text-decoration: none;" id="wp-logout" href="<?php echo wp_logout_url() ?>">

					<i id="wp-logout-icon" class="fa fa-times"  aria-hidden="true"></i>
					<div id="user_profile"><?php echo wp_get_current_user()->user_login; ?></div>

					<!-- <i style="padding-right:5px;" class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i> --></a><br />
					<!---->
					<!-- <?php //esc_html_e( 'Log Out' ,'login-with-ajax') ?> -->
					<!-- <a href="#" id="firstButton" class="btn btn-primary" rel="popover" data-message="Message">Click Me (Working)</a>
					<script type="text/javascript">
					jQuery(function () {	
					    jQuery('#firstButton').popover({
					      container: "body",
					      html: true,
					      content: function () {
					        return '<div class="popover-message">' + jQuery(this).data("message") + '</div>';
					      }
					    });
					 })   
					</script> -->

					<!---->
					<?php
					//Blog Admin
					if( current_user_can('list_users') ) {
						?>
						<a href="<?php echo get_admin_url(); ?>"><?php esc_html_e("blog admin", 'login-with-ajax'); ?></a>
						<?php
					}
				?>
			</td>
		<!--</tr>
	</table>-->
</div>