<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header('shop');
global $wp_query, $woocommerce_loop;
$ecolife_opt = get_option( 'ecolife_opt' );
$shoplayout = 'sidebar';
if(isset($ecolife_opt['shop_layout']) && $ecolife_opt['shop_layout']!=''){
	$shoplayout = $ecolife_opt['shop_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$shoplayout = $_GET['layout'];
}
$shopsidebar = 'left';
if(isset($ecolife_opt['sidebarshop_pos']) && $ecolife_opt['sidebarshop_pos']!=''){
	$shopsidebar = $ecolife_opt['sidebarshop_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$shopsidebar = $_GET['sidebar'];
}
if ( !is_active_sidebar( 'sidebar-shop' ) )  {
	$shoplayout = 'fullwidth';
}
$ecolife_shop_main_extra_class = NULl;
if($shopsidebar=='left') {
	$ecolife_shop_main_extra_class = 'order-lg-last';
}
$main_column_class = NULL;
switch($shoplayout) {
	case 'fullwidth':
		Ecolife_Class::ecolife_shop_class('shop-fullwidth');
		$shopcolclass = 12;
		$shopsidebar = 'none';
		$productcols = 4;
		break;
	default:
		Ecolife_Class::ecolife_shop_class('shop-sidebar');
		$shopcolclass = 9;
		$productcols = 3;
		$main_column_class = 'main-column';
}
$ecolife_viewmode = Ecolife_Class::ecolife_show_view_mode();
?>
<div class="main-container ">
	<div class="box-shop-image">
		<!-- shop banner -->
		<?php if( is_shop()){ ?>
			<?php if(isset($ecolife_opt['shop_banner']['url']) && ($ecolife_opt['shop_banner']['url'])!=''){ ?>
				<div class="shop-banner">
					<img src="<?php echo esc_url($ecolife_opt['shop_banner']['url']); ?>" alt="<?php esc_attr_e('Shop banner','ecolife') ?>" />
				</div>
			<?php } ?>
		<?php } ?>
		<?php if (is_product_category()) {
			if(isset($ecolife_opt['show_category_image']) && $ecolife_opt['show_category_image'] == true)  {
				global $wp_query;
				$cat = $wp_query->get_queried_object();
				$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_url( $thumbnail_id );
				if ( $image ) {
					echo '<div class="shop-banner"><img src="' . esc_url($image) . '" alt=" ' . esc_attr( $cat->name ) . ' " /></div>';
				}
			} else { ?>
				<?php if(isset($ecolife_opt['shop_banner']['url']) && ($ecolife_opt['shop_banner']['url'])!=''){ ?>
					<div class="shop-banner">
						<img src="<?php echo esc_url($ecolife_opt['shop_banner']['url']); ?>" alt="<?php esc_attr_e('Shop banner','ecolife') ?>" />
					</div>
				<?php } ?>
			<?php } ?>
		<?php } ?>
		<!-- end shop banner -->
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<header class="entry-header shop-title">
				<h2 class="entry-title"><?php woocommerce_page_title(); ?></h2>
			</header>
		<?php endif; ?>
		
		
	</div>
	<div class="shop_content">
		<div class="breadcrumb-container">
			<div class="container">
				<?php
					/**
					 * Hook: woocommerce_before_main_content.
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 * @hooked WC_Structured_Data::generate_website_data() - 30
					 */
					do_action( 'woocommerce_before_main_content' );
				?>
			</div>
		</div>
		
		<div class="container shop_content-inner">
			<div class="row">
				<div id="archive-product" class="page-content col-12 <?php echo 'col-lg-'.$shopcolclass; ?> <?php echo esc_attr($ecolife_viewmode);?> <?php echo esc_attr($main_column_class); ?> <?php echo esc_attr($ecolife_shop_main_extra_class);?>">
					
					<div class="archive-border">
						
						<?php
						/**
						 * Hook: woocommerce_archive_description.
						 *
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );
						?>

						<?php if( is_shop()){ ?>

							<?php if ( woocommerce_product_subcategories() ) { ?>
								<div class="shop_tabs"> 
									<?php
									$cargs = array(
										'taxonomy'     => 'product_cat',
										'child_of'     => 0,
										'parent'       => 0,
										'orderby'      => 'name',
										'show_count'   => 0,
										'pad_counts'   => 0,
										'hierarchical' => 0,
										'title_li'     => '',
										'hide_empty'   => 0
									);
									$pcategories = get_categories( $cargs );
									if($pcategories){ 
										$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
									?>
										<div class="row">
											<?php
											foreach($pcategories as $pcategoy) { ?>
												<div class="category-tab col-12 col-sm-6 col-xl-3">
													<?php 
														$thumbnail_id = get_term_meta($pcategoy->term_id, 'thumbnail_id', true);
											            // get the image URL for child category
											            $image = wp_get_attachment_url($thumbnail_id);
											            // print the IMG HTML for child category
											            if ($image) {
											            	echo '<a href=" ' . esc_url(get_term_link($pcategoy->slug, 'product_cat')) . '"> <img src="' . esc_url($image) . '" width = "400" height = "400" alt=" ' . esc_attr( $pcategoy->name ) . '" /> </a>';
											            }
													 ?>
													<a href="<?php echo esc_url(get_term_link($pcategoy->slug, 'product_cat')); ?>"><?php echo esc_attr($pcategoy->name); ?></a>
												</div>
											 <?php } ?>
										</div>
										<?php
									} ?> 
								</div>
							<?php } ?>
							
						<?php } ?>

						<?php if ( woocommerce_products_will_display() ) { ?>
							<div class="toolbar">
								<div class="toolbar-inner">
									<div class="view-mode">
										<label><?php esc_html_e('View on', 'ecolife');?></label>
										<a href="#" class="grid <?php if($ecolife_viewmode=='grid-view'){ echo ' active';} ?>" title="<?php esc_attr_e( 'Grid', 'ecolife' ); ?>"><?php esc_html_e('Grid', 'ecolife');?></a>
										<a href="#" class="list <?php if($ecolife_viewmode=='list-view'){ echo ' active';} ?>" title="<?php esc_attr_e( 'List', 'ecolife' ); ?>"><?php esc_html_e('List', 'ecolife');?></a>
									</div>
									<?php
										/**
										 * Hook: woocommerce_before_shop_loop.
										 *
										 * @hooked wc_print_notices - 10
										 * @hooked woocommerce_result_count - 20
										 * @hooked woocommerce_catalog_ordering - 30
										 */
										do_action( 'woocommerce_before_shop_loop' );
									?>
									
									<div class="clearfix"></div>
								</div>
							</div>
						<?php } ?>
						<?php
							/**
							* remove message from 'woocommerce_before_shop_loop' and show here
							*/
							do_action( 'woocommerce_show_message' );
						?>
						<?php if ( have_posts() ) : ?>	
							<div class="shop-products products <?php echo esc_attr($ecolife_viewmode);?> <?php echo esc_attr($shoplayout);?>">
								<?php $woocommerce_loop['columns'] = $productcols; ?>
								<?php woocommerce_product_subcategories();
								//reset loop
								$woocommerce_loop['loop'] = 0; ?>
								<div class="shop-products-inner">
									<div class="row">
										<?php while ( have_posts() ) : the_post(); ?>
											<?php wc_get_template_part( 'content', 'product-archive' ); ?>
										<?php endwhile; // end of the loop. ?>
									</div>
								</div>
							</div>
							<?php if ( woocommerce_products_will_display() ) { ?>
							<?php
								/**
								 * woocommerce_before_shop_loop hook
								 *
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_after_shop_loop' );
							?>
							<div class="clearfix"></div>
							<?php } ?>
						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
							<?php wc_get_template( 'loop/no-products-found.php' ); ?>
						<?php endif; ?>
					<?php
						/**
						 * woocommerce_after_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
					</div>
				</div>
				<?php if($shoplayout!='fullwidth' && is_active_sidebar('sidebar-shop')): ?>
					<?php get_sidebar('shop'); ?>
				<?php endif; ?>
			</div>
		</div> 
	</div>
</div>

<?php get_footer( 'shop' ); ?>