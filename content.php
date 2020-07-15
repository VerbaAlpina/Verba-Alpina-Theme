<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

	if (function_exists('va_get_post_version_id')){
		$post_id = va_get_post_version_id(get_the_ID());
	}
	else {
		$post_id = get_the_ID();
	}

	global $Ue;
	?>
	
	
	<script type="text/javascript">
	jQuery(function() {
		addBiblioQTips(jQuery(".entry-content"));

		addCitations("<?php echo $Ue['KOPIEREN'] ?>");
	});
	</script>

	<article id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'twentytwelve' ); ?>
		</div>
		<?php endif; ?>
		<header class="entry-header">
			<?php if ( ! post_password_required() && ! is_attachment() ) :
				echo get_the_post_thumbnail($post_id);
			endif; ?>

			<?php if ( is_single($post_id) || wp_is_post_revision($post_id) ) : ?>
			<h1 class="entry-title"><?php 
				echo get_the_title($post_id);
				global $va_current_db_name;
				if($va_current_db_name != 'va_xxx'){
					$cite_text = va_create_post_citation($post_id, $Ue);
					$bibtex = va_create_post_bibtex($post_id, $Ue, true);
					echo ' <span class="quote" data-plain="' . $cite_text . '" data-bibtex="' . $bibtex . '" style="font-size: 50%; cursor : pointer; color : grey;">(' . $Ue['ZITIEREN'] . ')</span>';
				}
				
				
				
				?></h1>
				
				<?php $authors = get_field('autoren');
				if ($authors){
					$alist = explode(',', $authors);
					$alist = array_map('trim', $alist);
					echo '<span class="va_authors">' . implode(' | ', $alist) . '</span>';
				}
				else {
					echo '<span class="va_authors">' . get_the_author_meta('display_name') . '</span>';
				}
				?>
				
			<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php echo get_permalink($post_id); ?>" rel="bookmark"><?php echo get_the_title($post_id); ?></a>
			</h1>
			<?php endif; // is_single() ?>
			
			<br />
			
			<?php 
			$post = get_post($post_id);
			$content = $post->post_content;

			//Simulate the_content function:
			$content = apply_filters( 'the_content', $content );
			$content = str_replace( ']]>', ']]&gt;', $content );
			
			global $Ue;
			if (function_exists('va_count_words')){
				$num_words = va_count_words($content);
				echo '<span class="va_post_word_count">(' . $num_words . ' ' . ($num_words == 1? $Ue['WORT'] : $Ue['WOERTER']) . ')</span>';
			}	
			?>
			
			<?php if ( comments_open() ) : ?>
				<div class="comments-link">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
				</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php echo get_the_excerpt($post_id); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<div class="updatableContent">
				<?php echo $content; ?>
			</div>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php twentytwelve_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php
						/** This filter is documented in author.php */
						$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
