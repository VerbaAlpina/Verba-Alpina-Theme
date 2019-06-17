<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); $url = get_site_url(1); ?>>
<!--<![endif]-->
<head>
<?php if(function_exists('add_favicon')) echo  add_favicon();?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />



<meta property="og:image" content="<?php echo get_stylesheet_directory_uri();?>/images/va_share_logo.png"/>
<meta property="og:title" content="Verba Alpina"/>

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">

<style type="text/css">


#masthead{
    z-index: 2000;
    width: 100%;
    padding: 0;
    position: fixed;
    top: 0;
}


#page{
	margin-top: 60px;
}



@media screen and (max-width: 959px){
	#page{
	margin-top: 45px;
   }
}


@media screen and (max-width: 470px){
	#page{
	margin-top: 60px;
   }

 .entry-header{
  margin-bottom: 14px !important;
 }

 .logo_area_right{
  display: none !important;
 }

  .bottom_logo_dfg{
  display: inline-block !important;
 }

}

@media screen and (max-width: 320px){
 .entry-title{
  margin-top: 30px;
 }


}

.toolbar_left{
    background: transparent url(<?php echo get_stylesheet_directory_uri();?>/images/waveborder_l.png) no-repeat 0 0;
    width: 44px;
    height: 28px;
    margin-right: -3px;
    float: left;
    position: relative;
}

.toolbar_right{
    background: transparent url(<?php echo get_stylesheet_directory_uri();?>/images/waveborder_r.png) no-repeat 0 0;
    width: 44px;
    height: 28px;
    margin-left: -14px;
    float: right;

  }

.toolbar_center{
    background: rgb(251,251,251);
    height: 28px;
    float:left;
    text-align: center;

-webkit-box-shadow:0px 1px 12px 5px rgba(0,0,0,0.15);
-moz-box-shadow: 0px 1px 12px 5px rgba(0,0,0,0.15);
box-shadow: 0px 1px 12px 5px rgba(0,0,0,0.15);

}

.bg_image{
	position: fixed;
	width: 100%;
	height: 100%;
	top: 0;
	background: url(<?php echo get_site_url(1);?>/wp-content/uploads/19_1_titel.jpg) no-repeat center center fixed; 
	opacity: 0.1;
	z-index: -2;
}

.lmu_signum_bg{
	position: fixed;
	opacity: 0.20;
	z-index: -1;
	height: 100%;
    width: 100%;
    top: 0;
}

.lmu_signum_bg > img {
    height: 80%;
    display: flex;
    transform: translateX(-58%);
    position: absolute;
    flex-direction: column;
  justify-content: center;
}

@media screen and (min-width: 1400px){

	.lmu_signum_bg > img {
		  height: 100%;
	}
}

@media screen and (min-width: 1600px){

	.lmu_signum_bg > img {
		  height: 120%;
	}
}


</style>





<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); 
global $Ue;

?>
</head>

<body <?php body_class(); ?>>


<?php 
global $post;
global $admin;


if($post){
	if($post->post_title !="KARTE"){
		?>
			<div class="bg_image"></div>
			<div class="lmu_signum_bg"><img src="<?php echo $url?>/wp-content/themes/verba-alpina/images/Sigillum_Universitatis_Ludovico-Maximilianeae.svg"></div>
		<?php 
	}
}	



if($post){
	$version_pages = array('KARTE', 'METHODOLOGIE', 'KOMMENTARE', 'WISS_PUBLIKATIONEN');
	$single_post = $post && $post->post_type == 'post' && is_single();
	$show_edit_post = ($single_post && current_user_can('edit_post', $post->ID)) || ($admin && $post->post_type == 'page');
	$show_db_logo = ($post && $post->post_type == 'page' && in_array($post->post_title, $version_pages)) || $single_post;
}
else {
	$version_pages = false;
	$single_post = false;
	$show_edit_post = false;
	$show_db_logo = false;
}


$translated_version = function_exists('mlp_get_available_languages');
if($translated_version){
	$current_flag = mlp_get_language_flag(get_current_blog_id());
}
else {
	$current_flag = get_stylesheet_directory_uri() . '/images/svg_flags/germany_svg_round.png';
}

?>

<div class="modal fade language_modal_main top_menu_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

       <div class="modal-body">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
          <span aria-hidden="true">&times;</span> </button>

          <?php 
        	if($translated_version){
           		$langs = mlp_get_available_languages_titles();
          		$links = mlp_get_interlinked_permalinks();
          		if(!empty($links)){
          			$divs = [];
	          		foreach ($links as $key => $details){
	          		    $link = $details['permalink'];
	          		    $divs[$key] = '<div class="modal_lang_cont"><a href="' . $link. '"><img src="' . $details['flag'] .'" /><span>' . $langs[$key] . '</span></a></div>';
	          		}
	          		$divs[get_current_blog_id()] = '<div class="modal_lang_cont active"><img src="' . $current_flag .'" /><span>' . $langs[get_current_blog_id()] . '</span></div>';
	          		
	          		ksort($divs);
	          		
	          		foreach ($divs as $div){
	          			echo $div;
	          		}
        		}
			}
			else {
				echo 'Keine Übersetzungen';
			}
          ?>
      </div>

    </div>
  </div>
