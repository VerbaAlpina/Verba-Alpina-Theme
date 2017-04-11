<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes();  $url = get_site_url(1);?>>
<!--<![endif]-->
<head>
<?php if(function_exists('add_favicon')) echo  add_favicon();?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'left' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet"  href="<?php echo $url?>/wp-content/plugins/plugin_va-crowd/assets/css/bootstrap.min.css"/>
<link rel="stylesheet"  href="<?php echo $url?>/wp-content/plugins/plugin_va-crowd/style.css"/>
<link rel="stylesheet"  href="<?php echo $url?>/wp-content/plugins/plugin_va-crowd/assets/css/font-awesome.min.css"/>

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	remove_action('wp_head', 'wp_print_styles', 8);
?>
<?php wp_head(); ?>

<!---
WINTER: /wp-content/uploads/DSC_02793.jpg	
->

<!-- BACKGROUND IMAGE -->
<style type="text/css">
html { 
  background: url(<?php echo get_site_url(1);?>/wp-content/uploads/20161023_134744_edited.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

a:link {color: white}
a:visited {color: white}

span {
    margin: 0 3%;
}

span:first-of-type{
    margin-left: 0;
}

span:last-of-type{
    margin-left: 0;
}

#flyer_modal .modal-body{
padding: 0!important;
}


#flyer_modal .modal-body:hover{
cursor:pointer;
}

#flyer_modal .slogan_div{
	position: absolute;
    width: 100%;
    color: black;
    z-index: 10;
    text-align: center;
    font-size: 11px;
    top: 201px;
    font-family: 'Lora', serif;
	font-style: italic;
	font-weight: 400;
	margin-left: -1px;
	display: none;
}


#flyer_modal .slogan_wrapper{
width: 100%;
}

#flyer_modal .flyer_custom_close{
    margin-top: -22px;
    margin-right: -19px;
    cursor: pointer;
    color: #fff;
    position: absolute;
    right: 0;
    z-index: 10000;

  }

 .flyer_custom_close .fa-stack{
 	    font-size: 34px;
 	   width: 40px;
    height: 40px;
 }

  .flyer_custom_close .fa{
    width: 40px;
    height: 40px;
     margin-top: -10px;
  }


/*.flyer_custom_close:before {
    content: "×";
}*/

#flyer_modal .flyer_custom_close:hover{
  color: #ccc;
}


.join_button {
    width: 100%;
    text-align: center;
    color: #3f84c5;
    text-transform: uppercase;
    border-bottom: 2px solid black;
    padding-bottom: 26px;
}

.join_span{
 	
	padding-left: 10px;
    padding-right: 10px;
    padding-top: 5px;
    padding-bottom: 5px;
    font-size: 26px;
}

.join_button_border {
	border: 2px solid #3f84c5;
	width: 42%;
    margin: 0 auto;
     border-radius: 4px;
}

.join_button_border:hover{
 background-color: #3f84c5;
 color:white;
}


@media screen and (max-width: 628px) {

	#flyer_modal .modal-dialog{
		   position: relative;
   		   width: auto;
   		   margin: 10px;
		   margin-top: 13px
	}

	#flyer_modal .slogan_div{
		font-size: 10px;
		margin-top: 1px;
	}
}

@media screen and (max-width: 570px) {
	
	#flyer_modal .slogan_div{
		font-size: 9px;
		margin-top: 2px;
	}
}

@media screen and (max-width: 520px) {
	
	#flyer_modal .slogan_div{
		font-size: 8px;
		margin-top: 3px;
	}

	.join_button{padding-bottom: 19px}
}

@media screen and (max-width: 478px) {
	
	#flyer_modal .slogan_div{
	    font-size: 7px;
	    margin-top: 4px;
	}

	.join_button_border {
	width: 56%;
	}
}

@media screen and (max-width: 415px) {
	
	#flyer_modal .slogan_div{
	    font-size: 6px;
	    margin-top: 4px;
	}
}

@media screen and (max-width: 370px) {
	
	#flyer_modal .slogan_div{
	    font-size: 5px;
	    margin-top: 5px;
	    margin-left: 0px;
	}

	.join_span{
		font-size: 19px;
	}

	.join_button{
		padding-bottom: 17px;
	}

	.join_button_border {
    width: 47%;
	}

}

.social_icon_container{

    position: absolute;
    width: 100%;
    display: block;
    height: 40px;
    color: #3f84c5;
    z-index: 5;
    font-size: 30px;
    padding-left: 9px

}

.social_icon:hover{
   opacity: 0.85;
}


</style>

