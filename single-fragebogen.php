<!DOCTYPE html>
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
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php 
wp_head();
?>

<script>
	function initMap (){
		jQuery(".fb_map").each(function (){
			var map = new google.maps.Map(this, {
				center : new google.maps.LatLng(jQuery(this).data("lat"), jQuery(this).data("lng")),
			    zoom : jQuery(this).data("zoom")
			});

			map.addListener("click", function (options){
				var marker = jQuery(this).data("marker");
				if (marker){
					marker.setMap(null);
				}

				marker = new google.maps.Marker({
			   		position: options["latLng"],
			  		map: this
			    });

				jQuery(this).data("marker", marker);
			});

			jQuery(".va_fb_select").select2();
		});

	}
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?callback=initMap">
</script>


</head>
<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<div id="main" class="wrapper">
			<div id="primary" class="site-content" style="margin-bottom: 50px;">
				<div id="content" role="main">
	    		<?php 
	    			echo '<header class="entry-header"><h1 class="entry-title"><span>' . get_the_title() . '</span></h1></header>';
	    			echo '<div class="entry-content">' . do_shortcode(get_post()->post_content);
	    			
	    			?>
	    			<br />
	    			<br />
	    			<?php
	    			
	    			$num_map = 0;
	    			$num_radio = 0;
	    			
	    			while (have_rows('fb_frage')){
	    				the_row();
	    				echo the_sub_field('fb_uberschrift');
	    				
	    				switch (get_sub_field('fb_typ')){
	    					
	    					case 'Text':
	    						echo '<input type="text" autocomplete="off" />';
	    						break;
	    						
	    					case 'Auswahl':
	    						while (have_rows('fb_details')){
	    							the_row();
	    							$options = explode(PHP_EOL, get_sub_field('fb_cb_optionen'));
	    							if(count($options) <= 15){
		    							foreach ($options as $option){
		    								echo '<input type="radio" style="margin-right: 5px;" autocomplete="off" name="fb_radio' . $num_radio . '" />' . $option . '<br />';
		    							}
	    								$num_radio++;
	    							}
	    							else {
	    								echo '<select class="va_fb_select" autocomplete="off"><option value="###EMPTY###" />';
	    								foreach ($options as $option){
	    									echo '<option>' . htmlentities($option) . '</option>';
	    								}
	    								echo '</select>';
	    							}
	    						}
	    						break;
	    						
	    					case 'Karte':
	    						$details = get_sub_field('fb_details');
	    						echo ' <div class="fb_map" id="fb_map' . $num_map++ . '" style="height: 500px;" data-zoom="' . $details['fb_map_zoom'] . '" data-lat="' . $details['fb_map_center']['fb_map_lat'] . '" data-lng="' . $details['fb_map_center']['fb_map_lng'] . '"></div>';
	    						break;
	    				}
	    				
	    				echo '<br /><br />';
	    			}
	    		echo '</div>';
	    		?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>
	</div>
</body>
    