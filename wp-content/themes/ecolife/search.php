<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Ecolife_Theme
 * @since Ecolife 1.0
 */
$ecolife_opt = get_option( 'ecolife_opt' );
get_header();
$ecolife_bloglayout = 'sidebar';
if(isset($ecolife_opt['blog_layout']) && $ecolife_opt['blog_layout']!=''){
	$ecolife_bloglayout = $ecolife_opt['blog_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$ecolife_bloglayout = $_GET['layout'];
}
$ecolife_blogsidebar = 'right';
if(isset($ecolife_opt['sidebarblog_pos']) && $ecolife_opt['sidebarblog_pos']!=''){
	$ecolife_blogsidebar = $ecolife_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$ecolife_blogsidebar = $_GET['sidebar'];
}
if ( !is_active_sidebar( 'sidebar-1' ) )  {
	$ecolife_bloglayout = 'nosidebar';
}
$ecolife_blog_main_extra_class = NULl;
if($ecolife_blogsidebar=='left') {
	$ecolife_blog_main_extra_class = 'order-lg-last';
}
$main_column_class = NULL;
switch($ecolife_bloglayout) {
	case 'nosidebar':
		$ecolife_blogclass = 'blog-nosidebar';
		$ecolife_blogcolclass = 12;
		$ecolife_blogsidebar = 'none';
		Ecolife_Class::ecolife_post_thumbnail_size('ecolife-post-thumb');
		break;
	case 'largeimage':
		$ecolife_blogclass = 'blog-large';
		$ecolife_blogcolclass = 9;
		$main_column_class = 'main-column';
		Ecolife_Class::ecolife_post_thumbnail_size('ecolife-post-thumbwide');
		break;
	case 'grid':
		$ecolife_blogclass = 'grid';
		$ecolife_blogcolclass = 9;
		$main_column_class = 'main-column';
		Ecolife_Class::ecolife_post_thumbnail_size('ecolife-post-thumbwide');
		break;
	default:
		$ecolife_blogclass = 'blog-sidebar';
		$ecolife_blogcolclass = 9;
		$main_column_class = 'main-column';
		Ecolife_Class::ecolife_post_thumbnail_size('ecolife-post-thumb');
}
?>
<div class="main-container <?php if(isset($ecolife_opt['blog_banner']['url']) && ($ecolife_opt['blog_banner']['url'])!=''){ echo 'has-image';} ?>">
	<div class="breadcrumb-container">
		<div class="container">
			<?php Ecolife_Class::ecolife_breadcrumb(); ?>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12 <?php echo 'col-lg-'.$ecolife_blogcolclass; ?> <?php echo esc_attr($main_column_class); ?> <?php echo esc_attr($ecolife_blog_main_extra_class);?>">
				<div class="page-content blog-page blogs <?php echo esc_attr($ecolife_blogclass); if($ecolife_blogsidebar=='left') {echo ' left-sidebar'; } if($ecolife_blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					
					<?php if ( have_posts() ) : ?>
						<div class="post-container">
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							<?php endwhile; ?>
						</div>
						<?php Ecolife_Class::ecolife_pagination(); ?>
					<?php else : ?>
						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'ecolife' ); ?></h1>
							</header>
							<div class="entry-content">
								<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'ecolife' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->
					<?php endif; ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
	<!-- brand logo -->
	<?php 
		if(isset($ecolife_opt['inner_brand']) && function_exists('ecolife_brands_shortcode') && shortcode_exists( 'ourbrands' ) ){
			if($ecolife_opt['inner_brand'] && isset($ecolife_opt['brand_logos'][0]) && $ecolife_opt['brand_logos'][0]['thumb']!=null) { ?>
				<div class="inner-brands">
					<div class="container">
						<?php if(isset($ecolife_opt['inner_brand_title']) && $ecolife_opt['inner_brand_title']!=''){ ?>
							<div class="heading-title style1 ">
								<h3><?php echo esc_html( $ecolife_opt['inner_brand_title'] ); ?></h3>
							</div>
						<?php } ?>
						<?php echo do_shortcode('[ourbrands]'); ?>
					</div>
				</div>
			<?php }
		}
	?>
	<!-- end brand logo --> 
</div>
<?php get_footer(); ?>