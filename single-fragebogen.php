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
		global $wpdb;
		$wpdb->query($wpdb->prepare('
			INSERT INTO va_wp.questionnaire_results (post_id, page, user_id, question, question_text, answer) 
			VALUES (%d, NULL, (SELECT * FROM (SELECT IFNULL(max(user_id) + 1, 0) FROM va_wp.questionnaire_results) x), NULL, NULL, NULL)', get_the_ID()));
		echo $wpdb->get_var($wpdb->prepare('SELECT user_id FROM questionnaire_results WHERE id_result = %d', $wpdb->insert_id));
	?>;

	function init (){
		jQuery(".fb_map").each(function (){
			var that = this;
			
			var map = new google.maps.Map(this, {
				center : new google.maps.LatLng(jQuery(this).data("lat"), jQuery(this).data("lng")),
			    zoom : jQuery(this).data("zoom")
			});

			map.addListener("click", function (options){
				var marker = jQuery(that).data("marker");
				if (marker){
					marker.setMap(null);
				}

				marker = new google.maps.Marker({
			   		position: options["latLng"],
			  		map: this
			    });
			    
				jQuery(that).data("marker", marker);
			});
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
					"answers" : answers
				},
				function (response){
					jQuery("#qdiv").html(response);
					currentPage++;
					init();
				});
			}
		});
	}

	function getAnswers (){
		var result = [];
		
		jQuery(".fb_question").each(function (){
			var value;
			
			if (jQuery(this).hasClass("fb_map")){
				var marker = jQuery(this).data("marker");
				if(marker) {
					value = "POINT(" + marker.getPosition().lng() + " " + marker.getPosition().lat() + ")";
				}
				else {
					value = null;
				}
			}
			else if (jQuery(this).hasClass("fb_pseudo")){ //Used for radio buttons
				value = jQuery("input[type=radio][name=" + jQuery(this).val() + "]:checked").data("text");
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
    