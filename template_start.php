<?php
/**
 * Template Name: Start page
 */

if (isset($_REQUEST['db']) && file_exists(__DIR__  . '/old_start_pages/' . $_REQUEST['db'] . '.php')){
	include_once __DIR__  . '/old_start_pages/' . $_REQUEST['db'] . '.php';
	die;
}

 get_header('start');
 
 $url = get_site_url(1);
?>

<div class="version_div"> <img type="image/svg+xml" width="35px" src="<?php echo $url?>/wp-content/themes/verba-alpina/images/VA_Version.svg"></img></div>

<div class="info_div langbtn" title ="<?php echo $Ue['BILDMATERIAL'] ?>"> <a href="<?php echo va_get_glossary_link(200); ?>"><img src="<?php echo $url?>/wp-content/themes/verba-alpina/images/VA_Infobutton.png"></img></a></div>


<div class="gradient_overlay"></div>
<div class="lmu_signum"><img src="<?php echo $url?>/wp-content/themes/verba-alpina/images/Sigillum_Universitatis_Ludovico-Maximilianeae_white.svg"></div>

<div class="logo_container_outer">

  <div id="logoSVG">

    <div class="logo_container">

      <img id="svg_object" type="image/svg+xml" width="100%" src="<?php echo $url?>/wp-content/themes/verba-alpina/images/VA_LOGO_SVG_triangles.svg"></img>
    
      <div class="circle_container">
          <button class="langbtn">
            <img title="Deutsch" data-link="<?php echo get_site_url(1) . '?page_id=162'; ?>" class="lang_circle" src="<?php echo $url?>/wp-content/themes/verba-alpina/images/circle_de.svg.png">
          </button>  
          <button class="langbtn">
            <img title="Français" data-link="<?php echo get_site_url(1) . '/fr/?page_id=4'; ?>" class="lang_circle" src="<?php echo $url?>/wp-content/themes/verba-alpina/images/circle_fr.svg.png">
          </button>    
          <button class="langbtn">  
            <img title="Italiano" data-link="<?php echo get_site_url(1) . '/it/?page_id=10'; ?>" class="lang_circle" src="<?php echo $url?>/wp-content/themes/verba-alpina/images/circle_it.svg.png">
           </button>     
          <button class="langbtn">  
            <img title="Slovenščina" data-link="<?php echo get_site_url(1) . '/si/?page_id=5'; ?>" class="lang_circle" src="<?php echo $url?>/wp-content/themes/verba-alpina/images/circle_sl.svg.png">
          </button>    
          <button class="langbtn">  
            <img title="Rumantsch Grischun" data-link="<?php echo get_site_url(1) . '/rg/?page_id=162'; ?>" class="lang_circle" src="<?php echo $url?>/wp-content/themes/verba-alpina/images/circle_rg.svg.png">
          </button>    
          <button class="langbtn">  
            <img title="English" data-link="<?php echo get_site_url(1) . '/en/?page_id=162'; ?>" class="lang_circle" src="<?php echo $url?>/wp-content/themes/verba-alpina/images/circle_en.svg.png">
          </button>    
      
        </div>

    </div>

  </div>
</div>

<div class="contribute_container">
<a href="<?php echo get_site_url(8);?>?page_id=<?php 

if(is_multisite())
  switch_to_blog(8); 
echo get_page_by_title("Crowdsourcing")->ID; 
if(is_multisite())
  restore_current_blog();?>">
  <span style="display: block;">
    <div>
          <img class="active" id="svg_img"  src="<?php echo $url?>/wp-content/themes/verba-alpina/images/contribute_de.svg">
          <img style="display: none" id="svg_img"  src="<?php echo $url?>/wp-content/themes/verba-alpina/images/contribute_fr.svg">
          <img style="display: none" id="svg_img"  src="<?php echo $url?>/wp-content/themes/verba-alpina/images/contribute_it.svg">
          <img style="display: none" id="svg_img"  src="<?php echo $url?>/wp-content/themes/verba-alpina/images/contribute_sl.svg">
    </div>
   </span>
</a>  
</div>


<!-- 
<div class="modal fade" id="flyer_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-body">

            <div class="social_icon_container">
            <i id="facebook_icon" class="social_icon fab fa-facebook-square" aria-hidden="true"></i>
            <i id="twitter_icon" class="social_icon fab fa-twitter-square" aria-hidden="true"></i>
            <i id="youtube_icon" class="social_icon fab fa-youtube-square" aria-hidden="true"></i>
            </div>

     <div class="flyer_custom_close"><span class="fa-stack"><i style="font-size: 27px;" class="fa fa-circle fa-stack-1x" aria-hidden="true"></i><i style="color:#3f84c5" class="fa fa-times-circle fa-stack-1x" aria-hidden="true"></i></span></div>

       <div class="slogan_wrapper">
        <div class="slogan_div">Sprich die Sprache der Alpen!</div>   
 

         <div class = "custom_header"><img src="<?php echo plugins_url('assets/images/',__FILE__)?>favicon_bw.png"></img>Verba Alpina </div>  

      
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
      </div>
      <div class="modal-footer customfooter"></div>
    </div>
  </div>
</div> -->

<?php
 get_footer('start');
 ?>
 
 <script src="<?php echo $url?>/wp-content/plugins/plugin_va-crowd/assets/js/tether.min.js" type="text/javascript"></script>
<script src="<?php echo $url?>/wp-content/plugins/plugin_va-crowd/assets/js/bootstrap.min.js" type="text/javascript"></script>