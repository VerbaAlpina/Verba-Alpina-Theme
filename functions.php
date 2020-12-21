<?php

add_filter ('wp_mail_from', function ($from){ return get_option('admin_email'); });

add_action( 'wp_enqueue_scripts', 'va_theme_enqueue_scripts' );

function va_theme_enqueue_scripts() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
   
    $templates = array ('template_empty.php', 'template_empty_wide.php', 'template_personal.php', ''); //Empty string is default template which is used for all singe-... post templates
    
    global $va_page_has_translations;
    
    if((!isset($_REQUEST['format']) || $_REQUEST['format'] != 'iframe') && is_page_template($templates) && get_post_type() != 'fragebogen'){
    	wp_enqueue_script('va-menu-script', get_stylesheet_directory_uri() . '/menu.js', array('jquery'));
    	
    	if(function_exists('mlp_get_interlinked_permalinks'))
    		$links = mlp_get_interlinked_permalinks();
    	else
    		$links = array();
    	wp_localize_script ('va-menu-script', 'VA_THEME', array('has_translations' => empty($links)? "0": "1"));
	}
}

add_action( 'twentytwelve_credits' , 'mh_footer_info' , 25 );
function mh_footer_info() {
	if($GLOBALS['pagenow'] != 'wp-signup.php' && function_exists('va_get_glossary_link_and_title')){
		global $lang;
		global $Ue;
		
		$impressum = get_page_by_title('IMPRESSUM');
		$datenschutz = get_page_by_title('DATENSCHUTZ');
		$kontakt = get_page_by_title('KONTAKT');
		$license = get_option('va_external')? null: va_get_glossary_link_and_title(41);
		
		$output = '<div id="fusszeile" style="float: right">';
		
		$link_list = array();
		
		if($impressum)
			$link_list[] = '<a href="' . get_permalink($impressum).'">' . $Ue['IMPRESSUM'] . '</a>';
		
		if($datenschutz)
			$link_list[] = '<a href="' . get_permalink($datenschutz).'">' . $Ue['DATENSCHUTZ'] . '</a>';
		
		if($kontakt)
			$link_list[] .= '<a href="' . get_permalink($kontakt).'">' . $Ue['KONTAKT'] . '</a>';
		
		if($license)
			$link_list[] .= '<a href="' . $license[0] .'">' . $license[1] . '</a>';
		
		

		$bottom_dfg_logo = '
		<a href="http://gepris.dfg.de/gepris/projekt/253900505" target="_blank"><img class="bottom_logo_dfg" src="'.get_stylesheet_directory_uri().'/images/dfg_logo_blau_4c.svg" /></a>
		';
		


		$output .= implode(' - ', $link_list);

		$output.=$bottom_dfg_logo;
		
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

function va_strstr_after($haystack, $needle, $case_insensitive = false) {
	$strpos = ($case_insensitive) ? 'stripos' : 'strpos';
	$pos = $strpos($haystack, $needle);
	if (is_int($pos)) {
		return substr($haystack, $pos + strlen($needle));
	}
	// Most likely false or null
	return $pos;
}

function va_combine_footnotes (&$fields, &$combined_footnotes, $prefix){

	$combined_footnotes = '<ol class="footnotes">';
	$number_footnote = 1;

	foreach ($fields as &$field){
		$footnotes = va_strstr_after($field, '<hr class="footnotes">');
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

function va_get_version_options ($fromDate = null){
	global $va_current_db_name;
	global $va_xxx;
	global $Ue;
	
	$col_current = "#FFA9A9";
	$col_last = "#8FFA81";
	$col_old = "#e6e6e6";
	
	$xxx_name = 'XXX  (' . $Ue['ARBEITSVERSION'] . ')';
	
	echo '<option value="xxx" style="background: ' . $col_current . '" ' . ('va_xxx' == $va_current_db_name? 'selected ': '') . '>' .$xxx_name . '</option>';

	$versionen = $va_xxx->get_results('SELECT Nummer, Erstellt_Am from Versionen WHERE Website ORDER BY Nummer DESC', ARRAY_A);
	
	$first = true;
	foreach ($versionen as $version){
		$html = va_format_version_number($version['Nummer']);
	
		$options = '';
		if('va_' . $version['Nummer'] == $va_current_db_name){
			$options .= ' selected';
		}

		if($fromDate > $version['Erstellt_Am']){
			$options .= ' disabled';
		}
		
		if($first){
			$html .= ' (' . $Ue['ZITIERVERSION'] . ')';
			echo '<option value="' . $version['Nummer'] .'" style="background: ' . $col_last . '" ' . $options . '>' . $html . '</option>';
			$first = false;
		}
		else {
			echo '<option value="' . $version['Nummer'] .'" style="background: ' . $col_old . '" ' . $options . '>' . $html . '</option>';
		}
	}
}

function va_nav_menu (){
	global $Ue;
	echo '<div class="nav-menu va-menu-list"><ul>';
	
	$pages = get_pages ([
		'sort_column' => 'menu_order'
	]);
	
	$pages = array_filter($pages, function ($val){
		return $val != null; //TODO needed e.g. for rg language. why?
	});

	$children = array();
	$item_list = array();
	
	//Home symbol
	$item_list[] = '<li><a href="' . get_page_link(get_page_by_title('Home')->ID) . '">' . $Ue['Home'] . '</a></li>';
	
	//Normal pages
	$person_index = -1;
	
	foreach ($pages as $index => $page){
		if($page->post_parent != 0){
			if(!isset($children[$page->post_parent])){
				$children[$page->post_parent] = array();
			}
			
			$num = $page->menu_order;
			while(isset($children[$page->post_parent][$num])){
				$num++;
			}
			$children[$page->post_parent][$num] = $page;
		}
	}

	foreach ($pages as $page){
		if($page->post_parent != 0)
			continue;
		
		$has_children = isset($children[$page->ID]);	
			
		if ($page->post_title == 'CS_MITMACHEN'){
			$cslink = add_query_arg('page_id', '1741', get_site_url(8));
			$link = $cslink;
		}
		else {
			$link = get_page_link($page->ID);
		}
		
		$curr_page = '<li class="page_item page_item-' . $page->ID . ($has_children? ' page_item_has_children': '') . '"><a href="' . $link . '">' . get_the_title($page->ID) . '</a>';
		
		if($has_children){
			ksort($children[$page->ID]);
			
			$curr_page .= '<ul class="children">';
			foreach ($children[$page->ID] as $child){
				$curr_page .= '<li class="page_item page_item-' . $child->ID . '"><a href="' . get_page_link($child->ID) . '">' . get_the_title($child->ID) . '</a></li>';
			}
			
			if ($page->post_title == 'CS_MITMACHEN'){
				//Crowdsourcing
				$curr_page .= '<li class="page_item"><a href="' . $cslink . '">' . 'Crowdsourcing' . '</a></li>';
				$curr_page .= '<li class="page_item"><a href="https://www.zooniverse.org/projects/filip-hr/verbaalpina">' . 'Zooniverse' . '</a></li>';
			}
			$curr_page .= '</ul>';
		}
		
		$curr_page .= '</li>';
		
		$item_list[] = $curr_page;
		
		if($page->post_title === 'PERSONEN'){
			$person_index = count($item_list) - 1;
		}
	}

	$person_item = $item_list[$person_index];
	unset($item_list[$person_index]);
	
	$item_list[] = '<span class="pipespan" style="border-left : 3px solid #ededed; margin-right: 20px;   margin-left: -7px;"></span>';
	$item_list[] = $person_item;
	
	foreach ($item_list as $item){
		echo $item;
	}
	
	echo '</ul></div>';
}

function va_questionnaire_sub_page ($num_page, $post_id = NULL){

	echo '<div class="entry-content">';
	
	$pages = get_field('fb_seite', $post_id);
	$num_pages = count($pages);
	
	if($num_page == $num_pages){
		echo get_field('field_finished_text', $post_id);
	}
	else {
	
		if($num_page == 0){
			echo do_shortcode(get_post($post_id)->post_content) . '<br /><br />';
		}
		
		$num_map = 0;
		$num_radio = 0;
		
		foreach ($pages[$num_page]['fb_frage'] as $question){
			
			if($question['fb_details']['fb_necessary']){
				echo '<span style="color: red; /*display: inline-block;*/ margin-right: 5px; vertical-align: top; margin-top: 30px;">*</span>';
			}
			
			echo '<div style="display: inline-block">' . $question['fb_uberschrift'] . '</div><br />';

			switch ($question['fb_typ']){
				
				case 'Text':
					echo '<input type="text" class="fb_question' . ($question['fb_details']['fb_necessary']? ' fb_necessary' : '') . '" autocomplete="off" />';
					break;
					
				case 'Auswahl':
					$options = explode(PHP_EOL, $question['fb_details']['fb_cb_optionen']);
					$multiple = $question['fb_details']['fb_cb_multiple'];
					if(count($options) <= 15 || $question['fb_details']['fb_cb_user_input']){
						echo '<input type="hidden" class="fb_question fb_pseudo' . ($question['fb_details']['fb_necessary']? ' fb_necessary' : '') . '" value="fb_radio' . $num_radio . '" />';
						foreach ($options as $option){
							echo '<input type="' . ($multiple? 'checkbox': 'radio') . '" data-text="' . htmlentities(trim($option)) . '" style="margin-right: 5px;" autocomplete="off" name="fb_radio' . $num_radio . '" />' . $option . '<br />';
						}
						
						if ($question['fb_details']['fb_cb_user_input']){
							$label = $question['fb_details']['fb_cb_user_input_label'];
							echo '<input class="user_input_radio" type="' . ($multiple? 'checkbox': 'radio') . '" data-text="' . htmlentities(trim($label)) . '" style="margin-right: 5px;" autocomplete="off" name="fb_radio' . $num_radio . '" />' . $label . ': <input class="user_input_text" id="fb_radio' . $num_radio . '_user_text" type="text" value="" autocomplete="off" /><br />';
						}
						
						$num_radio++;
					}
					else {
						echo '<select style="min-width: 300px;"' . ($multiple? ' multiple': '') . ' class="va_fb_select fb_question' . ($question['fb_details']['fb_necessary']? ' fb_necessary' : '') . '" autocomplete="off"><option value="###EMPTY###" />';
						foreach ($options as $option){
							echo '<option>' . htmlentities($option) . '</option>';
						}
						echo '</select>';
					}
					break;
					
				case 'Karte':
					$details = $question['fb_details'];
					echo ' <div class="fb_map fb_question' . ($details['fb_necessary']? ' fb_necessary' : '') . '" id="fb_map' . $num_map++ . '" style="height: 500px;" data-zoom="' . $details['fb_map_zoom'] . '" data-lat="' . $details['fb_map_center']['fb_map_lat'] . '" data-lng="' . $details['fb_map_center']['fb_map_lng'] . '" data-type="' . $details['fb_map_selection_type'] . '" data-map-type="' . $details['fb_map_type'] . '"></div>';
					break;
			}
			
			echo '<br /><br />';
	
		}
		
		if($num_page == $num_pages - 1){
			echo '<input type="button" value="' . get_field('fb_finish_button', $post_id) . '" id="fb_submit_button" />';
		}
		else {
			echo '<input type="button" value="' . get_field('fb_continue_button', $post_id) . '" id="fb_submit_button" />';
		}
	}
	
	echo '</div>';
}
?>