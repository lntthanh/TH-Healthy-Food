<?php
/**
 * The Template for displaying all single posts
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
switch($ecolife_bloglayout) {
	case 'nosidebar':
		$ecolife_blogclass = 'blog-nosidebar';
		$ecolife_blogcolclass = 12;
		$ecolife_blogsidebar = 'none';
		break;
	default:
		$ecolife_blogclass = 'blog-sidebar'; 
		$ecolife_blogcolclass = 9;
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
			<div class="col-12 <?php echo 'col-lg-'.$ecolife_blogcolclass; ?>">
				<div class="page-content blog-page single <?php echo esc_attr($ecolife_blogclass); if($ecolife_blogsidebar=='left') {echo ' left-sidebar'; } if($ecolife_blogsidebar=='right') {echo ' right-sidebar'; } ?> ">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
						<?php comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php
			$customsidebar = get_post_meta( $post->ID, '_ecolife_custom_sidebar', true );
			$customsidebar_pos = get_post_meta( $post->ID, '_ecolife_custom_sidebar_pos', true );
			if($customsidebar != ''){
				if($customsidebar_pos == 'left' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col-12 col-lg-3 order-lg-last">';
						dynamic_sidebar( $customsidebar );
					echo '</div>';
				} 
			} else {
				if($ecolife_blogsidebar=='left') {
					get_sidebar();
				}
			} ?>
			<?php
			if($customsidebar != ''){
				if($customsidebar_pos == 'right' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col-12 col-lg-3">';
						dynamic_sidebar( $customsidebar );
					echo '</div>';
				} 
			} else {
				if($ecolife_blogsidebar=='right') {
					get_sidebar();
				}
			} ?>
		</div>
	</div> 
	<!-- brand logo -->
	<?php 
		if(isset($ecolife_opt['inner_brand']) && function_exists('ecolife_brands_shortcode') && shortcode_exists( 'ourbrands' ) ){
			if($ecolife_opt['inner_brand'] && isset($ecolife_opt['brand_logos'][0]) && $ecolife_opt['brand_logos'][0]['thumb']!=null) { ?>
				<div class="inner-brands">
					<div class="container">
						<?php if(isset($ecolife_opt['inner_brand_title']) && $ecolife_opt['inner_brand_title']!=''){ ?>
							<div class="title">
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