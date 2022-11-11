<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Ecolife_Theme
 * @since Ecolife 1.0
 */
$ecolife_opt = get_option( 'ecolife_opt' );
get_header();
?>
	<div class="main-container error404">
		<div class="container">
			<div class="search-form-wrapper">
				<h2><?php esc_html_e( "OOPS! PAGE NOT BE FOUND", 'ecolife' ); ?></h2>
				<p class="home-link"><?php esc_html_e( "Sorry but the page you are looking for does not exist, has been removed, changed or is temporarity unavailable.", 'ecolife' ); ?></p>
				<?php get_search_form(); ?>
				<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Back to home', 'ecolife' ); ?>"><?php esc_html_e( 'Back to home page', 'ecolife' ); ?></a>
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