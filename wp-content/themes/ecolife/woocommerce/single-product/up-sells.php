<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce, $woocommerce_loop;
$ecolife_opt = get_option( 'ecolife_opt' );
$woocommerce_loop['columns'] = 1;

if ( $upsells ) : ?>

	<section class="roadthemes-slider roadthemes-products up-sells upsells products navigation-style1">

		<div class="heading-title style1 ">
			<h3 class="heading"><span>
				<?php if(isset($ecolife_opt['upsell_product_title']) && $ecolife_opt['upsell_product_title']!='' ) {
					echo wp_kses($ecolife_opt['upsell_product_title'], array(
						'span'=>array(),
						'strong'=>array(),
						'em'=>array(),
					));
				} else { 
					esc_html_e('Upsell Products', 'ecolife'); 
				} ?>	
			</span></h3>
			<?php if(isset($ecolife_opt['upsell_product_sub_title']) && $ecolife_opt['upsell_product_sub_title']!='' ) : ?>
				<?php
				echo '<p>'.wp_kses($ecolife_opt['upsell_product_sub_title'], array(
					'span'=>array(),
					'strong'=>array(),
					'em'=>array(),
				)).'</p>';
				?>
			<?php endif; ?>
		</div>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				 	$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>

<?php endif;

wp_reset_postdata();
