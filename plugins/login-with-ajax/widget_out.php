<?php 
/*
 * This is the page users will see logged out. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>

	<div id="login_div" style="position:absolute;top:0;right:0; padding-top:5px; padding-right:5px;" class="lwa lwa-template-modal"><?php //class must be here, and if this is a template, class name should be that of template directory ?>

		
<!-- data-toggle="popover" data-content="And here's some amazing content. It's very engaging. Right?" -->
		<a role="button"  id="open_login_modal" style="color: white;"   ><!--href="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" data-toggle="modal" data-target="#register_modal" --><!-- <i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> --><span  id="icon_login" class="fa-stack"><i class="fa fa-user-o fa-stack-1x login_child" aria-hidden="true"></i><i class="fa fa-user fa-stack-1x login_child" style="opacity: 0.8; color: #2b2b2b;" aria-hidden="true"></i></span></a>
<!-- class="lwa-links-modal btn btn-default btn-xs" -->


		<?php 
		//FOOTER - once the page loads, this will be moved automatically to the bottom of the document.
		?>
		<div class="modal fade"  id="register_modal" style="display:none;"><!--lwa-modal-->
			<div class="modal-dialog" role="document">
				<div class="modal-content">

				<div class="customclose"><i class="fa fa-times" aria-hidden="true"></i></div>
		
		<!--(this template)-->		
		<div class="modal-body">
		<div id="backgroud_div"></div>		
				<div class="custom_header">
				 	<img src="<?php echo plugins_url('plugin_va-crowd/assets/images/')?>favicon_bw.png"></img>Verba Alpina 
				 </div>

<!-- data-ride="carousel"   data-interval="false"  data-keyboard="true"--> 
		<div id="login_slider" class="carousel">
			<div class="carousel-inner" role="listbox">


		<!--Login Form-->
		<div id="login_slide" class="carousel-item active">
			<strong class="slides_reg slides_ref_login"> Login<?php //esc_html_e("Forgotten Password", 'login-with-ajax'); ?></strong>   
	        <form style="padding-top: 10px;" name="lwa-form" class="lwa-form" action="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" method="post">
	        	<span class="lwa-status"></span>
	            <table>
	                <tr class="lwa-username">
	                    <td class="username_label">
	                        <label class="label_username">Username</label>
	                    </td>
	                    <td class="username_input">
	                       <div> <input type="text"  name="log" id="lwa_user_login" style="background-color:white;" class="input form-control"/> </div>
	                    </td>
	                </tr>
	                <tr class="lwa-password">
	                    <td class="password_label">
	                        <label class="label_password">Password</label>
	                    </td>
	                    <td class="password_input">
	                        <input type="password" name="pwd" id="lwa_user_pass" class="input form-control" value="" />
	                    </td>
	                </tr>


	                <tr class="lwa-submit">
	                    <td class="lwa-submit-button">
	                        <button type="submit" name="wp-submit" class="lwa-wp-submit btn btn-primary " value="<?php esc_attr_e('Log In','login-with-ajax'); ?>" tabindex="100" id="login_btn"><i class="fa fa-sign-in" aria-hidden="true"></i> Login<?php //esc_attr_e('Log In','login-with-ajax'); ?></button>
	                        <input type="hidden" name="lwa_profile_link" value="<?php echo !empty($lwa_data['profile_link']) ? 1:0 ?>" />
                        	<input type="hidden" name="login-with-ajax" value="login" />
							<?php if( !empty($lwa_data['redirect']) ): ?>
							<input type="hidden" name="redirect_to" value="<?php echo esc_url($lwa_data['redirect']); ?>" />
							<?php endif; ?>
	                    </td>
	                </tr>
	            </table>
	        </form><!--END Login Form-->
	    </div><!--END carousel-item active-->

	        


	    <!--Lost Password Form-->
        <div id="remember_slide" class="carousel-item">
    	<?php if( !empty($lwa_data['remember']) && $lwa_data['remember'] == 1 ): ?>
    	<strong class="slides_reg slides_reg_forgot"> Forgot Password<?php //esc_html_e("Forgotten Password", 'login-with-ajax'); ?></strong>   
        <form style="display:block;" name="lwa-remember" class="lwa-remember" action="<?php echo esc_attr(LoginWithAjax::$url_remember); ?>" method="post" style="display:none;">
            <table>
                <tr>
                    <td>
                    <!--  <i class="fa fa-question" aria-hidden="true" style="color: white;"></i><strong class="slides_reg"> Forgot Password<?php //esc_html_e("Forgotten Password", 'login-with-ajax'); ?></strong>    -->      
                    </td>
                </tr>
                <tr style="min-height: 3px"><td><span class="lwa-status"></span></td></tr>
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
                        <button type="submit" class="btn btn-primary get_new_password" value="<?php esc_attr_e("Get New Password", 'login-with-ajax'); ?>"> <i class="fa fa-envelope" aria-hidden="true"></i> Get New Password<?php //esc_attr_e("Get New Password", 'login-with-ajax'); ?></button>
                        <input type="hidden" name="login-with-ajax" value="remember" />
                    </td>	                
                </tr>
            </table>
        </form><!--END Lost Password Form-->
        <?php endif; ?>
        </div><!--END class="carousel-item"-->
	        

		<!--Register Form-->
		<div id="register_slide" class="carousel-item">
	    <?php if ( get_option('users_can_register') && !empty($lwa_data['registration']) && $lwa_data['registration'] == 1 ) : //Taken from wp-login.php ?>
	    <div class="lwa-register" style="display:block;">
	    <strong class="slides_reg slides_reg_register"> Account anlegen oder Daten schicken<?php //esc_html_e('Register For This Site','login-with-ajax') ?></strong> 
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
	                        <?php $msg = __('Username','login-with-ajax');//'Username'; ?>
	                        <input type="text" class="form-control" name="user_login" id="user_login"  value="<?php echo esc_attr($msg); ?>" /> 
	                        </div> 
	                    </td>

	                </tr>

	                <tr class="lwa-email">
	                    <td>
	                    	<div>
	                        <?php $msg = __('E-mail','login-with-ajax') ?>
	                        <input type="text" class="form-control" name="user_email" id="user_email"  value="<?php echo esc_attr($msg); ?>" />
	                        </div>
	                    </td>

	                </tr>

	                <tr class="lwa-userage">
	                    <td>  
	                    	<div>
	                        <?php $msg = __('Age','login-with-ajax');//'Username'; ?>
	                        <input type="text" class="form-control" name="user_age" id="user_age"  value="<?php echo esc_attr($msg); ?>" />
	                        </div> 
	                    </td>

	                </tr>

	                <tr>
	    
	                    <td>
	                        <?php //esc_html_e('A password will be e-mailed to you.', 'login-with-ajax'); ?>
							<button class="register_btn btn" type="submit" value="<?php esc_attr_e('Register','login-with-ajax'); ?>" tabindex="100" /><i class="fa fa-check" aria-hidden="true" style="padding-right: 5px"></i> Register</button>
							<input type="hidden" name="login-with-ajax" value="register" />

							<button type="button" class="send_anonymous_btn btn" onclick="send_anonymous_data();" tabindex="100"  /><i class="fa fa-check" aria-hidden="true" style="padding-right: 5px"></i>Daten anonym schicken</button>
	                    </td>
	                </tr>
	            </table>
			</form>
			<!-- <button class="send_anonymous_btn btn" onclick="send_anonymous_data();" tabindex="100" /><i class="fa fa-check" aria-hidden="true"></i> Anonyme Daten schicken</button> -->
		</div>
		<?php endif; ?>
		</div><!--carousel-item-->
		<!--END Register Form-->

		<!--SEND ANONYMOUS DATA FORM-->

		<!-- <div id="anonymous_data_slide" class="carousel-item">
			<div class="anonymous_data" style="display:block;">
				<table class="table-sm">

					<tr class="lwa-userage">
	                    <td>  
	                    	<div>
	                        <?php $msg = __('Age','login-with-ajax');//'Username'; ?>
	                        <input type="text" class="form-control" name="anonymous_user_age" id="anonymous_user_age"  value="<?php echo esc_attr($msg); ?>" onfocus="if(this.value == '<?php echo esc_attr($msg); ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo esc_attr($msg); ?>'}" />
	                        </div> 
	                    </td>
	                </tr>

	                <tr>
	    
	                    <td>
							<button class="send_anonymous_btn btn" onclick='send_anonymous_data();' tabindex="100" /><i class="fa fa-check" aria-hidden="true"></i> Anonyme Daten schicken</button>
	                    </td>
	                </tr>

	            </table>
			</div>
		</div> -->



	</div><!--carousel-inner" -->

		</div><!--login_slider-->
		

		<div style="padding-top:10px;"class="custom-modal-footer">

			<button type="button" class="login_slider btn btn-secondary btn-sm active_tab" onclick="showSlide('login');"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button>
			<button type="button" class="forgot_pass_slider btn btn-secondary btn-sm" onclick="showSlide('remember');"><i class="fa fa-question" aria-hidden="true"></i> Forgot Password</button>
			<button type="button" class="new_acc_slider btn btn-secondary btn-sm" onclick="showSlide('register');"><i class="fa fa-plus" aria-hidden="true"></i> New Account</button>
			<button type="button" class="reset_slider btn btn-secondary btn-sm" onclick="refresh_page();" ><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
			<!-- <button type="button"  class="anonymous_slider btn btn-secondary btn-sm" onclick="showSlide('anonymous_data_slide');" tabindex="100" /><i class="fa fa-user-secret"></i> Anonyme Daten schicken</button> -->
      	</div>

		</div><!--modal body-->
		</div><!--modal content-->
		</div><!--modal document-->
	</div><!--modal fade-->
</div>