</div>


<div class="modal fade share_modal_main top_menu_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

     <div class="modal-header">
        <h5 class="modal-title"> <?php echo ucfirst($Ue['SHARE']);?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


       <div class="modal-body">

       <div class = "share_url_container">
          
          <textarea  type="text" id="share_url_text"></textarea>

       </div>

           <div class="social_icon_container">



                  <a class="fb_link" href="https://www.facebook.com/verbaalpina/">
                    <div>
                        <i class="fab fa-facebook-square" aria-hidden="true"></i><span>Facebook</span>
                    </div>
                  </a>

                  <a class="twitter_link" href="https://twitter.com/VerbaAlpina">
                    <div>
                        <i class="fab fa-twitter-square" aria-hidden="true"></i><span>Twitter</span>             
                    </div>
                  </a>


                  <a class="google_link" href="">
                    <div>
                        <i class="fab fa-google-plus-square" aria-hidden="true"></i><span>Google Plus</span>             
                    </div>
                  </a>

                      <a class="mail_link" href="">
                    <div>
                         <i class="fa fa-envelope" aria-hidden="true"></i><span>Mail</span>             
                    </div>
                  </a>

                   
                <a class="youtube_link" href="https://www.youtube.com/watch?v=hxbtXzxa5LY"> 
                    <div>
                        <i class="fab fa-youtube-square" aria-hidden="true"></i><span>YouTube</span>         
                    </div>
                  </a>

            </div> 

      </div>

    </div>
  </div>
</div>

<?php if (is_user_logged_in()) {?>

<div class="modal fade backend_modal_main top_menu_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

     <div class="modal-header">
        <h5 class="modal-title"> <i class="far fa-user" aria-hidden="true"></i> <span><?php echo wp_get_current_user()->user_login; ?></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       <div class="modal-body">


           <div class="backend_modal_btn_container">

            <div class="internal_pages">

               <?php 
               global $admin;
               global $va_mitarbeiter;
               
               $list = array();
			
               if(get_current_blog_id() === 1){
					if (current_user_can('va_see_progress_page')){
						$list[] = 'Fortschritt';
					}
					
					if (current_user_can('va_transcripts_read')){
						$list[] = 'Protokolle';
					}
					
					if ($admin || $va_mitarbeiter){
						$list[] = 'Datenbank-Dokumentation';
						$list[] = 'CSGRAPH';
						$list[] = 'DizMT Eingabe';
						$list[] = 'Statistik';
					}
					
					if(isDevTester()){
    					$user_key = get_user_meta(get_current_user_id(), 'va_kuerzel', true);
    					if ($user_key == 'FZ'){
    					    $list[] = 'Todos';
    					}
					}
               }
				
				if(!empty($list)){
					echo '<h2 style="font-weight: bold;font-size: 14px; margin-bottom:5px;margin-top: 5px;">Interne Seiten: </h2><ul>';
				
					foreach ($list as $entry){
						$page = get_page_by_title($entry);
						if($page)
							echo '<li><a href="' . get_page_link($page) . '">' . $entry . '</a></li>';
					}
					
					echo '</ul>';
					
				}
				
				?>

             </div>
              
              <div style="margin-top: 10px">             
                  <a href="<?php echo get_admin_url(1); ?>"><button type="button" class="back_m_btn" style="color:green;border:1px solid green;"><i class="fa fa-window-restore" aria-hidden="true"></i> Backend</button></a>
                  <a href="<?php echo wp_logout_url(); ?>"><button style="float:right; color:red; border:1px solid red;" type="button" class="back_m_btn"><i class="fa fa-times" aria-hidden="true"></i> <?php _e('Log out'); ?></button></a>
               </div>
          </div> 
          
      </div>

    </div>
  </div>
</div>

<?php }?>


<?php if($show_db_logo){ ?>

<div class="modal fade db_select_main top_menu_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

       <div class="modal-body">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
          <span aria-hidden="true">&times;</span> 
        </button>

          <div class="db_select_cont">

          <div class="db_select_head"> <?php echo ucfirst($Ue['DATENBANK_VERSION']);?>:</div>

            <select id="va_version_select">
              <?php va_get_version_options($post? $post->post_date: null); ?>
            </select>

          </div>

      </div>

    </div>
  </div>
</div>

<?php 
}
?>

	<header id="masthead" class="site-header" role="banner">

<!-- 			<div>
				<h1 style="display: none; vertical-align:middle;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</div> -->

		<nav id="site-navigation" class="main-nav main-navigation" role="navigation">
		

      <div class="logo_area_bar">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="top_logo_left" src="<?php echo get_stylesheet_directory_uri();?>/images/va_logo_klein.svg" /></a>
              <a href="https://www.uni-muenchen.de/index.html" target="_blank"><img class="top_logo_right" src="<?php echo get_stylesheet_directory_uri();?>/images/LMU-Logo.svg" /></a>
      </div>

      <button id="togglebtn" class="menu-toggle">
