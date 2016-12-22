<?php 
/*
 * This is the page users will see logged out. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>

	<div id="login_div" style="position:absolute;top:0;right:0; padding-top:5px; padding-right:5px;" class="lwa lwa-template-modal"><?php //class must be here, and if this is a template, class name should be that of template directory ?>

		
<!-- data-toggle="popover" data-content="And here's some amazing content. It's very engaging. Right?" -->
		<a role="button"  id="open_login_modal" style="color: white;" data-toggle="modal" data-target="#register_modal" href="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" ><!-- <i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> --><i id="icon_login" class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i><?php// esc_html_e('Log In','login-with-ajax') ?></a>
<!-- class="lwa-links-modal btn btn-default btn-xs" -->


		<?php 
		//FOOTER - once the page loads, this will be moved automatically to the bottom of the document.
		?>
		<div class=" modal fade in"  id="register_modal" style="display:none;"><!--lwa-modal-->
			<div class="modal-dialog" role="document">
				<div class="modal-content">

				<div class="customclose"><i class="fa fa-times" aria-hidden="true"></i></div>
		
		<!--(this template)-->		
		<div class="modal-body">
				
				<div class="custom_header">
				 	<img src="<?php echo plugins_url('plugin_va-crowd/assets/images/')?>favicon_bw.png"></img>Verba Alpina 
				 </div>

<!-- data-ride="carousel"   data-interval="false"  data-keyboard="true"--> 
		<div id="login_slider" class="carousel">
			<div class="carousel-inner" role="listbox">


		<!--Login Form-->
		<div id="login_slide" class="carousel-item active">
	        <form style="padding-top: 10px;" name="lwa-form" class="lwa-form" action="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" method="post">
	        	<span class="lwa-status"></span>
	            <table>
	                <tr class="lwa-username">
	                    <td class="username_label">
	                        <label>Username<?php// esc_html_e( 'Username','login-with-ajax' ) ?></label>
	                    </td>
	                    <td class="username_input">
	                       <div> <input type="text"  name="log" id="lwa_user_login"  class="input form-control"/> </div>
	                    </td>
	                </tr>
	                <tr class="lwa-password">
	                    <td class="password_label">
	                        <label>Password<?php// esc_html_e( 'Password','login-with-ajax' ) ?></label>
	                    </td>
	                    <td class="password_input">
	                        <input type="password" name="pwd" id="lwa_user_pass" class="input form-control" value="" />
	                    </td>
	                </tr>
                	<tr><td colspan="2"><?php do_action('login_form'); ?></td></tr>
	                <tr class="lwa-submit">
	                    <td class="lwa-submit-button">
	                        <button type="submit" name="wp-submit" class="lwa-wp-submit btn btn-primary " value="<?php esc_attr_e('Log In','login-with-ajax'); ?>" tabindex="100">Log In<?php //esc_attr_e('Log In','login-with-ajax'); ?></button>
	                        <input type="hidden" name="lwa_profile_link" value="<?php echo !empty($lwa_data['profile_link']) ? 1:0 ?>" />
                        	<input type="hidden" name="login-with-ajax" value="login" />
							<?php if( !empty($lwa_data['redirect']) ): ?>
							<input type="hidden" name="redirect_to" value="<?php echo esc_url($lwa_data['redirect']); ?>" />
							<?php endif; ?>
	                    </td>
	                    <td class="lwa-links">
	                        <input name="rememberme" type="checkbox" id="lwa_rememberme" value="forever"/> <label>Remember Me<?php// esc_html_e( 'Remember Me','login-with-ajax' ) ?></label>
	                        <br />			
	                    </td>
	                </tr>
	            </table>
	        </form>
	         </div><!--carousel-item active-->
	        <!--END Login Form-->

	        <!-- <div id="login_slider" class="carousel slide" data-ride="carousel" data-interval="false">
				<div class="carousel-inner" role="listbox"> -->
	        <!--Lost Password Form-->
	        <div id="remember_slide" class="carousel-item">
        	<?php if( !empty($lwa_data['remember']) && $lwa_data['remember'] == 1 ): ?>
	        <form style="display:block;" name="lwa-remember" class="lwa-remember" action="<?php echo esc_attr(LoginWithAjax::$url_remember); ?>" method="post" style="display:none;">
	        	<span class="lwa-status"></span>
	            <table>
	                <tr>
	                    <td>
	                        <strong>Forgotten Password<?php //esc_html_e("Forgotten Password", 'login-with-ajax'); ?></strong>         
	                    </td>
	                </tr>
	                <tr class="lwa-remember-email">	                    
	                	<td>
	                		<div>
	                        <?php $msg = "Enter username or email"/*__("Enter username or email", 'login-with-ajax')*/; ?>
	                        <input class="form-control" type="text" name="user_login" id="lwa_user_remember" value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
	                        </div>
							<?php do_action('lostpassword_form'); ?>
	                    </td>
	                </tr>
	                <tr>
	                    <td>
	                        <button type="submit" class="btn btn-primary " value="<?php esc_attr_e("Get New Password", 'login-with-ajax'); ?>">Get New Password<?php //esc_attr_e("Get New Password", 'login-with-ajax'); ?></button>
	                        <input type="hidden" name="login-with-ajax" value="remember" />
	                    </td>	                
	                </tr>
	            </table>
	        </form>
	        <?php endif; ?>
	        </div><!--class="carousel-item"-->
	        <!--END Lost Password Form-->

 			<!--Register Form-->
 			<div id="register_slide" class="carousel-item">
		    <?php if ( get_option('users_can_register') && !empty($lwa_data['registration']) && $lwa_data['registration'] == 1 ) : //Taken from wp-login.php ?>
		    <div class="lwa-register" style="display:block;">
		    <strong>Register For This Site<?php //esc_html_e('Register For This Site','login-with-ajax') ?></strong> 
				<form name="lwa-register"  action="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" method="post">
	        		<span class="lwa-status"></span>
					<table class="table-sm">
		                <tr>
		                    <td>
		                        <!-- <strong><?php esc_html_e('Register For This Site','login-with-ajax') ?></strong>  -->        
		                    </td>
		                </tr>
		                <tr class="lwa-username">
		                    <td>  
		                    	<div>
		                        <?php $msg = Username /*__('Username','login-with-ajax')*/; ?>
		                        <input type="text" class="form-control" style="width:100%" name="user_login" id="user_login"  value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
		                        </div> 
		                    </td>
		                    <td><!--pass emailed to you-->
		                    A password will be e-mailed to you.
		                    	<?php //esc_html_e('A password will be e-mailed to you.', 'login-with-ajax'); ?><br />
		                    </td>
		                </tr>
		                <tr class="lwa-email">
		                    <td>
		                    	<div>
		                        <?php $msg = __('E-mail','login-with-ajax') ?>
		                        <input type="text" class="form-control" style="width:100%" name="user_email" id="user_email"  value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}"/>
		                        </div>
		                    </td>
		                    <td><!--register button-->
		                    	<button type="submit" class="btn btn-primary " value="<?php esc_attr_e('Register','login-with-ajax'); ?>" tabindex="100">Register<?php// esc_attr_e('Register','login-with-ajax'); ?></button>
		                    </td>
		                </tr>
		                <tr>
		                    <td>
								<?php
								//If you want other plugins to play nice, you need this: 
								do_action('register_form'); 
							?>
		                    </td>
		                </tr>
		                <!-- <tr>
		                	<td>
		                	<p>
					            <label style="display:block;" for="array_data"><?php _e( 'Array_data', 'mydomain' ) ?><br />
					                <input type="text" name="array_data" id="array_data" class="input" value="<?php echo esc_attr( wp_unslash( $array_data ) ); ?>" size="25" /></label>
					        </p>
		                	</td>
		                </tr> -->
		                <!-- <tr>
		                    <td>
		                        <?php esc_html_e('A password will be e-mailed to you.', 'login-with-ajax'); ?><br />
								<button type="submit" class="btn btn-primary btn-lg" value="<?php esc_attr_e('Register','login-with-ajax'); ?>" tabindex="100"><?php esc_attr_e('Register','login-with-ajax'); ?></button>
								<!-- <a href="#" class="lwa-links-register-inline-cancel"><?php esc_html_e("Cancel",'login-with-ajax'); ?></a> -->
								<!--<input type="hidden" name="login-with-ajax" value="register" />
		                    </td>
		                </tr> -->
		            </table>
				</form>
			</div>
			<?php endif; ?>
			</div><!--carousel-item-->
			<!--END Register Form-->

		</div><!--carousel-inner" -->

		</div><!--login_slider-->
		<!-- </div> -->

		<div style="padding-top:10px;"class="custom-modal-footer">
	<!-- 		<button type="button" class="btn btn-primary" data-target="#login_slider" data-slide-to="0">LogIn</button>
			<button type="button" class="btn btn-primary" data-target="#login_slider" data-slide-to="1">Forgot Password</button>
			<button type="button" class="btn btn-primary" data-target="#login_slider" data-slide-to="2">Register</button>
			 -->
			 <button type="button" class="btn btn-secondary btn-sm" onclick="showSlide('login');">Login</button>
			<button type="button" class="btn btn-secondary btn-sm" onclick="showSlide('remember');">Forgot Password</button>
			<button type="button" class="btn btn-secondary btn-sm" onclick="showSlide('register');">Register</button>
			
      	</div>

		</div><!--modal body-->
		</div><!--modal content-->
		</div><!--modal document-->
	</div><!--modal fade-->
</div>