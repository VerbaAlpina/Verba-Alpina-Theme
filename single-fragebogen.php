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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0ukPhw9Un5_3blrN02dKzUgilYzg_Kek"></script>

<script type="text/javascript">
	var currentPage = 0;
	var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
	var errorText = <?php echo json_encode(get_field('fb_error_text')) ?>;
	var userID = <?php 
	
		if (get_field('fb_block') == 0){
			global $wpdb;
			$wpdb->query($wpdb->prepare('
				INSERT INTO va_wp.questionnaire_results (post_id, page, user_id, question, question_text, answer) 
				VALUES (%d, NULL, (SELECT * FROM (SELECT IFNULL(max(user_id) + 1, 0) FROM va_wp.questionnaire_results) x), NULL, NULL, NULL)', get_the_ID()));
			echo $wpdb->get_var($wpdb->prepare('SELECT user_id FROM questionnaire_results WHERE id_result = %d', $wpdb->insert_id));
		}
		else {
			echo 0;
		}
	?>;
	
	var emptyMapStyle = [
	  {
		"elementType": "labels",
		"stylers": [
		  {
			"visibility": "off"
		  }
		]
	  },
	  {
		"featureType": "administrative",
		"elementType": "geometry",
		"stylers": [
		  {
			"visibility": "off"
		  }
		]
	  },
	  {
		"featureType": "administrative.land_parcel",
		"stylers": [
		  {
			"visibility": "off"
		  }
		]
	  },
	  {
		"featureType": "administrative.neighborhood",
		"stylers": [
		  {
			"visibility": "off"
		  }
		]
	  },
	  {
		"featureType": "poi",
		"stylers": [
		  {
			"visibility": "off"
		  }
		]
	  },
	  {
		"featureType": "road",
		"stylers": [
		  {
			"visibility": "off"
		  }
		]
	  },
	  {
		"featureType": "road",
		"elementType": "labels.icon",
		"stylers": [
		  {
			"visibility": "off"
		  }
		]
	  },
	  {
		"featureType": "transit",
		"stylers": [
		  {
			"visibility": "off"
		  }
		]
	  }
	];

	function init (){
		jQuery(".fb_map").each(function (){
			var that = this;
			
			var mapOptions = {
				center : new google.maps.LatLng(jQuery(this).data("lat"), jQuery(this).data("lng")),
			    zoom : jQuery(this).data("zoom"),
			};
			
			if (jQuery(this).data("map-type") === "E"){
				mapOptions.styles = emptyMapStyle;
				mapOptions.mapTypeId = "terrain"
			}
			
			var map = new google.maps.Map(this, mapOptions);
			
			jQuery(that).data("markers", []);
			
			switch (jQuery(this).data("type")){
				case "S":
					map.addListener("click", function (options){
						var markers = jQuery(that).data("markers");
						if (markers.length > 0){
							markers[0].setMap(null);
						}

						marker = new google.maps.Marker({
							position: options["latLng"],
							map: this
						});
						
						marker.addListener("click", function (){removeMarker(this, that)});
						
						jQuery(that).data("markers", [marker]);
					});
				break;
				
				case "M":
					map.addListener("click", function (options){
						marker = new google.maps.Marker({
							position: options["latLng"],
							map: this
						});

						marker.addListener("click", function (){removeMarker(this, that)});
						
						let markers = jQuery(that).data("markers");	
						jQuery(that).data("markers", markers.concat([marker]));
					});
					
				break;
			}

			
		});
		
		jQuery(".user_input_text").focus(function (){
			jQuery(this).prevAll(".user_input_radio").prop("checked", true);
		});

		jQuery(".va_fb_select").select2();

		jQuery("#fb_submit_button").click(function (){
			var answers = getAnswers();
			if(answers === false){
				alert(errorText);
			}
			else {
				jQuery.post(ajaxurl, {
					"action" : "va",
					"namespace" : "questionnaire",
					"query" : "nextPage",
					"page" : currentPage,
					"post" : <?php echo get_the_ID(); ?>,
					"answers" : answers,
					"save": <?php echo get_field('fb_block') == 0? 'true': 'false'; ?>
				},
				function (response){
					jQuery("#qdiv").html(response);
					currentPage++;
					init();
					scroll(0,0);
				});
			}
		});
	}
	
	function removeMarker (marker, map){
		marker.setMap(null);
							
		let markers = jQuery(map).data("markers");
		for (let i = 0; i < markers.length; i++){
			if (markers[i] == marker){
				markers.splice(i, 1);
				break;
			}
		}
		jQuery(map).data("markers", markers);
	}

	function getAnswers (){
		var result = [];
		
		jQuery(".fb_question").each(function (){
			var value;
			
			if (jQuery(this).hasClass("fb_map")){
				var markers = jQuery(this).data("markers");
				if(markers.length > 0) {
					value = markers.map(marker => "POINT(" + marker.getPosition().lng() + " " + marker.getPosition().lat() + ")");
				}
				else {
					value = null;
				}
			}
			else if (jQuery(this).hasClass("fb_pseudo")){ //Used for radio buttons and checkboxes
				var value = [];
				let optionName = jQuery(this).val();
				
				jQuery("input[name=" + optionName + "]:checked").each(function (){
					if (jQuery(this).hasClass("user_input_radio")){
						value.push(jQuery("input#" + optionName + "_user_text").val());
					}
					else {
						value.push(jQuery(this).data("text"));
					}
				});
				
				if (value.length == 0){
					value = null;
				}
				else if (value.length == 1){
					value = value[0];
				}
			}
			else if (jQuery(this).is("table")){ // Sub questions
				value = {};
				var questionObject = this;
				jQuery(this).find(".fb_sub_question").each(function (){
					var cval = jQuery(this).val();
					if(!cval && jQuery(questionObject).hasClass("fb_necessary")){
						value = false;
						return false;
					}
					value[jQuery(this).data("text")] = cval;
				});
			}
			else {
				value = jQuery(this).val();
			}

			if (value == "" || value == "###EMPTY###"){
				value = null;
			}

			if(!value && jQuery(this).hasClass("fb_necessary")){
				result = false;
				return false;
			}

			result.push({
				"post_id" : <?php echo get_the_ID(); ?>,
				"page" : currentPage,
				"user_id" : userID,
				"question" : result.length,
				"answer" : value
			});
		});
		console.log(result);

		return result;
	}

	jQuery(init);
</script>


</head>
<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<div id="main" class="wrapper">
			<div id="primary" class="site-content" style="margin-bottom: 50px;">
				<div id="content" role="main">
	    		<?php 
	    		echo '<header class="entry-header"><h1 class="entry-title"><span>' . get_the_title() . '</span></h1></header>';
	    		?>
		    		<div id="qdiv">
		    			<?php va_questionnaire_sub_page(0); ?>
		    		</div>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>
	</div>
</body>
    