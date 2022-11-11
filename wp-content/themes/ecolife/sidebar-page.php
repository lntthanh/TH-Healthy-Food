<?php
/**
 * The sidebar for content page
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Ecolife_Theme
 * @since Ecolife 1.0
 */
$ecolife_opt = get_option( 'ecolife_opt' );
$ecolife_page_sidebar_extra_class = NULl;
if($ecolife_opt['sidebarse_pos']=='left') {
	$ecolife_page_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-page' ) ) : ?>
<div id="secondary" class="col-12 col-lg-3 <?php echo esc_attr($ecolife_page_sidebar_extra_class);?>">
	<div class="sidebar-content">
		<?php dynamic_sidebar( 'sidebar-page' ); ?>
	</div>
</div>
<?php endif; ?>