<script type="text/javascript">

	var image_w = 3264;
	var image_h = 1836;
	
	var right_dist = 0.05;
	var top_dist = 0.05;
	
	var logo_w = 80;
	var logo_h = 40;
	
	var percX = 0.25;
	var percY = image_w * percX / logo_w * logo_h / image_h;
	
	
	var resImage = parseFloat(image_w) / image_h;


	var urlEN = "<?php echo get_site_url(8);?>";
	var page_id = "<?php 
		switch_to_blog(8);
		echo get_page_by_title("Crowdsourcing")->ID;
		restore_current_blog();
	?>";
	
	var start_slogan_texts = ["Parlons la langue des Alpes!","Parliamo la lingua delle Alpi!","Govori jezik Alp!","Sprich die Sprache der Alpen!"];
	var join_texts =["Participer!","Partecipare!","Sodeluj!","Mitmachen!"]

	jQuery(document).ready(function (){

		
    adjustSizesRelativeToWindow();



    jQuery('#flyer_modal').on('show.bs.modal', function (e) {
      showCustomModalBackdrop();

      jQuery('#flyer_modal .modal-content').on('click',function(){
      	 window.location = urlEN +"?page_id="+page_id;
      })


      jQuery('#flyer_modal .flyer_custom_close').on('click',function(e){
      	 jQuery('#flyer_modal .modal-content').off();
      	 jQuery('#flyer_modal').modal('hide');
      })

      // jQuery('#flyer_modal .social_icon').on('click',function(e){
      // 	 jQuery('#flyer_modal .modal-content').off();
      // 	 jQuery('#flyer_modal').modal('hide');
      // })

 	jQuery('#flyer_modal #twitter_icon').on('click',function(e){
      	 jQuery('#flyer_modal .modal-content').off();
      	  window.location = "https://twitter.com/VerbaAlpina";

      })

 		jQuery('#flyer_modal #facebook_icon').on('click',function(e){
      	 jQuery('#flyer_modal .modal-content').off();
      	 window.location = "https://www.facebook.com/verbaalpina/";
      })	


    })


   jQuery('#flyer_modal').on('shown.bs.modal', function (e) {
   	adjustSlogan();
   	jQuery('.slogan_div').fadeIn();


   			jQuery('#flyer_modal #first_slider').on('slide.bs.carousel', function (e) {
  				var slogan = start_slogan_texts[jQuery(".active", e.target).index()];
  				var join = join_texts[jQuery(".active", e.target).index()];

  				jQuery(".slogan_div").fadeOut(function() {
 				 jQuery(this).text(slogan)
				}).fadeIn();

				jQuery(".join_span").fadeOut(function() {
 				 jQuery(this).text(join)
				}).fadeIn();

			})

   })


 

     jQuery('#flyer_modal').on('hidden.bs.modal', function (e) {
       jQuery('#custom_modal_backdrop').fadeOut(function(){jQuery(this).remove()})  
    })





	jQuery('#flyer_modal').modal('show');



	});
	
	jQuery(window).resize(function (){
		adjustSizesRelativeToWindow();
		adjustSlogan();

	});

	function adjustSizesRelativeToImage (){
		var widthW = jQuery(window).width();
		var heightW = jQuery(window).height();
		var resBG = parseFloat(widthW) /  heightW;
		
		var prop = parseFloat(resImage) / resBG;
		
		if(prop <= 1){ //Adjust to browser width
			jQuery("#logoSVG").css({"width": (percX * widthW), "height" : (percX * widthW * logo_h / logo_w), "right": (right_dist * widthW), "top": (((top_dist - ((1 - prop) / 2)) / prop) * heightW)});
		}
		else { //Adjust to browser height
			prop = 1 / prop;
			jQuery("#logoSVG").css({"width": (percY * heightW * logo_w / logo_h) , "height": (percY * heightW), "top": (top_dist * heightW), "right": (((right_dist - ((1 - prop) / 2)) / prop) * widthW)});
		}
	}
	
	function adjustSizesRelativeToWindow (){
		var widthW = jQuery(window).width();
		var heightW = jQuery(window).height();
		var resBG = parseFloat(widthW) /  heightW;
		
		var prop = parseFloat(resImage) / resBG;
		
		if(prop <= 1){ //Adjust to browser width
			jQuery("#logoSVG").css({"width": (percX * widthW), "height" : (percX * widthW * logo_h / logo_w), "right": (right_dist * widthW), "top": (top_dist * heightW)});
		}
		else { //Adjust to browser height
			prop = 1 / prop;
			jQuery("#logoSVG").css({"width": (percY * heightW * logo_w / logo_h) , "height": (percY * heightW), "top": (top_dist * heightW), "right": (right_dist * widthW)});
		}
	}


	function showCustomModalBackdrop(){

		var custom_backdrop = jQuery('<div id="custom_modal_backdrop"></div>');
		jQuery('body').append(custom_backdrop);
		jQuery('#custom_modal_backdrop').fadeIn('fast');
    }


    function adjustSlogan(){
     var top = 	Math.ceil(jQuery('.slogan_wrapper').height()*0.55)+3;
	 jQuery('.slogan_div').css('top',top);
    }


</script>

</head>

<body>