<!--       <?php _e( 'Menu', 'twentytwelve' ); ?> -->
        
      </button>       

<!-- 			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a> -->

			<?php va_nav_menu(); ?>

    <div class="logo_area_right">
      <a href="http://gepris.dfg.de/gepris/projekt/253900505" target="_blank"><img class="top_logo_dfg" src="<?php echo get_stylesheet_directory_uri();?>/images/dfg_logo_blau_4c.svg" /></a>
    </div>  

		</nav><!-- #site-navigation -->

    <div class="toolbar" style="width: <?php 
    	if($show_db_logo || $show_edit_post){
    		echo '198px';
    	}
    	else {
    		echo '172px';
    	}
    ?>">   
        <div class="toolbar_section toolbar_left"></div>  

        <div class="toolbar_section toolbar_center">
          	
         	 <div class="tb_i_container tb_lang_menu">
          		<img class="flag_img" src="<?php echo $current_flag;?>"/>
          	</div>
          	
            <div class="tb_i_container tb_login_menu ">
            	<?php 
            	if(!is_user_logged_in()){
            		echo '<a href="' . wp_login_url() .'">';
            	}
            	?> 
            	<i class="tb_icon fa fa-user-circle" aria-hidden="true"></i>
            	<?php 
            	if(!is_user_logged_in()){
            		echo '</a>';
            	}
            	?>

            <?php 
                if(is_user_logged_in()){
                  echo '
                  <span class="login_check"> 
                         <span class="fa-stack">

                         <i class="fa fa-circle fa-stack-1x" aria-hidden="true" style="color:#fbfbfb; font-size: 9px;"></i>
                         <i class="fa fa-check-circle fa-stack-1x" style="color:green" aria-hidden="true"></i>
                     </span>
                  </span>  

                  ';
                }
              ?> 
            

            </div>
            <?php 
            if ($show_db_logo && !$show_edit_post){
            ?>
            <div class="tb_i_container tb_db_menu">
            	<i class="tb_icon fa fa-database" aria-hidden="true"></i>
            </div>
            <?php 
            }
            ?>
            <div class="tb_i_container tb_share_menu" title="<?php echo ucfirst($Ue['SHARE_TEXT']);?>">
            	<i class="tb_icon fa fa-share-alt" aria-hidden="true"></i>
            </div>

            <?php 
            if ($show_edit_post){
            ?>
              <div class="tb_i_container tb_db_menu pencil">
                <a href="<?php echo get_edit_post_link($post->ID) ?>"> <i class="tb_icon fas fa-pencil-alt" aria-hidden="true" ></i> </a>
              </div>
            <?php 
            } ?>

        </div>   

        <div class="toolbar_section toolbar_right"></div>
    </div>

     <div class="version-tag <?php if ($show_db_logo){ ?> version_tag_hover <?php }?>"> 
        <div class="toolbar_section toolbar_left" style="margin-right: -5px;"></div>  
        <div class="toolbar_section toolbar_center ver_tb" style="position: relative; box-shadow: initial !important; -webkit-box-shadow:initial !important; padding-right: 20px; padding-top: 8px;">
        <span class="version_span">Version</span>
      <?php
      global $va_current_db_name;
      $version_str = strtoupper (substr($va_current_db_name,3));

        if($version_str=="XXX")echo $version_str;
        else {
          $version_str =  substr_replace($version_str,"/",-1,0);
          echo $version_str;
        }

      ?> 

      <?php if ($show_db_logo){ ?> <i class="fa fa-caret-down" aria-hidden="true"></i> <?php } ?>

        </div>   
    </div>



		<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
		</a>
		<?php endif; ?>
	</header><!-- #masthead -->

<script type="text/javascript">

		jQuery(document).ready(function (){ 

			adjustSizesRelativeToWindow();

			jQuery(window).resize(function (){
				 adjustSizesRelativeToWindow();
			});

		});

	function adjustSizesRelativeToWindow (){
		var widthW = window.innerWidth;
		var heightW = window.innerHeight;
		
				var trans_val= -58 + (widthW-1200)*0.05;
				if( trans_val<-78) trans_val = -78;
				if(trans_val>-52) trans_val = -52;

				var top = heightW/2 - jQuery('.lmu_signum_bg > img').height()/2;

				jQuery('.lmu_signum_bg > img').css('transform','translateX('+trans_val+'%)');
				jQuery('.lmu_signum_bg > img').css('top',top+"px");

				if(widthW < 1050) {
					jQuery('.bg_image').hide();
					jQuery('.lmu_signum_bg').hide();
				}
				else{
					jQuery('.bg_image').show();
					jQuery('.lmu_signum_bg').show();
				}

	}
</script>	

<div id="page" class="hfeed site">
	<div id="main" class="wrapper">