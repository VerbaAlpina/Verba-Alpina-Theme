<?php

/*
 * Template Name: Personal Page
 * Description: Person Detail Page
 */
 
 function parseWordFormat ($text){
	$textRep = preg_replace('/<p>(.*)(\xc2\xa0){2,}(.*)<\/p>/', '<tr><td>$1</td><td>$3</td></tr>', $text);
	$textRep = preg_replace('/<p>(.*)(\s){5,}(.*)<\/p>/', '<tr><td>$1</td><td>$3</td></tr>', $textRep);
	$textRep = preg_replace("/(.*)\\\\t(.*)/", '<tr><td>$1</td><td>$2</td></tr>', $textRep);
	if($text === $textRep)
		return $text;
	return '<table>' . $textRep . '</table>';
}
 
get_header(); 
?>

<script type="text/javascript">
	function openSection(id) {
		if (jQuery(id).css("display") == "none")
			jQuery(id).css("display", "block");
		else
			jQuery(id).css("display", "none");
	}
</script>

<div id="primary" class="site-content">
<div id="content" role="main">
<div class="entry-content">
<div id="top-box" style="background-color: #DDDDDD; width: 100%; min-height: 100px; overflow: hidden;">
<?php 
$post_id = get_post()->id;
if(get_current_blog_id() != 1){
	$ids = mlp_get_linked_elements($post_id, '', get_current_blog_id());
	$post_id = $ids[1];
}
	
switch_to_blog(1);

if (get_field('foto', $post_id)) {
	$foto = get_field('foto', $post_id);
?>
<img style="float: left; margin-right: 20pt; margin-left:10pt; margin-top:10pt; margin-bottom:10pt" src="<?php echo $foto['url']; ?>" />
<?php } ?>

<div style="float:left">
<h2><?php the_field('person', $post_id); ?></h2>
<?php the_field('personenbeschreibung', $post_id); ?>
</div>
</div>

<br />

<?php if (get_field('aufgabengebiet', $post_id)) {
?>
<h2><?php echo $Ue['AUFGABENGEBIET']; ?></h2>
<?php } ?>

<?php the_field('aufgabengebiet', $post_id); ?>

<?php
$adress = get_field('adresse', $post_id);
$tel = get_field('telefon', $post_id);
$email = get_field('e-mail', $post_id);

if ($address || $tel || $email) {
	echo '<div id="kontakt">';

	echo '<h2>' . $Ue['KONTAKT'] . '</h2>';

	echo $adress;
	echo '<br />';
	echo '<br />';
	if ($tel) {
		echo '<b>' . $Ue['TELEFON'] . ':</b>&nbsp;' . $tel . '<br />';
	}
	if ($email) {
		echo '<b>Mail:&nbsp;</b>' . $email;
	}
	echo '</div><br /><br />';
}

$ausbildung = get_field('ausbildung', $post_id);
$berufserfahrung = get_field('berufserfahrung', $post_id);

if ($ausbildung || $berufserfahrung) {
	echo '<div id="lebenslauf" style="border-top: 2px solid #ededed;">';

	echo '<h2><a href="javascript:void(0);" onClick="openSection(' . "'#LebenslaufColl'" . ')">' . $Ue['LEBENSLAUF'] . '</a></h2><div id="LebenslaufColl" style="display: none">';

	if ($ausbildung) {
		echo '<h4>Ausbildung</h4>';
		echo parseWordFormat($ausbildung);
	}
	if ($berufserfahrung) {
		echo '<h4>Berufserfahrung</h4>';
		echo parseWordFormat($berufserfahrung);
	}

	echo '</div></div><br />';
}

$forschungsinteressen = get_field('forschungsinteressen', $post_id);
$forschung_akt = get_field('aktuelle_forschung', $post_id);
$forschung_alt = get_field('abgeschlossene_projekte', $post_id);

