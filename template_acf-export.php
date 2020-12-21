<?php 

/*
 * Template Name: ACF Export
 * Description: Used to export acf fields from PHP code to JSON
 */

$groups = acf_get_local_field_groups();
$json = [];

foreach ($groups as $group) {
	
	if (isset($_REQUEST['group']) && $_REQUEST['group'] != $group['title']){
		continue;
	}
	
	// Fetch the fields for the given group key
	$fields = acf_get_local_fields($group['key']);

	// Remove unecessary key value pair with key "ID"
	unset($group['ID']);

	// Add the fields as an array to the group
	$group['fields'] = $fields;

	// Add this group to the main array
	$json[] = $group;
}

$json = json_encode($json, JSON_PRETTY_PRINT);
// Optional - echo the JSON data to the page
echo "<pre>";
echo $json;
echo "</pre>";
	
?>