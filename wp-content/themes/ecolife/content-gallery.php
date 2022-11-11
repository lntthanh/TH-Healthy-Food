<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package WordPress
 * @subpackage Ecolife_Theme
 * @since Ecolife 1.0
 */
$ecolife_opt = get_option( 'ecolife_opt' );
$ecolife_postthumb = Ecolife_Class::ecolife_post_thumbnail_size('');
if(Ecolife_Class::ecolife_post_odd_event() == 1){
	$ecolife_postclass='even';
} else {
	$ecolife_postclass='odd';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($ecolife_postclass); ?>>
	<div class="post-inner">
		<?php if ( is_single() ) : ?>
			<div class="post-header">
				<h1 class="post-title"><?php the_title(); ?></h1>
				<div class="post-meta">
					<span class="post-author">
						<?php esc_html_e('Posted by', 'ecolife');?> :
						<span class="post-by"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a> </span>
					</span>
					<span class="post-separator">/</span>
					<span class="post-date"> 
						<?php esc_html_e('On : ', 'ecolife');?>
						<?php 
							$archive_year  = get_the_time('Y', $post->ID);
							$archive_month = get_the_time('m', $post->ID);
						?>
						<a href="<?php echo esc_url(get_month_link( $archive_year, $archive_month )); ?>"><?php echo get_the_date('', $post->ID);?></a>
					</span>
					<?php if(has_category()) { ?>
						<span class="post-category">
							<span class="post-separator">/</span>
							<?php esc_html_e('In : ', 'ecolife');?>
							<?php echo get_the_category_list( ', ' ); ?>
						</span>
					<?php } ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( ! post_password_required() && ! is_attachment() ) : ?>
			<?php if ( is_single() ) { ?>
				<?php if (do_shortcode(get_post_meta( $post->ID, '_ecolife_post_intro', true )) != '') { ?>
					<div class="post-thumbnail-wrapper">
						<div class="post-thumbnail">
							<?php echo do_shortcode(get_post_meta( $post->ID, '_ecolife_post_intro', true )); ?>
						</div>
					</div>
				<?php } else { ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="post-thumbnail-wrapper">
							<div class="post-thumbnail">
								<?php the_post_thumbnail(); ?> 
							</div>
						</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<?php if ( !is_single() ) { ?>
				<?php if (do_shortcode(get_post_meta( $post->ID, '_ecolife_post_intro', true )) != '') { ?>
					<div class="post-thumbnail-wrapper">
						<div class="post-thumbnail">
							<?php echo do_shortcode(get_post_meta( $post->ID, '_ecolife_post_intro', true )); ?>
						</div>
					</div>
				<?php } else { ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="post-thumbnail-wrapper">
							<div class="post-thumbnail">
								<a href="<?php esc_url(the_permalink()); ?>"><?php the_post_thumbnail($ecolife_postthumb); ?></a>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		<?php endif; ?>
		<div class="postinfo-wrapper <?php if ( !has_post_thumbnail() ) { echo 'no-thumbnail';} ?>">
			<div class="post-info"> 
				<?php if ( is_single() ) : ?>
					<div class="entry-content">
						<?php the_content( wp_kses(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ecolife' ), array('span'=>array('class'=>array())) )); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ecolife' ), 'after' => '</div>', 'pagelink' => '<span>%</span>' ) ); ?>
					</div>
				<?php else : ?>
					<div class="post-meta">
						<span class="post-author">
							<?php esc_html_e('Posted by', 'ecolife');?> :
							<span class="post-by"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a> </span>
						</span>
						<span class="post-separator">/</span>
						<span class="post-date"> 
							<?php esc_html_e('On : ', 'ecolife');?>
							<?php 
								$archive_year  = get_the_time('Y', $post->ID);
								$archive_month = get_the_time('m', $post->ID);
							?>
							<a href="<?php echo esc_url(get_month_link( $archive_year, $archive_month )); ?>"><?php echo get_the_date('', $post->ID);?></a>
						</span>
						<?php if ( !is_single() ) { ?>
							<?php if( empty( $post->post_title ) ) { ?>
								<span class="post-separator">/</span>
								<span class="post-link"> 
									<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php esc_html_e( 'View posts', 'ecolife' )?></a>
								</span>
							<?php } ?>
						<?php } ?>
					</div>
					<h2 class="post-title">
						<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
					<?php if(has_category()) { ?>
						<div class="post-category">
							<?php echo get_the_category_list( ', ' ); ?>
						</div>
					<?php } ?>
					 
					<?php 
					if ( !is_single() ) {
						// If not a single post, highlight the gallery.
						if ( get_post_gallery() ) {
							echo '<div class="entry-gallery">';
								echo get_post_gallery();
							echo '</div>';
						}; 
					}?>
					<div class="entry-summary">
						<?php
							/* translators: %s: Name of current post */
							the_content( sprintf(
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ecolife' ),
								get_the_title()
							) );

							wp_link_pages( array(
								'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'ecolife' ),
								'after'       => '</div>',
								'link_before' => '<span class="page-number">',
								'link_after'  => '</span>',
							) );
						?>
					</div>
				<?php endif; ?>
				<?php if ( is_single() ) : ?>
					
						<div class="box-social">
							<?php Ecolife_Class::ecolife_entry_meta(); ?>
							<?php if( function_exists('ecolife_blog_sharing') ) { ?>
								<div class="social-sharing"><?php ecolife_blog_sharing(); ?></div>
							<?php } ?>
						</div>
					
					<?php if(get_the_author_meta()!="") { ?>
					<div class="author-info">
						<div class="author-avatar">
							<?php
							$author_bio_avatar_size = apply_filters( 'ecolife_author_bio_avatar_size', 68 );
							echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
							?>
						</div>
						<div class="author-description">
							<h2><?php esc_html_e( 'About the Author:', 'ecolife'); printf( '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">%s</a>' , get_the_author()); ?></h2>
							<p><?php the_author_meta( 'description' ); ?></p>
						</div>
					</div>
					<?php } ?>
					
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>