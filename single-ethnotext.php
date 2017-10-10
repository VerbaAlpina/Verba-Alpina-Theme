<?php
global $Ue;
get_header(); 

$exp = get_field('et_explorator');
$inf = get_field('et_informant');

?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<div class="entry-content">
				<div style="border: 2px solid; padding : 5px;">
					<b><?php echo va_translate('INFORMANT', $Ue);?></b>: <?php echo get_field('et_informant');?><br />
					<b><?php echo va_translate('GEBURTSJAHR', $Ue);?></b>: <?php echo get_field('et_geburtsdatum');?><br />
					<b><?php echo va_translate('EXPLORATOR', $Ue);?></b>: <?php echo get_field('et_explorator');?><br />
					<b><?php echo va_translate('ORT', $Ue);?></b>: <?php echo get_field('et_ort');?><br />
					<b><?php echo va_translate('DATUM', $Ue);?></b>: <?php echo get_field('et_datum');?><br />
				</div>
				
				<br />
				<br />
				<br />
			
				<table>
					<tr>
						<td style="border-right: 1px solid #ededed; border-left: 1px solid #ededed;">
						
						</td>
						<td>
							<b><?php echo va_translate('ORIGINAL', $Ue);?></b>
						</td>
						<td style="border-right: 1px solid #ededed;">
							<b><?php echo va_translate('UEBERSETZUNG', $Ue);?></b>
						</td>
					</tr>
					<?php 
					$fields = array();
					$speakers = array();
					while (have_rows('et_text')){
						the_row();
						$fields[] = get_sub_field('et_original');
						$fields[] = get_sub_field('et_ubersetzung');
						$speakers[] = get_sub_field('et_sprecher');
					}
					
					va_combine_footnotes($fields, $combined_footnotes, 'et_');
					
					for ($i = 0; $i < count($fields); $i++){
						?>
						<tr>
							<td style="border-right: 1px solid #ededed; border-left: 1px solid #ededed;">
								<?php 
								if($speakers[($i + 1) / 2] == 'E'){
									echo $exp;
								}
								else {
									echo $inf;	
								}
								?>
							</td>
							<td style="padding-left : 5px;">
								<?php echo $fields[$i++]; ?>
							</td>
							<td style="border-right: 1px solid #ededed;">
								<?php echo $fields[$i]; ?>
							</td>
						</tr>
					<?php
					}
					?>
				</table>
				
				<br />
				<div style="font-size: 85%;">
					<?php echo $combined_footnotes;?>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>