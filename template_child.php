<?php
/*
Template Name: Go to first child
*/
$pagekids = get_pages("child_of=".$post->ID."&sort_column=menu_order");
if ($pagekids) {
$firstchild = reset($pagekids);
wp_redirect(get_permalink($firstchild->ID));
} else {
	//Do nothing
}
?>