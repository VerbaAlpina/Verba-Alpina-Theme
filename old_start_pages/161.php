<?php
/**
 * Template Name: Start page
 */

include_once '161_header.php';

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
			<a href="<?php echo get_site_url(1) . '?page_id=162&db=161'; ?>">Deutsch</a>
		</span>
		
		<span style="white-space: nowrap;">
			<img src="<?php echo $url?>/wp-content/plugins/multilingual-press/assets/images/flags/fr.gif" />
			<a href="<?php echo get_site_url(1) . '/fr/?page_id=4&db=161'; ?>">Français</a>
		</span>

		<span style="white-space: nowrap;">
			<img src="<?php echo $url?>/wp-content/plugins/multilingual-press/assets/images/flags/it.gif" />
			<a href="<?php echo get_site_url(1) . '/it/?page_id=10&db=161'; ?>">Italiano</a>
		</span>
		
		<span style="white-space: nowrap;">
			<img src="<?php echo $url?>/wp-content/plugins/verba-alpina/images/rg.jpg" />
			<a href="<?php echo get_site_url(1) . '/rg/?page_id=162&db=161'; ?>">Rumantsch&nbsp;Grischun</a>
		</span>
		
		<span style="white-space: nowrap;">
			<img src="<?php echo $url?>/wp-content/plugins/multilingual-press/assets/images/flags/si.gif" />
			<a href="<?php echo get_site_url(1) . '/si/?page_id=5&db=161'; ?>">Slovenščina</a>
		</span>
	</h1>
</div>

<?php
 get_footer('start');
 ?>