<?php
/**
 * Template Name: Start page
 */

include_once '171_header.php';

$url = get_site_url(1);
?>

<div id="logoSVG" style="position: absolute;">
	<object type="image/svg+xml" width="100%" height="100%" data="<?php echo $url?>/wp-content/uploads/VA_logo.svg">
	</object>
</div>

<!--<div style="position: fixed; bottom: 8%; width:100%; text-align: center"> WINTER-->
<div style="position: fixed; top: 80%; left: 10%; width: 80%; text-align: center">
	<h1 style="font-size: 2.5vh">
		<span style="white-space: nowrap;">
			<img src="<?php echo $url?>/wp-content/plugins/multilingual-press/assets/images/flags/de.gif" />
			<a href="<?php echo get_site_url(1) . '?page_id=162&db=171'; ?>">Deutsch</a>
		</span>
		
		<span style="white-space: nowrap;">
			<img src="<?php echo $url?>/wp-content/plugins/multilingual-press/assets/images/flags/fr.gif" />
			<a href="<?php echo get_site_url(1) . '/fr/?page_id=4&db=171'; ?>">Français</a>
		</span>

		<span style="white-space: nowrap;">
			<img src="<?php echo $url?>/wp-content/plugins/multilingual-press/assets/images/flags/it.gif" />
			<a href="<?php echo get_site_url(1) . '/it/?page_id=10&db=171'; ?>">Italiano</a>
		</span>
		
		<span style="white-space: nowrap;">
			<img src="<?php echo $url?>/wp-content/plugins/verba-alpina/images/rg.jpg" />
			<a href="<?php echo get_site_url(1) . '/rg/?page_id=162&db=171'; ?>">Rumantsch&nbsp;Grischun</a>
		</span>
		
		<span style="white-space: nowrap;">
			<img src="<?php echo $url?>/wp-content/plugins/multilingual-press/assets/images/flags/si.gif" />
			<a href="<?php echo get_site_url(1) . '/si/?page_id=5&db=171'; ?>">Slovenščina</a>
		</span>
	</h1>
</div>

<div class="modal fade" id="flyer_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-body">

            <div class="social_icon_container">
            <i id="facebook_icon" class="social_icon fa fa-facebook-official" aria-hidden="true"></i>
            <i id="twitter_icon" class="social_icon fa fa-twitter-square" aria-hidden="true"></i>
            </div>

     <div class="flyer_custom_close"><span class="fa-stack"><i style="font-size: 27px;" class="fa fa-circle fa-stack-1x" aria-hidden="true"></i><i style="color:#3f84c5" class="fa fa-times-circle fa-stack-1x" aria-hidden="true"></i></span></div>

       <div class="slogan_wrapper">
        <div class="slogan_div">Sprich die Sprache der Alpen!</div>   
 
 <!-- 
         <div class = "custom_header"><img src="<?php echo plugins_url('assets/images/',__FILE__)?>favicon_bw.png"></img>Verba Alpina </div>  -->

      
        <img style="width:100%; padding-top: 22px;" src="<?php echo get_site_url(1);?>/wp-content/themes/verba-alpina/images/fyler_a5_cut_n.jpg">

        </div>

        <div class="join_button"><div class="join_button_border"><span class="join_span">Mitmachen!</span></div></div>
           
         <div id="first_slider" class="carousel slide" data-ride="carousel" data-interval="2000" data-pause="false">

          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
             <img style="width:100%" src="<?php echo get_site_url(1);?>/wp-content/themes/verba-alpina/images/fyler_a5_de_text_n.jpg">
            </div>
                <div class="carousel-item">
             <img style="width:100%" src="<?php echo get_site_url(1);?>/wp-content/themes/verba-alpina/images/fyler_a5_fra_text_n.jpg">
            </div>
                <div class="carousel-item">
             <img style="width:100%" src="<?php echo get_site_url(1);?>/wp-content/themes/verba-alpina/images/fyler_a5_ita_text_n.jpg">
            </div>
                <div class="carousel-item">
             <img style="width:100%" src="<?php echo get_site_url(1);?>/wp-content/themes/verba-alpina/images/fyler_a5_slow_text_n.jpg">
            </div>
    
          </div>

        </div>
      </div><!-- /.modal-body -->
      <div class="modal-footer customfooter"></div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  



<!-- <script src="<?php echo $url?>/wp-content/plugins/plugin_va-crowd/assets/js/jquery.js" type="text/javascript"></script> -->
<script src="<?php echo $url?>/wp-content/plugins/plugin_va-crowd/assets/js/tether.min.js" type="text/javascript"></script>
<script src="<?php echo $url?>/wp-content/plugins/plugin_va-crowd/assets/js/bootstrap.min.js" type="text/javascript"></script>



<?php
 get_footer('start');
 ?>