if ($forschungsinteressen || $forschung_akt || $forschung_alt) {
	echo '<div id="forschung" style="border-top: 2px solid #ededed;">';

	echo '<h2><a href="javascript:void(0);" onClick="openSection(' . "'#forschungColl'" . ')">' . $Ue['FORSCHUNG'] . '</a></h2><div id="forschungColl" style="display: none">';

	if ($forschung_akt) {
		echo '<h4>Aktuelle Forschung</h4>';
		echo parseWordFormat($forschung_akt);
	}
	if ($forschung_alt) {
		echo '<h4>' . $Ue['ABGESCHLOSSENE_PROJEKTE'] . '</h4>';
		echo parseWordFormat($forschung_alt);
	}
	if ($forschungsinteressen) {
		echo '<h4>' . $Ue['FORSCHUNGSINTERESSEN'] . '</h4>';
		echo parseWordFormat($forschungsinteressen);
	}
	

	echo '</div></div><br />';
}

$aufs = get_field('aufsatze', $post_id);
$rez = get_field('rezensionen', $post_id);
$mono = get_field('monographien', $post_id);
$weitere = get_field('weitere_veroffentlichungen', $post_id);
$nicht = get_field('nicht_veroffentlichte_arbeiten', $post_id);
$heraus = get_field('herausgeberschaft', $post_id);

if ($aufs || $rez || $mono || $weitere || $nicht || $heraus) {
	echo '<div id="publikationen" style="border-top: 2px solid #ededed;">';

	echo '<h2><a href="javascript:void(0);" onClick="openSection(' . "'#publikationenColl'" . ')">' . $Ue['PUBLIKATIONEN_PERS'] . '</a></h2><div id="publikationenColl" style="display: none">';

	if ($mono) {
		echo '<h4>Monographie</h4>';
		echo parseWordFormat($mono);
	}
	if ($heraus) {
		echo '<h4>Herausgeberschaft</h4>';
		echo parseWordFormat($heraus);
	}
	if ($aufs) {
		echo '<h4>Aufsätze</h4>';
		echo parseWordFormat($aufs);
	}
	if ($rez) {
		echo '<h4>Rezensionen</h4>';
		echo parseWordFormat($rez);
	}
	
	if ($weitere) {
		echo '<h4>Weitere Veröffentlichungen</h4>';
		echo parseWordFormat($weitere);
	}
	if ($nicht) {
		echo '<h4>Nicht veröffentlichte Arbeiten</h4>';
		echo parseWordFormat($nicht);
	}
	

	echo '</div></div><br />';
}

$vortrage = get_field('vortrage', $post_id);
$workshops = get_field('workshops/tagungen', $post_id);
$poster = get_field('poster', $post_id);

if ($vortrage || $workshops || $poster) {
	echo '<div id="vortrage" style="border-top: 2px solid #ededed;">';

	echo '<h2><a href="javascript:void(0);" onClick="openSection(' . "'#vortrageColl'" . ')">' . $Ue['VORTRAEGE'] . '</a></h2><div id="vortrageColl" style="display: none">';

	if ($vortrage) {
		echo '<h4>Vorträge</h4>';
		echo parseWordFormat($vortrage);
	}
	if ($workshops) {
		echo '<h4>Workshops/Tagungen</h4>';
		echo parseWordFormat($workshops);
	}
	if ($poster) {
		echo '<h4>Poster</h4>';
		echo parseWordFormat($poster);
	}

	echo '</div></div><br />';
}

$lehre = get_field('lehre', $post_id);
if($lehre){
	echo '<div id="lehre" style="border-top: 2px solid #ededed;">';

	echo '<h2><a href="javascript:void(0);" onClick="openSection(' . "'#lehreColl'" . ')">' . $Ue['LEHRE'] . '</a></h2><div id="lehreColl" style="display: none">';

	echo parseWordFormat($lehre);

	echo '</div></div><br />';
}

$mitglied = get_field('mitgliedschaften', $post_id);
if($lehre){
	echo '<div id="mitglied" style="border-top: 2px solid #ededed;">';

	echo '<h2><a href="javascript:void(0);" onClick="openSection(' . "'#mitgliedColl'" . ')">' . $Ue['MITGLIEDSCHAFTEN'] . '</a></h2><div id="mitgliedColl" style="display: none">';

	echo parseWordFormat($mitglied);

	echo '</div></div><br />';
}

restore_current_blog();

?>
</div>
</div><!-- #content -->
</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>