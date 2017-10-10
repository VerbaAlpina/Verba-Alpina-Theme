<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
				
					<?php while ( have_posts() ) : the_post(); ?>
						
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
							<div class="featured-post">
								<?php _e( 'Featured post', 'twentytwelve' ); ?>
							</div>
							<?php endif; ?>
							<header class="entry-header">
								<?php if ( ! post_password_required() && ! is_attachment() ) :
									the_post_thumbnail();
								endif; ?>

								<?php if ( is_single() ) : ?>
								<h1 class="entry-title"><?php the_title(); ?></h1>
								<?php else : ?>
								<h1 class="entry-title">
									<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
								</h1>
								<?php endif; // is_single() ?>
								<?php if ( comments_open() ) : ?>
									<div class="comments-link">
										<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
									</div><!-- .comments-link -->
								<?php endif; // comments_open() ?>
							</header><!-- .entry-header -->
						
							<div class="entry-content">
							<?php
							
							if (have_rows('tagung_kapitel')){
								$main_index = 1;
							
								while (have_rows('tagung_kapitel')){ 
									the_row();
									?>
									<h1>
										<?php 
										echo $main_index . '. ';
										the_sub_field('tagung_kapitel_titel');
										?>
									</h1>
									<?php
									the_sub_field('tagung_kapitel_inhalt');
									
									$sub_index = 1;
									while (have_rows('tagung_unterkapitel')){
										the_row();
										?>
										<h2>
											<?php 
											echo $main_index . '.' . $sub_index . '. ';
											the_sub_field('tagung_unterkapitel_titel');
											?>
										</h2>
										<?php
										echo apply_filters( 'the_content', get_sub_field('tagung_unterkapitel_inhalt'));
										$sub_index++;
									}
								$main_index++;
								}
							}
							if(have_rows('bibliographie')){
							?>
							
							<br />
							<br />
						
							<h1>Bibliographie</h1>
								<ul>
								<?php
									$bib_list = array();
									while (have_rows('bibliographie')){
										the_row();
										
										$authors = get_sub_field('bibl_autoren');
										if(count($authors) > 2){
											$author_text = $authors[0]['bibl_autor_nachname'] . ', ' . $authors[0]['bibl_autor_vorname'] . ' et al.';
											$abk = $authors[0]['bibl_autor_nachname'] . ' et al. (' . get_sub_field('bibl_jahr') . ')';
										}
										else {
											$author_text = implode(' / ', array_map(function ($e){
												return $e['bibl_autor_nachname'] . ', ' . $e['bibl_autor_vorname'];
											}, $authors));
											$abk = implode('/', array_map(function ($e){
												return $e['bibl_autor_nachname'];
											}, $authors)). ' (' . get_sub_field('bibl_jahr') . ')';
										}
										
										$bib_list[$abk] = '<li><b>' . $abk . ' = </b>' . va_format_bibliography(
											$author_text,
											get_sub_field('bibl_titel'),
											get_sub_field('bibl_jahr'),
											get_sub_field('bibl_ort'),
											get_sub_field('bibl_link'),
											get_sub_field('bibl_band'),
											get_sub_field('bibl_enthalten_in'),
											get_sub_field('bibl_seiten'),
											get_sub_field('bibl_verlag'),
											false
										) . '</li>';
									}
									ksort($bib_list);
									echo implode($bib_list, "\n");
									?>
								</ul>
								<?php
							}
							?>
						</div>
				
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
				</article>

				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>