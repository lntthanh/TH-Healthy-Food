<?php
//Shortcodes for Visual Composer
add_action( 'vc_before_init', 'ecolife_vc_shortcodes' );
function ecolife_vc_shortcodes() { 
	//Site logo
	vc_map( array(
		'name' => esc_html__( 'Logo', 'ecolife'),
		'description' => esc_html__( 'Insert logo image', 'ecolife' ),
		'base' => 'roadlogo',
		'class' => '',
		'category' => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params' => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload logo image', 'ecolife' ),
				'description'=> esc_html__( 'Note: For retina screen, logo image size is at least twice as width and height (width is set below) to display clearly', 'ecolife' ),
				'param_name' => 'logo_image',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Insert logo link or not', 'ecolife' ),
				'param_name' => 'logo_link',
				'value'      => array(
					esc_html__( 'Yes', 'ecolife' )	=> 'yes',
					esc_html__( 'No', 'ecolife' )	=> 'no',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Logo width (unit: px)', 'ecolife' ),
				'description'=> esc_html__( 'Insert number. Leave blank if you want to use original image size', 'ecolife' ),
				'param_name' => 'logo_width',
				'value'      => esc_html__( '150', 'ecolife' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )                          => 'style1',
					esc_html__( 'Style 2 (footer)', 'ecolife' )                 => 'style2',
					esc_html__( 'Style 3 (header mobile + sticky)', 'ecolife' ) => 'style3',
				),
			),
		)
	) );
	//Main Menu
	vc_map( array(
		'name'        => esc_html__( 'Main Menu', 'ecolife'),
		'description' => esc_html__( 'Set Primary Menu in Apperance - Menus - Manage Locations', 'ecolife' ),
		'base'        => 'roadmainmenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'        => '',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Set Primary Menu in Apperance - Menus - Manage Locations', 'ecolife' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'ecolife' ),
				'param_name'  => 'no_settings',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1 (Default)', 'ecolife' )      => 'style1',
					
				),
			),
		),
	) );
	//Sticky Menu
	vc_map( array(
		'name'        => esc_html__( 'Sticky Menu', 'ecolife'),
		'description' => esc_html__( 'Set Sticky Menu in Apperance - Menus - Manage Locations', 'ecolife' ),
		'base'        => 'roadstickymenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'        => '',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Set Sticky Menu in Apperance - Menus - Manage Locations', 'ecolife' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'ecolife' ),
				'param_name'  => 'no_settings',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )  => 'style1',
					
				),
			),
		),
	) );
	//Mobile Menu
	vc_map( array(
		'name'        => esc_html__( 'Mobile Menu', 'ecolife'),
		'description' => esc_html__( 'Set Mobile Menu in Apperance - Menus - Manage Locations', 'ecolife' ),
		'base'        => 'roadmobilemenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'        => '',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Set Mobile Menu in Apperance - Menus - Manage Locations', 'ecolife' ),
				'description' => esc_html__( 'More settings in Theme Options - Main Menu', 'ecolife' ),
				'param_name'  => 'no_settings',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )  => 'style1',
				),
			),
		),
	) );
	//Categories Menu
	vc_map( array(
		'name'        => esc_html__( 'Categories Menu', 'ecolife'),
		'description' => esc_html__( 'Set Categories Menu in Apperance - Menus - Manage Locations', 'ecolife' ),
		'base'        => 'roadcategoriesmenu',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'        => '',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Set Categories Menu in Apperance - Menus - Manage Locations', 'ecolife' ),
				'description' => esc_html__( 'More settings in Theme Options - Categories Menu', 'ecolife' ),
				'param_name'  => 'no_settings',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Show full Categories in home page ?', 'ecolife' ),
				'description' => esc_html__( 'In inner pages, it only shows the toogle', 'ecolife' ),
				'param_name' => 'categories_show_home',
				'value'      => array(
					esc_html__( 'No', 'ecolife' )  => 'false',
					esc_html__( 'Yes', 'ecolife' ) => 'true',
				),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )          => 'style1',
					esc_html__( 'Style 2', 'ecolife' ) => 'style2',
				),
			),
		),
	) );
	//Social Icons
	vc_map( array(
		'name'        => esc_html__( 'Social Icons', 'ecolife'),
		'description' => esc_html__( 'Configure icons and links in Theme Options', 'ecolife' ),
		'base'        => 'roadsocialicons',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => '',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Configure icons and links in Theme Options > Social Icons', 'ecolife' ),
				'param_name' => 'no_settings',
				'value'      => '',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Social title element', 'ecolife' ),
				'param_name' => 'social_title',
				'value'      => 'Title',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Social sub-title element', 'ecolife' ),
				'param_name' => 'sub_social_title',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1 (header)', 'ecolife' ) => 'style1',
					esc_html__( 'Style 2 (footer)', 'ecolife' ) => 'style2',
				),
			),
		),
	) );
	//Mini Cart
	vc_map( array(
		'name'        => esc_html__( 'Mini Cart', 'ecolife'),
		'description' => esc_html__( 'Mini Cart', 'ecolife' ),
		'base'        => 'roadminicart',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => '',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'This widget does not have settings', 'ecolife' ),
				'param_name' => 'no_settings',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )              => 'style1',
				),
			),
		),
	) );
	//Wishlist
	vc_map( array(
		'name'        => esc_html__( 'Wishlist', 'ecolife'),
		'description' => esc_html__( 'Wishlist', 'ecolife' ),
		'base'        => 'roadwishlist',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )           => 'style1',
				),
			),
		),
	) );
	//Products Search without dropdown
	vc_map( array(
		'name'        => esc_html__( 'Product Search (No dropdown)', 'ecolife'),
		'description' => esc_html__( 'Product Search (No dropdown)', 'ecolife' ),
		'base'        => 'roadproductssearch',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )           => 'style1',
				),
			),
		),
	) );
	//Products Search with dropdown
	vc_map( array(
		'name'        => esc_html__( 'Product Search (Dropdown)', 'ecolife'),
		'description' => esc_html__( 'Product Search (Dropdown)', 'ecolife' ),
		'base'        => 'roadproductssearchdropdown',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => '',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'This widget does not have settings', 'ecolife' ),
				'param_name' => 'no_settings',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )               => 'style1',
				),
			),
		),
	) );
	//Image slider
	vc_map( array(
		'name'        => esc_html__( 'Image slider', 'ecolife' ),
		'description' => esc_html__( 'Upload images and links in Theme Options', 'ecolife' ),
		'base'        => 'image_slider',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'ecolife' ),
				'param_name' => 'rows',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
					'5'	=> '5',
					'6'	=> '6',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Number of columns (screen: over 1500px)', 'ecolife' ),
				'param_name' => 'items_1500up',
				'value'      => esc_html__( '4', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Number of columns (screen: 1200px - 1499px)', 'ecolife' ),
				'param_name' => 'items_1200_1499',
				'value'      => esc_html__( '4', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 992px - 1199px)', 'ecolife' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '4', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 768px - 991px)', 'ecolife' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '3', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 640px - 767px)', 'ecolife' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '2', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 480px - 639px)', 'ecolife' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 375px - 479px)', 'ecolife' ),
				'param_name' => 'items_375_479',
				'value'      => esc_html__( '1', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: under 374px)', 'ecolife' ),
				'param_name' => 'items_0_374',
				'value'      => esc_html__( '1', 'ecolife' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Navigation', 'ecolife' ),
				'param_name' => 'navigation',
				'value'      => array(
					esc_html__( 'Yes', 'ecolife' ) => true,
					esc_html__( 'No', 'ecolife' )  => false,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pagination', 'ecolife' ),
				'param_name' => 'pagination',
				'value'      => array(
					esc_html__( 'No', 'ecolife' )  => false,
					esc_html__( 'Yes', 'ecolife' ) => true,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Item Margin (unit: pixel)', 'ecolife' ),
				'param_name' => 'item_margin',
				'value'      => 30,
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Slider speed number (unit: second)', 'ecolife' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider loop', 'ecolife' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider Auto', 'ecolife' ),
				'param_name' => 'auto',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )  => 'style1',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Navigation style', 'ecolife' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					esc_html__( 'Navigation center horizontal', 'ecolife' )  => 'navigation-style1',
					esc_html__( 'Navigation top-right', 'ecolife' )          => 'navigation-style2',
				),
			),
		),
	) );
	//Brand logos
	vc_map( array(
		'name'        => esc_html__( 'Brand Logos', 'ecolife' ),
		'description' => esc_html__( 'Upload images and links in Theme Options', 'ecolife' ),
		'base'        => 'ourbrands',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'ecolife' ),
				'param_name' => 'rows',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Number of columns (screen: over 1500px)', 'ecolife' ),
				'param_name' => 'items_1500up',
				'value'      => esc_html__( '5', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 1200px - 1499px)', 'ecolife' ),
				'param_name' => 'items_1200_1499',
				'value'      => esc_html__( '5', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 992px - 1199px)', 'ecolife' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '5', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 768px - 991px)', 'ecolife' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '4', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 640px - 767px)', 'ecolife' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '3', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 480px - 639px)', 'ecolife' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 375px - 479px)', 'ecolife' ),
				'param_name' => 'items_375_479',
				'value'      => esc_html__( '1', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: under 374px)', 'ecolife' ),
				'param_name' => 'items_0_374',
				'value'      => esc_html__( '1', 'ecolife' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Navigation', 'ecolife' ),
				'param_name' => 'navigation',
				'value'      => array(
					esc_html__( 'Yes', 'ecolife' ) => true,
					esc_html__( 'No', 'ecolife' )  => false,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pagination', 'ecolife' ),
				'param_name' => 'pagination',
				'value'      => array(
					esc_html__( 'No', 'ecolife' )  => false,
					esc_html__( 'Yes', 'ecolife' ) => true,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Item Margin (unit: pixel)', 'ecolife' ),
				'param_name' => 'item_margin',
				'value'      => 0,
			),
			array(
				'type'       => 'textfield',
				'heading'    =>  esc_html__( 'Slider speed number (unit: second)', 'ecolife' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider loop', 'ecolife' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider Auto', 'ecolife' ),
				'param_name' => 'auto',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )       => 'style1',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Navigation style', 'ecolife' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					esc_html__( 'Navigation center horizontal', 'ecolife' )  => 'navigation-style1',
					esc_html__( 'Navigation top-right', 'ecolife' )          => 'navigation-style2',
					
				),
			),
		),
	) );
	//Latest posts
	vc_map( array(
		'name'        => esc_html__( 'Latest posts', 'ecolife' ),
		'description' => esc_html__( 'List posts', 'ecolife' ),
		'base'        => 'latestposts',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"        => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of posts', 'ecolife' ),
				'param_name' => 'posts_per_page',
				'value'      => esc_html__( '10', 'ecolife' ),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Category', 'ecolife' ),
				'param_name'  => 'category',
				'value'       => esc_html__( '0', 'ecolife' ),
				'description' => esc_html__( 'Slug of the category (example: slug-1, slug-2). Default is 0 : show all posts', 'ecolife' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Image scale', 'ecolife' ),
				'param_name' => 'image',
				'value'      => array(
					'Wide'	=> 'wide',
					'Square'=> 'square',
				),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Excerpt length', 'ecolife' ),
				'param_name' => 'length',
				'value'      => esc_html__( '20', 'ecolife' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns', 'ecolife' ),
				'param_name' => 'colsnumber',
				'value'      => array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
					'4'	=> '4',
					'5'	=> '5',
					'6'	=> '6',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Style', 'ecolife' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1', 'ecolife' )          		   => 'style1',
					
				),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable slider', 'ecolife' ),
				'param_name'  => 'enable_slider',
				'value'       => true,
				'save_always' => true, 
				'group'       => esc_html__( 'Slider Options', 'ecolife' ),
			),
			array(
				'type'       => 'dropdown',
				'class'      => '',
				'heading'    => esc_html__( 'Number of rows', 'ecolife' ),
				'param_name' => 'rowsnumber',
				'group'      => esc_html__( 'Slider Options', 'ecolife' ),
				'value'      => array(
						'1'	=> '1',
						'2'	=> '2',
						'3'	=> '3',
						'4'	=> '4',
					),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number of columns (screen: 1200px - 1499px)', 'ecolife' ),
				'param_name' => 'items_1200_1499',
				'group'      => esc_html__( 'Slider Options', 'ecolife' ),
				'value'      => esc_html__( '3', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 992px - 1199px)', 'ecolife' ),
				'param_name' => 'items_992_1199',
				'value'      => esc_html__( '3', 'ecolife' ),
				'group'      => esc_html__( 'Slider Options', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 768px - 991px)', 'ecolife' ),
				'param_name' => 'items_768_991',
				'value'      => esc_html__( '3', 'ecolife' ),
				'group'      => esc_html__( 'Slider Options', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 640px - 767px)', 'ecolife' ),
				'param_name' => 'items_640_767',
				'value'      => esc_html__( '2', 'ecolife' ),
				'group'      => esc_html__( 'Slider Options', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 480px - 639px)', 'ecolife' ),
				'param_name' => 'items_480_639',
				'value'      => esc_html__( '2', 'ecolife' ),
				'group'      => esc_html__( 'Slider Options', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: 375px - 479px)', 'ecolife' ),
				'param_name' => 'items_375_479',
				'value'      => esc_html__( '1', 'ecolife' ),
				'group'      => esc_html__( 'Slider Options', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'class'      => '',
				'heading'    => esc_html__( 'Number of columns (screen: under 374px)', 'ecolife' ),
				'param_name' => 'items_0_374',
				'value'      => esc_html__( '1', 'ecolife' ),
				'group'      => esc_html__( 'Slider Options', 'ecolife' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Navigation', 'ecolife' ),
				'param_name'  => 'navigation',
				'save_always' => true,
				'group'       => esc_html__( 'Slider Options', 'ecolife' ),
				'value'       => array(
					esc_html__( 'Yes', 'ecolife' ) => true,
					esc_html__( 'No', 'ecolife' )  => false,
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Pagination', 'ecolife' ),
				'param_name'  => 'pagination',
				'save_always' => true,
				'group'       => esc_html__( 'Slider Options', 'ecolife' ),
				'value'       => array(
					esc_html__( 'No', 'ecolife' )  => false,
					esc_html__( 'Yes', 'ecolife' ) => true,
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Item Margin (unit: pixel)', 'ecolife' ),
				'param_name'  => 'item_margin',
				'value'       => 30,
				'save_always' => true,
				'group'       => esc_html__( 'Slider Options', 'ecolife' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Slider speed number (unit: second)', 'ecolife' ),
				'param_name'  => 'speed',
				'value'       => '500',
				'save_always' => true,
				'group'       => esc_html__( 'Slider Options', 'ecolife' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Slider loop', 'ecolife' ),
				'param_name'  => 'loop',
				'value'       => true,
				'group'       => esc_html__( 'Slider Options', 'ecolife' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Slider Auto', 'ecolife' ),
				'param_name'  => 'auto',
				'value'       => true,
				'group'       => esc_html__( 'Slider Options', 'ecolife' ),
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Navigation style', 'ecolife' ),
				'param_name'  => 'navigation_style',
				'group'       => esc_html__( 'Slider Options', 'ecolife' ),
				'value'       => array(
					esc_html__( 'Navigation center horizontal', 'ecolife' )  => 'navigation-style1',
					esc_html__( 'Navigation top-right', 'ecolife' )          => 'navigation-style2',
				),
			),
		),
	) );
	//Testimonials
	vc_map( array(
		'name'        => esc_html__( 'Testimonials', 'ecolife' ),
		'description' => esc_html__( 'Testimonial slider', 'ecolife' ),
		'base'        => 'testimonials',
		'class'       => '',
		'category'    => esc_html__( 'Theme', 'ecolife'),
		"icon"     	  => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'      => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number of testimonial', 'ecolife' ),
				'param_name' => 'limit',
				'value'      => esc_html__( '10', 'ecolife' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display Author', 'ecolife' ),
				'param_name' => 'display_author',
				'value'      => array(
					esc_html__( 'Yes', 'ecolife' ) => '1',
					esc_html__( 'No', 'ecolife' )	 => '0',
				),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display Avatar', 'ecolife' ),
				'param_name' => 'display_avatar',
				'value'      => array(
					esc_html__( 'Yes', 'ecolife' ) => '1',
					esc_html__( 'No', 'ecolife' )  => '0',
				),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Avatar image size', 'ecolife' ),
				'param_name'  => 'size',
				'value'       => '150',
				'description' => esc_html__( 'Avatar image size in pixels. Default is 150', 'ecolife' ),
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Display URL', 'ecolife' ),
				'param_name' => 'display_url',
				'value'      => array(
					esc_html__( 'Yes', 'ecolife' ) => '1',
					esc_html__( 'No', 'ecolife' )	 => '0',
				),
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Category', 'ecolife' ),
				'param_name'  => 'category',
				'value'       => esc_html__( '0', 'ecolife' ),
				'description' => esc_html__( 'Slug of the category. Default is 0 : show all testimonials', 'ecolife' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Navigation', 'ecolife' ),
				'param_name' => 'navigation',
				'value'      => array(
					esc_html__( 'No', 'ecolife' )  => false,
					esc_html__( 'Yes', 'ecolife' ) => true,
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pagination', 'ecolife' ),
				'param_name' => 'pagination',
				'value'      => array(
					esc_html__( 'Yes', 'ecolife' ) => true,
					esc_html__( 'No', 'ecolife' )  => false,
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    =>  esc_html__( 'Slider speed number (unit: second)', 'ecolife' ),
				'param_name' => 'speed',
				'value'      => '500',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider loop', 'ecolife' ),
				'param_name' => 'loop',
			),
			array(
				'type'       => 'checkbox',
				'value'      => true,
				'heading'    => esc_html__( 'Slider Auto', 'ecolife' ),
				'param_name' => 'auto',
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Style', 'ecolife' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1', 'ecolife' )                => 'style1',
					esc_html__( 'Style 2 (about page 4)', 'ecolife' )   => 'style-about-page',
				),
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'div',
				'heading'     => esc_html__( 'Navigation style', 'ecolife' ),
				'param_name'  => 'navigation_style',
				'value'       => array(
					esc_html__( 'Navigation center horizontal', 'ecolife' )  => 'navigation-style1',
					esc_html__( 'Navigation top-right', 'ecolife' )          => 'navigation-style2',
				),
			),
		),
	) );
	//Counter
	vc_map( array(
		'name'     => esc_html__( 'Counter', 'ecolife' ),
		'description' => esc_html__( 'Counter', 'ecolife' ),
		'base'     => 'ecolife_counter',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'ecolife'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'        => 'attach_image',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Image icon', 'ecolife' ),
				'param_name'  => 'image',
				'value'       => '',
				'description' => esc_html__( 'Upload icon image', 'ecolife' ),
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Number', 'ecolife' ),
				'param_name' => 'number',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Text', 'ecolife' ),
				'param_name' => 'text',
				'value'      => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )  => 'style1',
				),
			),
		),
	) );
	//Heading title
	vc_map( array(
		'name'     => esc_html__( 'Heading Title', 'ecolife' ),
		'description' => esc_html__( 'Heading Title', 'ecolife' ),
		'base'     => 'roadthemes_title',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'ecolife'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Heading title element', 'ecolife' ),
				'param_name' => 'heading_title',
				'value'      => 'Title',
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'     => esc_html__( 'Tag heading', 'ecolife' ),
				'param_name'  => 'tag',
				'value'       => array(
					esc_html__( 'h2', 'ecolife' )        => 'h2',
					esc_html__( 'h3', 'ecolife' )        => 'h3',
					esc_html__( 'h4', 'ecolife' )        => 'h4',
					esc_html__( 'h5', 'ecolife' )        => 'h5',
					esc_html__( 'h6', 'ecolife' )        => 'h6',
				),
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Heading sub-title element', 'ecolife' ),
				'param_name' => 'sub_heading_title',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'     => esc_html__( 'Style', 'ecolife' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1 (Default)', 'ecolife' )             => 'style1',
					esc_html__( 'Style 2 (Footer title)', 'ecolife' )        => 'style2',
				),
			),
		),
	) );
	//Countdown
	vc_map( array(
		'name'     => esc_html__( 'Countdown', 'ecolife' ),
		'description' => esc_html__( 'Countdown', 'ecolife' ),
		'base'     => 'roadthemes_countdown',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'ecolife'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (day)', 'ecolife' ),
				'param_name' => 'countdown_day',
				'value'      => '1',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (month)', 'ecolife' ),
				'param_name' => 'countdown_month',
				'value'      => '1',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'End date (year)', 'ecolife' ),
				'param_name' => 'countdown_year',
				'value'      => '2020',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Style', 'ecolife' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'ecolife' )  => 'style1',
				),
			),
		),
	) );
	//Mailchimp newsletter
	vc_map( array(
		'name'     => esc_html__( 'Mailchimp Newsletter', 'ecolife' ),
		'description' => esc_html__( 'Mailchimp Newsletter ', 'ecolife' ),
		'base'     => 'roadthemes_newsletter',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'ecolife'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'        => 'textarea',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Newsletter title', 'ecolife' ),
				'param_name'  => 'newsletter_title',
				'value'       => '',
			),
			array(
				'type'        => 'textarea',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Newsletter sub-title', 'ecolife' ),
				'param_name'  => 'newsletter_sub_title',
				'value'       => '',
			),
			array(
				'type'        => 'attach_image',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Upload newsletter title image', 'ecolife' ),
				'param_name'  => 'newsletter_image',
				'value'       => '',
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'div',
				'class'       => '',
				'heading'     => esc_html__( 'Insert id of Mailchimp Form', 'ecolife' ),
				'description' => esc_html__( 'See id in admin -> MailChimp for WP -> Form, under the form title', 'ecolife' ),
				'param_name'  => 'newsletter_form_id',
				'value'       => '',
			),
			array(
				'type'       => 'dropdown',
				'holder'     => 'div',
				'class'      => '',
				'heading'     => esc_html__( 'Style', 'ecolife' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1 (Default)', 'ecolife' )    => 'style1',
					
				),
			),
		),
	) );
	//Custom Menu
	$custom_menus = array();
	if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		if ( is_array( $menus ) && ! empty( $menus ) ) {
			foreach ( $menus as $single_menu ) {
				if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
					$custom_menus[ $single_menu->name ] = $single_menu->term_id;
				}
			}
		}
	}
	vc_map( array(
		'name'     => esc_html__( 'Custom Menu', 'ecolife' ),
		'description' => esc_html__( 'Custom Menu', 'ecolife' ),
		'base'     => 'roadthemes_menu',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'ecolife'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload menu image', 'ecolife' ),
				'param_name' => 'menu_image',
				'value'      => '',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu title', 'ecolife' ),
				'param_name' => 'menu_title',
				'value'      => 'Title',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Choose Menu', 'ecolife' ),
				'param_name'  => 'nav_menu',
				'value'       => $custom_menus,
				'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'ecolife' ) : esc_html__( 'Select menu to display.', 'ecolife' ),
				'admin_label' => true,
				'save_always' => true,
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu text', 'ecolife' ),
				'param_name' => 'menu_text',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu link text', 'ecolife' ),
				'param_name' => 'menu_link_text',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Menu link url', 'ecolife' ),
				'param_name' => 'menu_link_url',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Style', 'ecolife' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1 (Default)', 'ecolife' )    => 'style1',
					esc_html__( 'Style 2 ', 'ecolife' )    => 'style2',
				),
			),
		),
	) );
	//Policy
	vc_map( array(
		'name'     => esc_html__( 'Policy', 'ecolife' ),
		'description' => esc_html__( 'Policy content', 'ecolife' ),
		'base'     => 'roadthemes_policy',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'ecolife'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload Policy icon', 'ecolife' ),
				'param_name' => 'policy_icon',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Icon width (unit: px)', 'ecolife' ),
				'description'=> esc_html__( 'Insert number. Leave blank if you want to use original image size', 'ecolife' ),
				'param_name' => 'icon_policy_width',
				'value'      => esc_html__( '50', 'ecolife' ),
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Policy title', 'ecolife' ),
				'param_name' => 'policy_title',
				'value'      => 'Title',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Policy text', 'ecolife' ),
				'param_name' => 'policy_text',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Style', 'ecolife' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1 (Default)', 'ecolife' )    => 'style1',
				),
			),
		),
	) );
	//Static block
	vc_map( array(
		'name'     => esc_html__( 'Static block 1', 'ecolife' ),
		'description' => esc_html__( 'Static block with link text', 'ecolife' ),
		'base'     => 'roadthemes_static_1',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'ecolife'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload Static image', 'ecolife' ),
				'param_name' => 'static_image',
				'value'      => '',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static title', 'ecolife' ),
				'param_name' => 'static_title',
				'value'      => 'Title',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static text', 'ecolife' ),
				'param_name' => 'static_text',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static link text', 'ecolife' ),
				'param_name' => 'static_link_text',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static link url', 'ecolife' ),
				'param_name' => 'static_link_url',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Style', 'ecolife' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1', 'ecolife' )    => 'style1',
					esc_html__( 'Style 2', 'ecolife' )    => 'style2',
				),
			),
		),
	) );
	vc_map( array(
		'name'     => esc_html__( 'Static block 2', 'ecolife' ),
		'description' => esc_html__( 'Static block without link text', 'ecolife' ),
		'base'     => 'roadthemes_static_2',
		'class'    => '',
		'category' => esc_html__( 'Theme', 'ecolife'),
		"icon"     => get_template_directory_uri() . "/images/road-icon.jpg",
		'params'   => array(
			array(
				'type'       => 'attach_image',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Upload Static image', 'ecolife' ),
				'param_name' => 'static_image',
				'value'      => '',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static title', 'ecolife' ),
				'param_name' => 'static_title',
				'value'      => 'Title',
			),
			array(
				'type'       => 'textarea',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static text', 'ecolife' ),
				'param_name' => 'static_text',
				'value'      => '',
			),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'class'      => '',
				'heading'    => esc_html__( 'Static link url', 'ecolife' ),
				'param_name' => 'static_link_url',
				'value'      => '',
			),
			array(
				'type'        => 'dropdown',
				'holder'     => 'div',
				'heading'     => esc_html__( 'Style', 'ecolife' ),
				'param_name'  => 'style',
				'value'       => array(
					esc_html__( 'Style 1 (demo 3 style 1)', 'ecolife' )    => 'style1',
				),
			),
		),
	) );
}
?>