<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Ecolife_Theme
 * @since Ecolife 1.0
 */
$ecolife_opt = get_option( 'ecolife_opt' );
$ecolife_blogsidebar = 'right';
if(isset($ecolife_opt['sidebarblog_pos']) && $ecolife_opt['sidebarblog_pos']!=''){
	$ecolife_blogsidebar = $ecolife_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$ecolife_blogsidebar = $_GET['sidebar'];
}
$ecolife_blog_sidebar_extra_class = NULl;
if($ecolife_blogsidebar=='left') {
	$ecolife_blog_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="col-12 col-lg-3 <?php echo esc_attr($ecolife_blog_sidebar_extra_class);?>">
		<div class="sidebar-content">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div><!-- #secondary -->
<?php endif; ?>