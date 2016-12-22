<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'parent-style' ) );
}

add_action( 'twentytwelve_credits' , 'mh_footer_info' , 25 );
function mh_footer_info() {
	if($GLOBALS['pagenow'] != 'wp-signup.php'){
		global $lang;
		global $Ue;
		
		$impressum = get_page_by_title('IMPRESSUM');
		$datenschutz = get_page_by_title('DATENSCHUTZ');
		$kontakt = get_page_by_title('KONTAKT');
		
		$output = '<div id="fusszeile" style="float: right">';
		
		$link_list = array();
		
		if($impressum)
			$link_list[] = '<a href="' . get_permalink($impressum).'">' . $Ue['IMPRESSUM'] . '</a>';
		
		if($datenschutz)
			$link_list[] = '<a href="' . get_permalink($datenschutz).'">' . $Ue['DATENSCHUTZ'] . '</a>';
		
		if($kontakt)
			$link_list[] .= '<a href="' . get_permalink($kontakt).'">' . $Ue['KONTAKT'] . '</a>';
		
		$output .= implode(' - ', $link_list);
		
		$output .= '</div><br />';
			
		echo $output;
   	}
}

//Default Home-Link entfernen (zeigt auf Sprachauswahl-Seite)
function filter_menu_items( $args ) {
    $args['show_home'] = false;
    return $args;
}
add_filter( 'wp_nav_menu_args', 'filter_menu_items' );
?>