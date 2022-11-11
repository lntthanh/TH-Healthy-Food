<?php
/**
 * The sidebar for shop page
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Ecolife_Theme
 * @since Ecolife 1.0
 */
$ecolife_opt = get_option( 'ecolife_opt' );
$shopsidebar = 'left';
if(isset($ecolife_opt['sidebarshop_pos']) && $ecolife_opt['sidebarshop_pos']!=''){
	$shopsidebar = $ecolife_opt['sidebarshop_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$shopsidebar = $_GET['sidebar'];
}
$ecolife_shop_sidebar_extra_class = NULl;
if($shopsidebar=='left') {
	$ecolife_shop_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-shop' ) ) : ?>
	<div id="secondary" class="col-12 col-lg-3 sidebar-shop <?php echo esc_attr($ecolife_shop_sidebar_extra_class);?>">
		<div class="sidebar-content">
			<?php dynamic_sidebar( 'sidebar-shop' ); ?>
		</div>
	</div>
<?php endif; ?>