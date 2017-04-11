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

function va_combine_footnotes (&$fields, &$combined_footnotes, $prefix){

	$combined_footnotes = '<ol class="footnotes">';
	$number_footnote = 1;

	foreach ($fields as &$field){
		$footnotes = strstr_after($field, '<hr class="footnotes">', false);
		if($footnotes !== false){
			//Fußnoten-Bereich anpassen
			preg_match_all('/<li id="fn([0-9]*)-([^"]*)">(.*)<\/li>/sU', $field, $matches, PREG_SET_ORDER);
				
			foreach ($matches as $index => $match){
				$inner_content = preg_replace('/Jump back to footnote [0-9]* in the text/', 'Jump back to footnote ' . ($number_footnote + $index) . ' in the text' , $match[3]);
				$inner_content = preg_replace('/href="#rf[0-9]*-([^"]*)"/', 'href=#' . $prefix . '_rf' . ($number_footnote + $index) . '-$1', $inner_content);
				$combined_footnotes .= '<li id="' . $prefix . '_fn' . ($number_footnote + $index) . '-' . $match[2] . '">' . $inner_content . '</li>';
			}
				
			//Text-Bereich anpassen
			$field = strstr($field, '<hr class="footnotes">', true);
				
			$index = 0;
			$field = preg_replace_callback('/<sup id="rf[0-9]*-([^"]*)">(.*)href="#fn[0-9]*-([^"]*)"([^>]*)>[0-9]*<\/a>/sU', function ($matches) use (&$index, $number_footnote, $prefix){
				return '<sup id="' . $prefix . '_rf' . ($number_footnote + $index) . '-' . $matches[1] . '">' . $matches[2] . 'href="#' . $prefix . '_fn' . ($number_footnote + $index) . '-' . $matches[3] .'"' . $matches[4] . '>' . ($number_footnote + $index++) . '</a>';
			}, $field);
					
				$number_footnote += count($matches);
		}
	}

	$combined_footnotes .= '</ol>';
}

?>