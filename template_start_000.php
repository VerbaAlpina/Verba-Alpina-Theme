<?php
/**
 * Template Name: Start page 000
 */

 get_header('start_000');
 
 $url = get_site_url(1);
?>

<div id="logoSVG" style="position: absolute;"> <!--width: 24%; position: fixed; bottom: 35%; left: 33%-->
	<object type="image/svg+xml" width="100%" height="100%" data="<?php echo $url?>/wp-content/uploads/VA_logo.svg">
	</object>
</div>

<!--<div style="position: fixed; bottom: 8%; width:100%; text-align: center"> WINTER-->
<div style="position: fixed; top: 8%; left: 20%; width: 60%; text-align: center">
	<h1 style="font-size: 3vh">
		<span>
			<img src="<?php echo $url?>/wp-content/plugins/multilingual-press/flags/de.gif" />
			<a href="<?php echo get_site_url(1) . '?page_id=162'; ?>">Deutsch</a>
		</span>
		
		<span>
			<img src="<?php echo $url?>/wp-content/plugins/multilingual-press/flags/fr.gif" />
			<a href="<?php echo get_site_url(1) . '/fr/?page_id=4'; ?>">Français</a>
		</span>

		<span>
			<img src="<?php echo $url?>/wp-content/plugins/multilingual-press/flags/it.gif" />
			<a href="<?php echo get_site_url(1) . '/it/?page_id=10'; ?>">Italiano</a>
		</span>
		
		<span>
			<img src="<?php echo $url?>/wp-content/plugins/multilingual-press/flags/sl.gif" />
			<a href="<?php echo get_site_url(1) . '/si/?page_id=5'; ?>">Slovenščina</a>
		</span>
	</h1>
</div>

<?php
 get_footer('start');
 ?>