<?php
/**
 * Ecolife functions and definitions
 */
/**
* Require files
*/ 
	//Init the Redux Framework
if ( class_exists( 'ReduxFramework' ) && !isset( $redux_demo ) && file_exists( get_template_directory().'/theme-config.php' ) ) {
	require_once( get_template_directory().'/theme-config.php' );
}
	// Theme files
if ( file_exists( get_template_directory().'/include/wooajax.php' ) ) {
	require_once( get_template_directory().'/include/wooajax.php' );
}
if ( file_exists( get_template_directory().'/include/map_shortcodes.php' ) ) {
	require_once( get_template_directory().'/include/map_shortcodes.php' );
}
if ( file_exists( get_template_directory().'/include/shortcodes.php' ) ) {
	require_once( get_template_directory().'/include/shortcodes.php' );
}
define('PLUGIN_REQUIRED_PATH','http://roadthemes.com/plugins');
Class Ecolife_Class {
	/**
	* Global values
	*/
	static function ecolife_post_odd_event(){
		global $wp_session;
		if(!isset($wp_session["ecolife_postcount"])){
			$wp_session["ecolife_postcount"] = 0;
		}
		$wp_session["ecolife_postcount"] = 1 - $wp_session["ecolife_postcount"];
		return $wp_session["ecolife_postcount"];
	}
	static function ecolife_post_thumbnail_size($size){
		global $wp_session;
		if($size!=''){
			$wp_session["ecolife_postthumb"] = $size;
		}
		return $wp_session["ecolife_postthumb"];
	}
	static function ecolife_shop_class($class){
		global $wp_session;
		if($class!=''){
			$wp_session["ecolife_shopclass"] = $class;
		}
		return $wp_session["ecolife_shopclass"];
	}
	static function ecolife_show_view_mode(){
		$ecolife_opt = get_option( 'ecolife_opt' );
		$ecolife_viewmode = 'grid-view';
		if(isset($ecolife_opt['default_view'])) {
			$ecolife_viewmode = $ecolife_opt['default_view'];
		}
		if(isset($_GET['view']) && $_GET['view']!=''){
			$ecolife_viewmode = $_GET['view'];
		}
		return $ecolife_viewmode;
	}
	static function ecolife_shortcode_products_count(){
		global $wp_session;
		$ecolife_productsfound = 0;
		if(isset($wp_session["ecolife_productsfound"])){
			$ecolife_productsfound = $wp_session["ecolife_productsfound"];
		}
		return $ecolife_productsfound;
	}
	/**
	* Constructor
	*/
	function __construct() {
		// Register action/filter callbacks
			//WooCommerce - action/filter
		add_theme_support( 'woocommerce' );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
		add_filter( 'get_product_search_form', array($this, 'ecolife_woo_search_form'));
		add_filter( 'woocommerce_shortcode_products_query', array($this, 'ecolife_woocommerce_shortcode_count'));
		add_action( 'woocommerce_share', array($this, 'ecolife_woocommerce_social_share'), 35 );
		add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
		    return array(
		        'width'  => 150,
		        'height' => 150,
		        'crop'   => 1,
		    );
		} );
			//move message to top
		remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
		add_action( 'woocommerce_show_message', 'wc_print_notices', 10 );
			//remove add to cart button after item
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			//Single product organize
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			//remove cart total under cross sell
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
		add_action( 'cart_totals', 'woocommerce_cart_totals', 5 );
			//Theme actions
		add_action( 'after_setup_theme', array($this, 'ecolife_setup')); 
		add_action( 'wp_enqueue_scripts', array($this, 'ecolife_scripts_styles') );
		add_action( 'wp_head', array($this, 'ecolife_custom_code_header'));
		add_action( 'widgets_init', array($this, 'ecolife_widgets_init'));
		add_action( 'save_post', array($this, 'ecolife_save_meta_box_data'));
		add_action('comment_form_before_fields', array($this, 'ecolife_before_comment_fields'));
		add_action('comment_form_after_fields', array($this, 'ecolife_after_comment_fields'));
		add_action( 'customize_register', array($this, 'ecolife_customize_register'));
		add_action( 'customize_preview_init', array($this, 'ecolife_customize_preview_js'));
		add_action('admin_enqueue_scripts', array($this, 'ecolife_admin_style'));
			//Theme filters
		add_filter( 'loop_shop_per_page', array($this, 'ecolife_woo_change_per_page'), 20 );
		add_filter( 'woocommerce_output_related_products_args', array($this, 'ecolife_woo_related_products_limit'));
		add_filter( 'get_search_form', array($this, 'ecolife_search_form'));
		add_filter('excerpt_more', array($this, 'ecolife_new_excerpt_more'));
		add_filter( 'excerpt_length', array($this, 'ecolife_change_excerpt_length'), 999 );
		add_filter('wp_nav_menu_objects', array($this, 'ecolife_first_and_last_menu_class'));
		add_filter( 'wp_page_menu_args', array($this, 'ecolife_page_menu_args'));
		add_filter('dynamic_sidebar_params', array($this, 'ecolife_widget_first_last_class'));
		add_filter('dynamic_sidebar_params', array($this, 'ecolife_mega_menu_widget_change'));
		add_filter( 'dynamic_sidebar_params', array($this, 'ecolife_put_widget_content'));
		add_filter( 'the_content_more_link', array($this, 'ecolife_modify_read_more_link'));
		//Adding theme support
		if ( ! isset( $content_width ) ) {
			$content_width = 625;
		}
	}
	/**
	* Filter callbacks
	* ----------------
	*/
	// read more link 
	function ecolife_modify_read_more_link() {
		$ecolife_opt = get_option( 'ecolife_opt' );
		if(isset($ecolife_opt['readmore_text']) && $ecolife_opt['readmore_text'] != ''){
			$readmore_text = esc_html($ecolife_opt['readmore_text']);
		} else { 
			$readmore_text = esc_html('Read more','ecolife');
		};
	    return '<div><a class="readmore" href="'. esc_url(get_permalink()).' ">'.$readmore_text.'</a></div>';
	}
	// Change products per page
	function ecolife_woo_change_per_page() {
		$ecolife_opt = get_option( 'ecolife_opt' );
		return $ecolife_opt['product_per_page'];
	}
	//Change number of related products on product page. Set your own value for 'posts_per_page'
	function ecolife_woo_related_products_limit( $args ) {
		global $product;
		$ecolife_opt = get_option( 'ecolife_opt' );
		$args['posts_per_page'] = $ecolife_opt['related_amount'];
		return $args;
	}
	// Count number of products from shortcode
	function ecolife_woocommerce_shortcode_count( $args ) {
		$ecolife_productsfound = new WP_Query($args);
		$ecolife_productsfound = $ecolife_productsfound->post_count;
		global $wp_session;
		$wp_session["ecolife_productsfound"] = $ecolife_productsfound;
		return $args;
	}
	
	//Change search form
	function ecolife_search_form( $form ) {
		if(get_search_query()!=''){
			$search_str = get_search_query();
		} else {
			$search_str = esc_html__( 'Search... ', 'ecolife' );
		}
		$form = '<form role="search" method="get" class="searchform blogsearchform" action="' . esc_url(home_url( '/' ) ). '" >
		<div class="form-input">
			<input type="text" placeholder="'.esc_attr($search_str).'" name="s" class="input_text ws">
			<button class="button-search searchsubmit blogsearchsubmit" type="submit">' . esc_html__('Search', 'ecolife') . '</button>
			<input type="hidden" name="post_type" value="post" />
			</div>
		</form>';
		return $form;
	}
	//Change woocommerce search form
	function ecolife_woo_search_form( $form ) {
		global $wpdb;
		if(get_search_query()!=''){
			$search_str = get_search_query();
		} else {
			$search_str = esc_html__( 'Search product...', 'ecolife' );
		}
		$form = '<form role="search" method="get" class="searchform productsearchform" action="'.esc_url( home_url( '/'  ) ).'">';
			$form .= '<div class="form-input">';
				$form .= '<input type="text" placeholder="'.esc_attr($search_str).'" name="s" class="ws"/>';
				$form .= '<button class="button-search searchsubmit productsearchsubmit" type="submit">' . esc_html__('Search', 'ecolife') . '</button>';
				$form .= '<input type="hidden" name="post_type" value="product" />';
			$form .= '</div>';
		$form .= '</form>';
		return $form;
	}
	// Replaces the excerpt "more" text by a link
	function ecolife_new_excerpt_more($more) {
		return '';
	}
	//Change excerpt length
	function ecolife_change_excerpt_length( $length ) {
		$ecolife_opt = get_option( 'ecolife_opt' );
		if(isset($ecolife_opt['excerpt_length'])){
			return $ecolife_opt['excerpt_length'];
		}
		return 50;
	}
	//Add 'first, last' class to menu
	function ecolife_first_and_last_menu_class($items) {
		$items[1]->classes[] = 'first';
		$items[count($items)]->classes[] = 'last';
		return $items;
	}
	/**
	 * Filter the page menu arguments.
	 *
	 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
	 *
	 * @since Ecolife 1.0
	 */
	function ecolife_page_menu_args( $args ) {
		if ( ! isset( $args['show_home'] ) )
			$args['show_home'] = true;
		return $args;
	}
	//Add first, last class to widgets
	function ecolife_widget_first_last_class($params) {
		global $my_widget_num;
		$class = '';
		$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
		$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	
		if(!$my_widget_num) {// If the counter array doesn't exist, create it
			$my_widget_num = array();
		}
		if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
			return $params; // No widgets in this sidebar... bail early.
		}
		if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
			$my_widget_num[$this_id] ++;
		} else { // If not, create it starting with 1
			$my_widget_num[$this_id] = 1;
		}
		if($my_widget_num[$this_id] == 1) { // If this is the first widget
			$class .= ' widget-first ';
		} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
			$class .= ' widget-last ';
		}
		$params[0]['before_widget'] = str_replace('first_last', ' '.$class.' ', $params[0]['before_widget']);
		return $params;
	}
	//Change mega menu widget from div to li tag
	function ecolife_mega_menu_widget_change($params) {
		$sidebar_id = $params[0]['id'];
		$pos = strpos($sidebar_id, '_menu_widgets_area_');
		if ( !$pos == false ) {
			$params[0]['before_widget'] = '<li class="widget_mega_menu">'.$params[0]['before_widget'];
			$params[0]['after_widget'] = $params[0]['after_widget'].'</li>';
		}
		return $params;
	}
	// Push sidebar widget content into a div
	function ecolife_put_widget_content( $params ) {
		global $wp_registered_widgets;
		if( $params[0]['id']=='sidebar-category' ){
			$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
			$settings = $settings_getter->get_settings();
			$settings = $settings[ $params[1]['number'] ];
			if($params[0]['widget_name']=="Text" && isset($settings['title']) && $settings['text']=="") { // if text widget and no content => don't push content
				return $params;
			}
			if( isset($settings['title']) && $settings['title']!='' ){
				$params[0][ 'after_title' ] .= '<div class="widget_content">';
				$params[0][ 'after_widget' ] = '</div>'.$params[0][ 'after_widget' ];
			} else {
				$params[0][ 'before_widget' ] .= '<div class="widget_content">';
				$params[0][ 'after_widget' ] = '</div>'.$params[0][ 'after_widget' ];
			}
		}
		return $params;
	}
	/**
	* Action hooks
	* ----------------
	*/
	/**
	 * Ecolife setup.
	 *
	 * Sets up theme defaults and registers the various WordPress features that
	 * Ecolife supports.
	 *
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_editor_style() To add a Visual Editor stylesheet.
	 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
	 * 	custom background, and post formats.
	 * @uses register_nav_menu() To add support for navigation menus.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 *
	 * @since Ecolife 1.0
	 */
	function ecolife_setup() {
		/*
		 * Makes Ecolife available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on Ecolife, use a find and replace
		 * to change 'ecolife' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ecolife', get_template_directory() . '/languages' );
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );
		// Register menus
		register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'ecolife' ) );
		register_nav_menu( 'stickymenu', esc_html__( 'Sticky Menu', 'ecolife' ) );
		register_nav_menu( 'mobilemenu', esc_html__( 'Mobile Menu', 'ecolife' ) );
		register_nav_menu( 'categories', esc_html__( 'Categories Menu', 'ecolife' ) );
		/*
		 * This theme supports custom background color and image,
		 * and here we also set up the default background color.
		 */
		add_theme_support( 'custom-background', array(
			'default-color' => 'e6e6e6',
		) );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1170, 9999 ); // Unlimited height, soft crop
		add_image_size( 'ecolife-category-thumb', 1170, 720, true ); // (cropped) (post carousel)
		add_image_size( 'ecolife-post-thumb', 737, 453, true ); // (cropped) (blog sidebar)
		add_image_size( 'ecolife-post-thumbwide', 1170, 720, true ); // (cropped) (blog large img)
	}
	//Display social sharing on product page
	function ecolife_woocommerce_social_share(){
		$ecolife_opt = get_option( 'ecolife_opt' );
	?>
		<?php if (isset($ecolife_opt['share_code']) && $ecolife_opt['share_code']!='') { ?>
			<div class="share_buttons">
				<?php 
					echo wp_kses($ecolife_opt['share_code'], array(
						'div' => array(
							'class' => array()
						),
						'span' => array(
							'class' => array(),
							'displayText' => array()
						),
					));
				?>
			</div>
		<?php } ?>
	<?php
	}
	/**
	 * Enqueue scripts and styles for front-end.
	 *
	 * @since Ecolife 1.0
	 */
	function ecolife_scripts_styles() {
		global $wp_styles, $wp_scripts;
		$ecolife_opt = get_option( 'ecolife_opt' );
		/*
		 * Adds JavaScript to pages with the comment form to support
		 * sites with threaded comments (when in use).
		*/
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		// Add Bootstrap JavaScript
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.1.1', true );
		// Add Owl files
		wp_enqueue_script( 'owl', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '2.3.4', true );
		wp_enqueue_style( 'owl', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '2.3.4' );
		// Add Chosen js files
		wp_enqueue_script( 'chosen', get_template_directory_uri() . '/js/chosen/chosen.jquery.min.js', array('jquery'), '1.3.0', true );
		wp_enqueue_script( 'chosenproto', get_template_directory_uri() . '/js/chosen/chosen.proto.min.js', array('jquery'), '1.3.0', true );
		wp_enqueue_style( 'chosen', get_template_directory_uri() . '/js/chosen/chosen.min.css', array(), '1.3.0' );
		// Add parallax script files
		//Superfish
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish/superfish.min.js', array('jquery'), '1.3.15', true );
		//Add Shuffle js
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.min.js', array('jquery'), '2.6.2', true );
		wp_enqueue_script( 'shuffle', get_template_directory_uri() . '/js/jquery.shuffle.min.js', array('jquery'), '3.0.0', true );
		//Add mousewheel
		wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.min.js', array('jquery'), '3.1.12', true );
		// Add jQuery countdown file
		wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array('jquery'), '2.0.4', true );
		// Add jQuery counter files
		wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'counterup', get_template_directory_uri() . '/js/jquery.counterup.min.js', array('jquery'), '1.0', true );
		// Add variables.js file
		wp_enqueue_script( 'variables', get_template_directory_uri() . '/js/variables.js', array('jquery'), '20140826', true );
		// Add theme-ecolife.js file
		wp_enqueue_script( 'ecolife-js', get_template_directory_uri() . '/js/theme-ecolife.js', array('jquery'), '20140826', true );
		if ( is_singular( 'product' ) ) {
			wp_enqueue_script( 'magnifier', get_template_directory_uri() . '/js/jquery.carouFredSel.min.js', array('jquery'), '6.2.1', true );
		}
		wp_localize_script('ecolife-js', 'ecolife_countdown_vars', array(
				'day'    => esc_html__( 'Days', 'ecolife' ),
				'hour'   => esc_html__( 'Hours', 'ecolife' ),
				'min'    => esc_html__( 'Mins', 'ecolife' ),
				'sec'    => esc_html__( 'Secs', 'ecolife' ),
			)
		);
		wp_localize_script('ecolife-js', 'ecolife_nav_text', array(
				'pre'    => esc_html__( 'Prev', 'ecolife' ),
				'next'   => esc_html__( 'Next', 'ecolife' ),
			)
		);
		$font_url = $this->ecolife_get_font_url();
		if ( ! empty( $font_url ) )
			wp_enqueue_style( 'ecolife-fonts', esc_url_raw( $font_url ), array(), null );
		// Loads our main stylesheet.
		wp_enqueue_style( 'ecolife-style', get_stylesheet_uri() );
		// Mega Main Menu
		wp_enqueue_style( 'megamenu', get_template_directory_uri() . '/css/megamenu_style.css', array(), '2.0.4' );
		// Load fontawesome css
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );
		// Load ionicons css
		wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/css/ionicons.css', array(), '2.4.0' );
		// Load bootstrap css
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.1' );
		// Compile Less to CSS
		$previewpreset = (isset($_REQUEST['preset']) ? $_REQUEST['preset'] : null);
			//get preset from url (only for demo/preview)
		if($previewpreset){
			$_SESSION["preset"] = $previewpreset;
		}
		$presetopt = 1; /*change default preset 1 and 209-binhthuongg*/
		if(!isset($_SESSION["preset"])){
			$_SESSION["preset"] = 1;
		}
		if($_SESSION["preset"] != 1) {
			$presetopt = $_SESSION["preset"];
		} else { /* if no preset varialbe found in url, use from theme options */
			if(isset($ecolife_opt['preset_option'])){
				$presetopt = $ecolife_opt['preset_option'];
			}
		}
		if(!isset($presetopt)) $presetopt = 1; /* in case first time install theme, no options found */
		if(isset($ecolife_opt['enable_less'])){
			if($ecolife_opt['enable_less']){
				$themevariables = array(
					'product_name_color'             => $ecolife_opt['product_name_color'],
					'body_font'                      => $ecolife_opt['bodyfont']['font-family'],
					'text_color'                     => $ecolife_opt['bodyfont']['color'],
					'text_selected_bg'               => $ecolife_opt['text_selected_bg'],
					'text_selected_color'            => $ecolife_opt['text_selected_color'],
					'price_sale_color'            	=> $ecolife_opt['pricesalecolor'],
					'text_size'                      => $ecolife_opt['bodyfont']['font-size'],
					'border_color'                   => $ecolife_opt['border_color']['border-color'],
					'page_content_background'        => $ecolife_opt['page_content_background']['background-color'],
					'row_space'                      => $ecolife_opt['row_space'],
					'heading_font'                   => $ecolife_opt['headingfont']['font-family'],
					'heading_color'                  => $ecolife_opt['headingfont']['color'],
					'heading_font_weight'            => $ecolife_opt['headingfont']['font-weight'],
					'dropdown_font'                  => $ecolife_opt['dropdownfont']['font-family'],
					'dropdown_color'                 => $ecolife_opt['dropdownfont']['color'],
					'dropdown_font_size'             => $ecolife_opt['dropdownfont']['font-size'],
					'dropdown_font_weight'           => $ecolife_opt['dropdownfont']['font-weight'],
					'dropdown_bg'                    => $ecolife_opt['dropdown_bg'],
					'menu_font'                      => $ecolife_opt['menufont']['font-family'],
					'menu_color'                     => $ecolife_opt['menufont']['color'],
					'menu_font_size'                 => $ecolife_opt['menufont']['font-size'],
					'menu_font_weight'               => $ecolife_opt['menufont']['font-weight'],
					'sub_menu_font'                  => $ecolife_opt['submenufont']['font-family'],
					'sub_menu_color'                 => $ecolife_opt['submenufont']['color'],
					'sub_menu_font_size'             => $ecolife_opt['submenufont']['font-size'],
					'sub_menu_font_weight'           => $ecolife_opt['submenufont']['font-weight'],
					'sub_menu_bg'                    => $ecolife_opt['sub_menu_bg'],
					'categories_font'                => $ecolife_opt['categoriesfont']['font-family'],
					'categories_font_size'           => $ecolife_opt['categoriesfont']['font-size'],
					'categories_font_weight'         => $ecolife_opt['categoriesfont']['font-weight'],
					'categories_color'               => $ecolife_opt['categoriesfont']['color'],
					'categories_menu_label_bg'       => $ecolife_opt['categories_menu_label_bg'],
					'categories_menu_bg'             => $ecolife_opt['categories_menu_bg'],
					'categories_sub_menu_font'       => $ecolife_opt['categoriessubmenufont']['font-family'],
					'categories_sub_menu_font_size'  => $ecolife_opt['categoriessubmenufont']['font-size'],
					'categories_sub_menu_font_weight'=> $ecolife_opt['categoriessubmenufont']['font-weight'],
					'categories_sub_menu_color'      => $ecolife_opt['categoriessubmenufont']['color'],
					'categories_sub_menu_bg'         => $ecolife_opt['categories_sub_menu_bg'],
					'link_color'                     => $ecolife_opt['link_color']['regular'],
					'link_hover_color'               => $ecolife_opt['link_color']['hover'],
					'link_active_color'              => $ecolife_opt['link_color']['active'],
					'primary_color'                  => $ecolife_opt['primary_color'],
					'sale_color'                     => $ecolife_opt['sale_color'],
					'saletext_color'                 => $ecolife_opt['saletext_color'],
					'rate_color'                     => $ecolife_opt['rate_color'],
					'price_font'                     => $ecolife_opt['pricefont']['font-family'],
					'price_color'                    => $ecolife_opt['pricefont']['color'],
					'price_font_size'                => $ecolife_opt['pricefont']['font-size'],
					'price_font_weight'              => $ecolife_opt['pricefont']['font-weight'],
					'topbar_bg'                   	 => $ecolife_opt['topbar_bg'],
					'topbar_color'                   => $ecolife_opt['topbar_color'],
					'topbar_link_color'              => $ecolife_opt['topbar_link_color']['regular'],
					'topbar_link_hover_color'        => $ecolife_opt['topbar_link_color']['hover'],
					'topbar_link_active_color'       => $ecolife_opt['topbar_link_color']['active'],
					'header_bg'                      => $ecolife_opt['header_bg'],
					'header_color'                   => $ecolife_opt['header_color'],
					'header_link_color'              => $ecolife_opt['header_link_color']['regular'],
					'header_link_hover_color'        => $ecolife_opt['header_link_color']['hover'],
					'header_link_active_color'       => $ecolife_opt['header_link_color']['active'],
					'footer_bg'                      => $ecolife_opt['footer_bg'],
					'footer_color'                   => $ecolife_opt['footer_color'],
					'footer_link_color'              => $ecolife_opt['footer_link_color']['regular'],
					'footer_link_hover_color'        => $ecolife_opt['footer_link_color']['hover'],
					'footer_link_active_color'       => $ecolife_opt['footer_link_color']['active'],

					'header_sticky_color'            => $ecolife_opt['header_sticky_color'],
					'header_sticky_link_color'       => $ecolife_opt['header_sticky_link_color']['regular'],
					'header_sticky_link_hover_color' => $ecolife_opt['header_sticky_link_color']['hover'],
					'header_sticky_link_active_color'=> $ecolife_opt['header_sticky_link_color']['active'],

				);
				if(isset($ecolife_opt['header_sticky_bg']['rgba']) && $ecolife_opt['header_sticky_bg']['rgba']!="") {
					$themevariables['header_sticky_bg'] = $ecolife_opt['header_sticky_bg']['rgba'];
				} else {
					$themevariables['header_sticky_bg'] = 'rgba(255, 255, 255, 0.95)';
				}
				switch ($presetopt) {
					case 2:
						
					break;
					case 3:

						$themevariables['header_bg'] = '#253237';
						$themevariables['header_color'] = '#ffffff';
						$themevariables['header_link_color'] = '#ffffff';
						$themevariables['menu_color'] = '#ffffff';

						$themevariables['header_sticky_bg'] = '#253237';
						$themevariables['header_sticky_color'] = '#ffffff';
						$themevariables['header_sticky_link_color'] = '#ffffff';
						$themevariables['header_sticky_link_hover_color'] = '#ffffff';
						$themevariables['header_sticky_link_active_color'] = '#ffffff';

						$themevariables['topbar_bg'] = '#ffffff';
						$themevariables['topbar_color'] = '#253237';
						$themevariables['topbar_link_color'] = '#253237';

					break;
					case 4:
						
					break;
				}
				if(function_exists('compileLessFile')){
					compileLessFile('theme.less', 'theme'.$presetopt.'.css', $themevariables);
				}
			}
		}
		// Load main theme css style files
		wp_enqueue_style( 'ecolife-theme', get_template_directory_uri() . '/css/theme'.$presetopt.'.css', array('bootstrap'), null );
		wp_enqueue_style( 'ecolife-custom', get_template_directory_uri() . '/css/opt_css.css', array('ecolife-theme'), null );
		if(function_exists('WP_Filesystem')){
			if ( ! WP_Filesystem() ) {
				$url = wp_nonce_url();
				request_filesystem_credentials($url, '', true, false, null);
			}
			global $wp_filesystem;
			//add custom css, sharing code to header
			if($wp_filesystem->exists(get_template_directory(). '/css/opt_css.css')){
				$customcss = $wp_filesystem->get_contents(get_template_directory(). '/css/opt_css.css');
				if(isset($ecolife_opt['custom_css']) && $customcss!=$ecolife_opt['custom_css']){ //if new update, write file content
					$wp_filesystem->put_contents(
						get_template_directory(). '/css/opt_css.css',
						$ecolife_opt['custom_css'],
						FS_CHMOD_FILE // predefined mode settings for WP files
					);
				}
			} else {
				$wp_filesystem->put_contents(
					get_template_directory(). '/css/opt_css.css',
					$ecolife_opt['custom_css'],
					FS_CHMOD_FILE // predefined mode settings for WP files
				);
			}
		}
		//add javascript variables
		ob_start(); ?>
		"use strict";
		var ecolife_brandnumber = <?php if(isset($ecolife_opt['brandnumber'])) { echo esc_js($ecolife_opt['brandnumber']); } else { echo '6'; } ?>,
			ecolife_brandscrollnumber = <?php if(isset($ecolife_opt['brandscrollnumber'])) { echo esc_js($ecolife_opt['brandscrollnumber']); } else { echo '2';} ?>,
			ecolife_brandpause = <?php if(isset($ecolife_opt['brandpause'])) { echo esc_js($ecolife_opt['brandpause']); } else { echo '3000'; } ?>,
			ecolife_brandanimate = <?php if(isset($ecolife_opt['brandanimate'])) { echo esc_js($ecolife_opt['brandanimate']); } else { echo '700';} ?>;
		var ecolife_brandscroll = false;
			<?php if(isset($ecolife_opt['brandscroll'])){ ?>
				ecolife_brandscroll = <?php echo esc_js($ecolife_opt['brandscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var ecolife_categoriesnumber = <?php if(isset($ecolife_opt['categoriesnumber'])) { echo esc_js($ecolife_opt['categoriesnumber']); } else { echo '6'; } ?>,
			ecolife_categoriesscrollnumber = <?php if(isset($ecolife_opt['categoriesscrollnumber'])) { echo esc_js($ecolife_opt['categoriesscrollnumber']); } else { echo '2';} ?>,
			ecolife_categoriespause = <?php if(isset($ecolife_opt['categoriespause'])) { echo esc_js($ecolife_opt['categoriespause']); } else { echo '3000'; } ?>,
			ecolife_categoriesanimate = <?php if(isset($ecolife_opt['categoriesanimate'])) { echo esc_js($ecolife_opt['categoriesanimate']); } else { echo '700';} ?>;
		var ecolife_categoriesscroll = 'false';
			<?php if(isset($ecolife_opt['categoriesscroll'])){ ?>
				ecolife_categoriesscroll = <?php echo esc_js($ecolife_opt['categoriesscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var ecolife_blogpause = <?php if(isset($ecolife_opt['blogpause'])) { echo esc_js($ecolife_opt['blogpause']); } else { echo '3000'; } ?>,
			ecolife_bloganimate = <?php if(isset($ecolife_opt['bloganimate'])) { echo esc_js($ecolife_opt['bloganimate']); } else { echo '700'; } ?>;
		var ecolife_blogscroll = false;
			<?php if(isset($ecolife_opt['blogscroll'])){ ?>
				ecolife_blogscroll = <?php echo esc_js($ecolife_opt['blogscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var ecolife_testipause = <?php if(isset($ecolife_opt['testipause'])) { echo esc_js($ecolife_opt['testipause']); } else { echo '3000'; } ?>,
			ecolife_testianimate = <?php if(isset($ecolife_opt['testianimate'])) { echo esc_js($ecolife_opt['testianimate']); } else { echo '700'; } ?>;
		var ecolife_testiscroll = false;
			<?php if(isset($ecolife_opt['testiscroll'])){ ?>
				ecolife_testiscroll = <?php echo esc_js($ecolife_opt['testiscroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var ecolife_catenumber = <?php if(isset($ecolife_opt['catenumber'])) { echo esc_js($ecolife_opt['catenumber']); } else { echo '6'; } ?>,
			ecolife_catescrollnumber = <?php if(isset($ecolife_opt['catescrollnumber'])) { echo esc_js($ecolife_opt['catescrollnumber']); } else { echo '2';} ?>,
			ecolife_catepause = <?php if(isset($ecolife_opt['catepause'])) { echo esc_js($ecolife_opt['catepause']); } else { echo '3000'; } ?>,
			ecolife_cateanimate = <?php if(isset($ecolife_opt['cateanimate'])) { echo esc_js($ecolife_opt['cateanimate']); } else { echo '700';} ?>;
		var ecolife_catescroll = false;
			<?php if(isset($ecolife_opt['catescroll'])){ ?>
				ecolife_catescroll = <?php echo esc_js($ecolife_opt['catescroll'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		var ecolife_menu_number = <?php if(isset($ecolife_opt['categories_menu_items'])) { echo esc_js((int)$ecolife_opt['categories_menu_items']); } else { echo '9';} ?>;
		var ecolife_sticky_header = false;
			<?php if(isset($ecolife_opt['sticky_header'])){ ?>
				ecolife_sticky_header = <?php echo esc_js($ecolife_opt['sticky_header'])==1 ? 'true': 'false'; ?>;
			<?php } ?>
		jQuery(document).ready(function(){
			jQuery(".ws").on('focus', function(){
				if(jQuery(this).val()=="<?php esc_html__( 'Search product...', 'ecolife' );?>"){
					jQuery(this).val("");
				}
			});
			jQuery(".ws").on('focusout', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("<?php esc_html__( 'Search product...', 'ecolife' );?>");
				}
			});
			jQuery(".wsearchsubmit").on('click', function(){
				if(jQuery("#ws").val()=="<?php esc_html__( 'Search product...', 'ecolife' );?>" || jQuery("#ws").val()==""){
					jQuery("#ws").focus();
					return false;
				}
			});
			jQuery(".search_input").on('focus', function(){
				if(jQuery(this).val()=="<?php esc_html__( 'Search...', 'ecolife' );?>"){
					jQuery(this).val("");
				}
			});
			jQuery(".search_input").on('focusout', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("<?php esc_html__( 'Search...', 'ecolife' );?>");
				}
			});
			jQuery(".blogsearchsubmit").on('click', function(){
				if(jQuery("#search_input").val()=="<?php esc_html__( 'Search...', 'ecolife' );?>" || jQuery("#search_input").val()==""){
					jQuery("#search_input").focus();
					return false;
				}
			});
		});
		<?php
		$jsvars = ob_get_contents();
		$jsvars = preg_replace( '/\s*/m', '', $jsvars);
		$jsvars = str_replace( 'var', 'var ', $jsvars);
		ob_end_clean();
		if(function_exists('WP_Filesystem')){
			if($wp_filesystem->exists(get_template_directory(). '/js/variables.js')){
				$jsvariables = $wp_filesystem->get_contents(get_template_directory(). '/js/variables.js');
				if($jsvars!=$jsvariables){ //if new update, write file content
					$wp_filesystem->put_contents(
						get_template_directory(). '/js/variables.js',
						$jsvars,
						FS_CHMOD_FILE // predefined mode settings for WP files
					);
				}
			} else {
				$wp_filesystem->put_contents(
					get_template_directory(). '/js/variables.js',
					$jsvars,
					FS_CHMOD_FILE // predefined mode settings for WP files
				);
			}
		}
		//add css for footer, header templates
		$jscomposer_templates_args = array(
			'orderby'          => 'title',
			'order'            => 'ASC',
			'post_type'        => 'templatera',
			'post_status'      => 'publish',
			'posts_per_page'   => 30,
		);
		$jscomposer_templates = get_posts( $jscomposer_templates_args );
		if(count($jscomposer_templates) > 0) {
			foreach($jscomposer_templates as $jscomposer_template){
				$jscomposer_template_css = get_post_meta ( $jscomposer_template->ID, '_wpb_shortcodes_custom_css', false );
				if(isset($jscomposer_template_css[0]))
				wp_add_inline_style( 'ecolife-custom', $jscomposer_template_css[0] );
			}
		}
		//page width
		$ecolife_opt = get_option( 'ecolife_opt' );
		if(isset($ecolife_opt['box_layout_width'])){
			wp_add_inline_style( 'ecolife-custom', '.wrapper.box-layout {max-width: '.$ecolife_opt['box_layout_width'].'px;}' );
		}
	}
	//add sharing code to header
	function ecolife_custom_code_header() {
		global $ecolife_opt;
		if ( isset($ecolife_opt['share_head_code']) && $ecolife_opt['share_head_code']!='') {
			echo wp_kses($ecolife_opt['share_head_code'], array(
				'script' => array(
					'type' => array(),
					'src' => array(),
					'async' => array()
				),
			));
		}
	}
	/**
	 * Register sidebars.
	 *
	 * Registers our main widget area and the front page widget areas.
	 *
	 * @since Ecolife 1.0
	 */
	function ecolife_widgets_init() {
		$ecolife_opt = get_option( 'ecolife_opt' );
		register_sidebar( array(
			'name' => esc_html__( 'Blog Sidebar', 'ecolife' ),
			'id' => 'sidebar-1',
			'description' => esc_html__( 'Sidebar on blog page', 'ecolife' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'Shop Sidebar', 'ecolife' ),
			'id' => 'sidebar-shop',
			'description' => esc_html__( 'Sidebar on shop page (only sidebar shop layout)', 'ecolife' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'Single product Sidebar', 'ecolife' ),
			'id' => 'sidebar-single_product',
			'description' => esc_html__( 'Sidebar on product details page', 'ecolife' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'Pages Sidebar', 'ecolife' ),
			'id' => 'sidebar-page',
			'description' => esc_html__( 'Sidebar on content pages', 'ecolife' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		if(isset($ecolife_opt['custom-sidebars']) && $ecolife_opt['custom-sidebars']!=""){
			foreach($ecolife_opt['custom-sidebars'] as $sidebar){
				$sidebar_id = str_replace(' ', '-', strtolower($sidebar));
				if($sidebar_id!='') {
					register_sidebar( array(
						'name' => $sidebar,
						'id' => $sidebar_id,
						'description' => $sidebar,
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget' => '</aside>',
						'before_title' => '<h3 class="widget-title"><span>',
						'after_title' => '</span></h3>',
					) );
				}
			}
		}
	}
	static function ecolife_meta_box_callback( $post ) {
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'ecolife_meta_box', 'ecolife_meta_box_nonce' );
		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$value = get_post_meta( $post->ID, '_ecolife_post_intro', true );
		echo '<label for="ecolife_post_intro">';
		esc_html_e( 'This content will be used to replace the featured image, use shortcode here', 'ecolife' );
		echo '</label><br />';
		wp_editor( $value, 'ecolife_post_intro', $settings = array() );
	}
	static function ecolife_custom_sidebar_callback( $post ) {
		global $wp_registered_sidebars;
		$ecolife_opt = get_option( 'ecolife_opt' );
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'ecolife_meta_box', 'ecolife_meta_box_nonce' );
		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		//show sidebar dropdown select
		$csidebar = get_post_meta( $post->ID, '_ecolife_custom_sidebar', true );
		echo '<label for="ecolife_custom_sidebar">';
		esc_html_e( 'Select a custom sidebar for this post/page', 'ecolife' );
		echo '</label><br />';
		echo '<select id="ecolife_custom_sidebar" name="ecolife_custom_sidebar">';
			echo '<option value="">'.esc_html__('- None -', 'ecolife').'</option>';
			foreach($wp_registered_sidebars as $sidebar){
				$sidebar_id = $sidebar['id'];
				if($csidebar == $sidebar_id){
					echo '<option value="'.$sidebar_id.'" selected="selected">'.$sidebar['name'].'</option>';
				} else {
					echo '<option value="'.$sidebar_id.'">'.$sidebar['name'].'</option>';
				}
			}
		echo '</select><br />';
		//show custom sidebar position
		$csidebarpos = get_post_meta( $post->ID, '_ecolife_custom_sidebar_pos', true );
		echo '<label for="ecolife_custom_sidebar_pos">';
		esc_html_e( 'Sidebar position', 'ecolife' );
		echo '</label><br />';
		echo '<select id="ecolife_custom_sidebar_pos" name="ecolife_custom_sidebar_pos">'; ?>
			<option value="left" <?php if($csidebarpos == 'left') {echo 'selected="selected"';}?>><?php echo esc_html__('Left', 'ecolife'); ?></option>
			<option value="right" <?php if($csidebarpos == 'right') {echo 'selected="selected"';}?>><?php echo esc_html__('Right', 'ecolife'); ?></option>
		<?php echo '</select>';
	}
	function ecolife_save_meta_box_data( $post_id ) {
		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */
		// Check if our nonce is set.
		if ( ! isset( $_POST['ecolife_meta_box_nonce'] ) ) {
			return;
		}
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['ecolife_meta_box_nonce'], 'ecolife_meta_box' ) ) {
			return;
		}
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
		/* OK, it's safe for us to save the data now. */
		// Make sure that it is set.
		if ( ! ( isset( $_POST['ecolife_post_intro'] ) || isset( $_POST['ecolife_custom_sidebar'] ) ) )  {
			return;
		}
		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['ecolife_post_intro'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_ecolife_post_intro', $my_data );
		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['ecolife_custom_sidebar'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_ecolife_custom_sidebar', $my_data );
		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['ecolife_custom_sidebar_pos'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, '_ecolife_custom_sidebar_pos', $my_data );
	}
	//Change comment form
	function ecolife_before_comment_fields() {
		echo '<div class="comment-input">';
	}
	function ecolife_after_comment_fields() {
		echo '</div>';
	}
	/**
	 * Register postMessage support.
	 *
	 * Add postMessage support for site title and description for the Customizer.
	 *
	 * @since Ecolife 1.0
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer object.
	 */
	function ecolife_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
	/**
	 * Enqueue Javascript postMessage handlers for the Customizer.
	 *
	 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
	 *
	 * @since Ecolife 1.0
	 */
	function ecolife_customize_preview_js() {
		wp_enqueue_script( 'ecolife-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
	}
	function ecolife_admin_style() {
	  wp_enqueue_style('ecolife-admin-styles', get_template_directory_uri().'/css/admin.css');
	}
	/**
	* Utility methods
	* ---------------
	*/
	//Add breadcrumbs
	static function ecolife_breadcrumb() {
		global $post;
		$ecolife_opt = get_option( 'ecolife_opt' );
		if (!is_home()) {
			echo '<div class="breadcrumbs">';
			echo '<a href="';
			echo esc_url( home_url( '/' ));
			echo '">';
			echo esc_html__('Home', 'ecolife');
			echo '</a><span class="separator">/</span>';
			if (is_category() || is_single()) {
				if( is_category() ) {
	                single_term_title();
	            } elseif (is_single() ) {
					$categories = get_the_category();
					if ( count( $categories ) > 0 ) { 
						echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
						echo '<span class="separator">/</span>'; 
					}
					the_title();
				}
			} elseif (is_page()) {
				if($post->post_parent){
					$anc = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = '<a href="'.esc_url(get_permalink($ancestor)).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a><span class="separator">/</span>';
					}
					echo wp_kses($output, array(
							'a'=>array(
								'href' => array(),
								'title' => array(),
							),
							'span'=>array(
								'class'=>array(),
							)
						)
					);
					echo '<span title="'.esc_attr($title).'"> '.esc_html($title).'</span>';
				} else {
					echo '<span> '.get_the_title().'</span>';
				}
			}
			elseif (is_tag()) {single_tag_title();}
			elseif (is_day()) {printf( esc_html__( 'Archive for: %s', 'ecolife' ), '<span>' . get_the_date() . '</span>' );}
			elseif (is_month()) {printf( esc_html__( 'Archive for: %s', 'ecolife' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'ecolife' ) ) . '</span>' );}
			elseif (is_year()) {printf( esc_html__( 'Archive for: %s', 'ecolife' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'ecolife' ) ) . '</span>' );}
			elseif (is_author()) {echo "<span>".esc_html__('Archive for','ecolife'); echo'</span>';}
			elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>".esc_html__('Blog Archives','ecolife'); echo'</span>';}
			elseif (is_search()) {echo "<span>".esc_html__('Search Results','ecolife'); echo'</span>';}
			echo '</div>';
		} else {
			echo '<div class="breadcrumbs">';
			echo '<a href="';
			echo esc_url( home_url( '/' ) );
			echo '">';
			echo esc_html__('Home', 'ecolife');
			echo '</a><span class="separator">/</span>';
			if(isset($ecolife_opt['blog_header_text']) && $ecolife_opt['blog_header_text']!=""){
				echo esc_html($ecolife_opt['blog_header_text']);
			} else {
				echo esc_html__('Blog', 'ecolife');
			}
			echo '</div>';
		}
	}
	static function ecolife_limitStringByWord ($string, $maxlength, $suffix = '') {
		if(function_exists( 'mb_strlen' )) {
			// use multibyte functions by Iysov
			if(mb_strlen( $string )<=$maxlength) return $string;
			$string = mb_substr( $string, 0, $maxlength );
			$index = mb_strrpos( $string, ' ' );
			if($index === FALSE) {
				return $string;
			} else {
				return mb_substr( $string, 0, $index ).$suffix;
			}
		} else {
			if(strlen( $string )<=$maxlength) return $string;
			$string = substr( $string, 0, $maxlength );
			$index = strrpos( $string, ' ' );
			if($index === FALSE) {
				return $string;
			} else {
				return substr( $string, 0, $index ).$suffix;
			}
		}
	}
	static function ecolife_excerpt_by_id($post, $length = 25, $tags = '<a><span><em><strong>') {
		if ( is_numeric( $post ) ) {
			$post = get_post( $post );
		} elseif( ! is_object( $post ) ) {
			return false;
		}
		if ( has_excerpt( $post->ID ) ) {
			$the_excerpt = $post->post_excerpt;
			return apply_filters( 'the_content', $the_excerpt );
		} else {
			$the_excerpt = $post->post_content;
		}

		$the_excerpt = strip_shortcodes( strip_tags( $the_excerpt, $tags ) );
		$the_excerpt = preg_split( '/\b/', $the_excerpt, $length * 2 + 1 );
		$excerpt_waste = array_pop( $the_excerpt );
		$the_excerpt = implode( $the_excerpt );
		return apply_filters( 'the_content', $the_excerpt );
	}
	/**
	 * Return the Google font stylesheet URL if available.
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * @since Ecolife 1.2
	 *
	 * @return string Font stylesheet or empty string if disabled.
	 */
	function ecolife_get_font_url() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported by Open Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$open_sans = _x( 'on', 'Open Sans font: on or off', 'ecolife' );
		
		 
		if ( 'off' !== $open_sans ) {
			
			
			if ( 'off' !== $open_sans ) {
				$font_families[] = 'Open Sans:300,400,600,700';
			}
			
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);
			 
			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
	/**
	 * Displays navigation to next/previous pages when applicable.
	 *
	 * @since Ecolife 1.0
	 */
	static function ecolife_content_nav( $html_id ) {
		global $wp_query;
		$html_id = esc_attr( $html_id );
		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo esc_attr($html_id); ?>" class="navigation" role="navigation">
				<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'ecolife' ); ?></h3>
				<div class="nav-previous"><?php next_posts_link( wp_kses(__( '<span class="meta-nav">&larr;</span> Older posts', 'ecolife' ),array('span'=>array('class'=>array())) )); ?></div>
				<div class="nav-next"><?php previous_posts_link( wp_kses(__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'ecolife' ), array('span'=>array('class'=>array())) )); ?></div>
			</nav>
		<?php endif;
	}
	/* Pagination */
	static function ecolife_pagination() {
		global $wp_query, $paged;
		if(empty($paged)) $paged = 1;
		$pages = $wp_query->max_num_pages;
			if(!$pages || $pages == '') {
			   	$pages = 1;
			}
		if(1 != $pages) {
			echo '<div class="pagination">';
				echo '<div class="page-numbers-wrapper">';
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'prev_text'    => esc_html__('Previous', 'ecolife'),
						'next_text'    =>esc_html__('Next', 'ecolife')
					) );
				echo '</div>';
			echo '</div>';
		}
	}
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own ecolife_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Ecolife 1.0
	 */
	static function ecolife_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php esc_html_e( 'Pingback:', 'ecolife' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'ecolife' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 50 ); ?>
				</div>
				<div class="comment-info">
					<header class="comment-meta comment-author vcard">
						<?php
							printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
								get_comment_author_link(),
								// If current post author is also comment author, make it known visually.
								( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'ecolife' ) . '</span>' : ''
							);
							printf( '<time datetime="%1$s">%2$s</time>',
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( esc_html__( '%1$s at %2$s', 'ecolife' ), get_comment_date(), get_comment_time() )
							);
						?>
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'ecolife' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
					</header><!-- .comment-meta -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'ecolife' ); ?></p>
					<?php endif; ?>
					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( esc_html__( 'Edit', 'ecolife' ), '<p class="edit-link">', '</p>' ); ?>
					</section><!-- .comment-content -->
				</div>
			</article><!-- #comment-## -->
		<?php
			break;
		endswitch; // end comment_type check
	}
	/**
	 * Set up post entry meta.
	 *
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 *
	 * Create your own ecolife_entry_meta() to override in a child theme.
	 *
	 * @since Ecolife 1.0
	 */
	static function ecolife_entry_meta() {
		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', ', ' );
		$num_comments = (int)get_comments_number();
		$utility_text = null;
		$write_comments = '';
		$utility_text = null;
		if ( ( post_password_required() || !comments_open() ) && ($tag_list != false && isset($tag_list) ) ) {
			$utility_text = '<span class="meta-title">' . esc_html__( 'Tags:','ecolife') . '</span>' . esc_html__('%2$s', 'ecolife' );
		} elseif ( $tag_list != false && isset($tag_list) && $num_comments != 0 ) {
			$utility_text = esc_html__( '%1$s', 'ecolife' ) . '<span class="meta-title">' . esc_html__( 'Tags:','ecolife') . '</span>' . esc_html__('%2$s', 'ecolife' );
		} elseif ( ($num_comments == 0 || !isset($num_comments) ) && $tag_list==true ) {
			$utility_text = '<span class="meta-title">' . esc_html__( 'Tags:','ecolife') . '</span>' . esc_html__('%2$s', 'ecolife' );
		} else {
			$utility_text = esc_html__( '%1$s', 'ecolife' );
		}
		if ( ($tag_list != false && isset($tag_list)) || $num_comments != 0 ) { ?>
			<div class="entry-meta">
				<?php printf( $utility_text, $write_comments, $tag_list); ?>
			</div>
		<?php }
	}
	static function ecolife_entry_meta_small() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list(', ');
		$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( wp_kses(__( 'View all posts by %s', 'ecolife' ), array('a'=>array())), get_the_author() ) ),
			get_the_author()
		);
		$utility_text = esc_html__( 'Posted by %1$s / %2$s', 'ecolife' );
		printf( $utility_text, $author, $categories_list );
	}
	static function ecolife_entry_comments() {
		$date = sprintf( '<time class="entry-date" datetime="%3$s">%4$s</time>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
		$num_comments = (int)get_comments_number();
		$write_comments = '';
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = wp_kses(__('<span>0</span> comments', 'ecolife'), array('span'=>array()));
			} elseif ( $num_comments > 1 ) {
				$comments = '<span>'.$num_comments .'</span>'. esc_html__(' comments', 'ecolife');
			} else {
				$comments = wp_kses(__('<span>1</span> comment', 'ecolife'), array('span'=>array()));
			}
			$write_comments = '<a href="' . esc_url(get_comments_link()) .'">'. $comments.'</a>';
		}
		$utility_text = esc_html__( '%1$s', 'ecolife' );
		printf( $utility_text, $write_comments );
	}
	 
}
// Instantiate theme
$Ecolife_Class = new Ecolife_Class();
//Fix duplicate id of mega menu
function ecolife_mega_menu_id_change($params) {
	ob_start('ecolife_mega_menu_id_change_call_back');
}
function ecolife_mega_menu_id_change_call_back($html){
	$html = preg_replace('/id="mega_main_menu"/', 'id="mega_main_menu_first"', $html, 1);
	$html = preg_replace('/id="mega_main_menu_ul"/', 'id="mega_main_menu_ul_first"', $html, 1);
	return $html;
}
add_action('wp_loaded', 'ecolife_mega_menu_id_change');
function theme_prefix_enqueue_script() {
	wp_add_inline_script( 'ecolife-js', 'var ajaxurl = "'.admin_url('admin-ajax.php').'";','before' );
}
add_action( 'wp_enqueue_scripts', 'theme_prefix_enqueue_script' );
// Wishlist count
if( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ){
function yith_wcwl_ajax_update_count(){
wp_send_json( array(
'count' => yith_wcwl_count_all_products()
) );
}
add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}
function roadthemez_setup(){ 
    // Load admin resources.
    if (is_admin()) { 
        require  get_template_directory().'/road_importdata/class-tgm-plugin-activation.php';
        require  get_template_directory().'/road_importdata/roadtheme-setup.php';
	}
}
add_action('after_setup_theme', 'roadthemez_setup', 9, 0);
