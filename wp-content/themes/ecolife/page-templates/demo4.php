<?php
$_SESSION["preset"] = 4;
/**
 * Template Name: Demo 4
 *
 * Description: Demo 4
 *
 * @package WordPress
 * @subpackage Ecolife
 * @since Ecolife  1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<?php global $ecolife_opt; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>" />
<?php
$jscomposer_templates_args = array(
	'orderby'          => 'title',
	'order'            => 'ASC',
	'post_type'        => 'templatera',
	'post_status'      => 'publish',
	'posts_per_page'   => 100,
);
$jscomposer_templates = get_posts( $jscomposer_templates_args );
if(count($jscomposer_templates) > 0) {
	foreach($jscomposer_templates as $jscomposer_template){
		if($jscomposer_template->post_title == 'Header4' || $jscomposer_template->post_title == 'Footer1'){
			$jscomposer_template_css = get_post_meta ( $jscomposer_template->ID, '_wpb_shortcodes_custom_css', false );
			if(isset($jscomposer_template_css[0])){
				echo '<style>'.esc_html($jscomposer_template_css[0]).'</style>';
			}
		}
	}
} ?>
<?php wp_head(); ?>
</head>
<body <?php body_class('home'); ?>>
	<div id="yith-wcwl-popup-message" style="display:none;"><div id="yith-wcwl-message"></div></div>
	<div class="wrapper">
		<div class="page-wrapper">
			<div class="header-container header4 rs-active has-mobile-layout">  
			 	<div class="header">
					<div class="header-content">
						<?php
						if ( isset($ecolife_opt['header_layout']) && $ecolife_opt['header_layout']!="") {
							$jscomposer_templates_args = array(
								'orderby'          => 'title',
								'order'            => 'ASC',
								'post_type'        => 'templatera',
								'post_status'      => 'publish',
								'posts_per_page'      => 100,
							);
							$jscomposer_templates = get_posts( $jscomposer_templates_args );
							if(count($jscomposer_templates) > 0) {
								foreach($jscomposer_templates as $jscomposer_template){
									if($jscomposer_template->post_title == 'Header4'){ ?>
										<div class="header-composer">
											<div class="container">
												<?php 
													echo do_shortcode(apply_filters( 'the_content', $jscomposer_template->post_content ));
												?>
											</div>
										</div>
									<?php }
								}
							}
							// header mobile
							if ( isset($ecolife_opt['header_mobile_layout']) && $ecolife_opt['header_mobile_layout'] != "") {
								if(count($jscomposer_templates) > 0) {
									foreach($jscomposer_templates as $jscomposer_template){
										if($jscomposer_template->post_title == 'HeaderMobile'){ ?>
											<div class="header-mobile">
												<div class="container">
													<?php 
														echo do_shortcode(apply_filters( 'the_content', $jscomposer_template->post_content ));
													?>
												</div>
											</div>
										<?php }
									}
								}
							}
							// header mobile
							if ( isset($ecolife_opt['sticky_header']) && $ecolife_opt['sticky_header']) {
								if(count($jscomposer_templates) > 0) {
									foreach($jscomposer_templates as $jscomposer_template){
										if($jscomposer_template->post_title == 'HeaderSticky4'){ ?>
											<div class="header-sticky <?php if ( is_admin_bar_showing() ) {echo 'with-admin-bar';} ?>">
												<div class="container">
													<?php 
														echo do_shortcode(apply_filters( 'the_content', $jscomposer_template->post_content ));
													?>
												</div>
											</div>
										<?php }
									}
								}
							}
						} 
						?>
					</div>
				</div>  
				<div class="clearfix"></div>
			</div>
			<div class="main-container front-page">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<div class="container">
								<?php the_content(); ?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<div class="footer footer1">
				<div class="container">
					<div class="footer-inner">
						<?php
						if ( isset($ecolife_opt['footer_layout']) && $ecolife_opt['footer_layout']!="" ) { ?>
							<div class="footer-composer">
								<?php $jscomposer_templates_args = array(
									'orderby'          => 'title',
									'order'            => 'ASC',
									'post_type'        => 'templatera',
									'post_status'      => 'publish',
									'posts_per_page'   => 30,
								);
								$jscomposer_templates = get_posts( $jscomposer_templates_args );
								if(count($jscomposer_templates) > 0) {
									foreach($jscomposer_templates as $jscomposer_template){
										if($jscomposer_template->post_title == $ecolife_opt['footer_layout']){
											echo do_shortcode(apply_filters( 'the_content', $jscomposer_template->post_content ));
										}
									}
								} ?>
							</div>
							<?php ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div><!-- .page -->
	</div><!-- .wrapper -->
	<div id="back-top" class="hidden-xs hidden-sm hidden-md"></div>
	<?php wp_footer(); ?>
</body>
</html>
<?php unset($_SESSION["preset"]); ?>