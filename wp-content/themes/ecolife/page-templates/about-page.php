<?php
/**
 * Template Name: About Template
 *
 * Description: About page template
 *
 * @package WordPress
 * @subpackage Ecolife_Theme
 * @since Ecolife 1.0
 */
$ecolife_opt = get_option( 'ecolife_opt' );

get_header();
?>
<div class="main-container about-page">
	<div class="breadcrumb-container">
		<div class="container">
			<?php Ecolife_Class::ecolife_breadcrumb(); ?>
		</div>
	</div>
	<div class="page-content about-container">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="container">
				<?php get_template_part( 'content', 'page' ); ?>
			</div>
		<?php endwhile; ?>
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