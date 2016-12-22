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
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<?php if(function_exists('add_favicon')) echo  add_favicon();?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'left' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
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

	jQuery(document).ready(function (){
		adjustSizesRelativeToWindow();
	});
	
	jQuery(window).resize(function (){
		adjustSizesRelativeToWindow();
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
</script>

</head>

<body>
