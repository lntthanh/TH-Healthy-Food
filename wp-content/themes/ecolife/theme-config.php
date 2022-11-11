<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */
if (!class_exists('ecolife_Theme_Config')) {
    class ecolife_Theme_Config {
        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;
        public function __construct() {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }
        public function initSettings() {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();
            // Set the default arguments
            $this->setArguments();
            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();
            // Create the sections and fields
            $this->setSections();
            if (!isset($this->args['opt_name'])) {
                return;
            }
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }
        /**
          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field   set with compiler=>true is changed.
         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>'. esc_html__('The compiler hook has run!', 'ecolife').'</h1>';
            echo "<pre>";
            print_r($changed_values);
            echo "</pre>";
        }
        /**
          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.
          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section($sections) {
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'ecolife'),
                'desc' => '<p class="description">'. esc_html__('This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'ecolife').'</p>',
                'icon' => 'el-icon-paper-clip',
                'fields' => array()
            );
            return $sections;
        }
        /**
          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args) {
            return $args;
        }
        /**
          Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = esc_html__('Testing filter hook!', 'ecolife');
            return $defaults;
        }
        public function setSections() {
            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            ob_start();
            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';
            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'ecolife'), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
                <?php if ($screenshot) : ?>
                    <?php if (current_user_can('edit_theme_options')) : ?>
                            <a href="<?php echo esc_url(wp_customize_url()); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                                <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'ecolife'); ?>" />
                            </a>
                    <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'ecolife'); ?>" />
                <?php endif; ?>
                <h4><?php echo esc_html($this->theme->display('Name')); ?></h4>
                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'ecolife'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'ecolife'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' .__('Tags', 'ecolife') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo esc_html($this->theme->display('Description')); ?></p>
                    <?php
                        if ($this->theme->parent()) {
                            printf(' <p class="howto">' .__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'ecolife') . '</p>',__('http://codex.wordpress.org/Child_Themes', 'ecolife'), $this->theme->parent()->display('Name'));
                    } ?>
                </div>
            </div>
            <?php
            $item_info = ob_get_contents();
            ob_end_clean();
            $sampleHTML = '';
            // General
            $this->sections[] = array(
                'title'     => esc_html__('General', 'ecolife'),
                'desc'      => esc_html__('General theme options', 'ecolife'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                    array(
                        'id'        => 'page_content_background',
                        'type'      => 'background',
                        'output'    => array('.page-wrapper'),
                        'title'     => esc_html__('Page content background', 'ecolife'),
                        'subtitle'  => esc_html__('Select background for page content.', 'ecolife'),
                        'default'   => array('background-color' => '#ffffff'),
                    ),
                    array( 
                        'id'       => 'border_color',
                        'type'     => 'border',
                        'title'    => esc_html__('Border Option', 'ecolife'),
                        'subtitle' => esc_html__('Only color validation can be done on this field type', 'ecolife'),
                        'default'  => array('border-color' => '#ebebeb'),
                    ), 
                    array(
                        'id'        => 'back_to_top',
                        'type'      => 'switch',
                        'title'     => esc_html__('Back To Top', 'ecolife'),
                        'desc'      => esc_html__('Show back to top button on all pages', 'ecolife'),
                        'default'   => true,
                    ),
                    array(
                        'id'            => 'row_space',
                        'type'          => 'text',
                        'title'         => esc_html__('Row space', 'ecolife'),
                        'desc'          => esc_html__('Space between row (example: 50px).', 'ecolife'),
                        "default"       => '60px',
                        'display_value' => 'text',
                    ),
                ),
            );
            // Colors
            $this->sections[] = array(
                'title'     => esc_html__('Colors', 'ecolife'),
                'desc'      => esc_html__('Color options', 'ecolife'),
                'icon'      => 'el-icon-tint',
                'fields'    => array(
                    array(
                        'id'          => 'primary_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Primary Color', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for primary color.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#4fb68d',
                        'validate'    => 'color',
                    ),
                    
                    array(
                        'id'          => 'sale_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Sale Label BG Color', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for bg sale label.', 'ecolife'),
                        'transparent' => true,
                        'default'     => '#cf2929',
                        'validate'    => 'color',
                    ),
                    
                    array(
                        'id'          => 'saletext_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Sale Label Text Color', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for sale label text.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                    
                    array(
                        'id'          => 'rate_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Rating Star Color', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for star of rating.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#fdd835',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'          => 'link_color',
                        'type'        => 'link_color',
                        'title'       => esc_html__('Link Color', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for link.', 'ecolife'),
                        'default'     => array(
                            'regular'  => '#253237',
                            'hover'    => '#4fb68d',
                            'active'   => '#4fb68d',
                            'visited'  => '#4fb68d',
                        )
                    ),
                    array(
                        'id'          => 'text_selected_bg',
                        'type'        => 'color',
                        'title'       => esc_html__('Text selected background', 'ecolife'),
                        'subtitle'    => esc_html__('Select background for selected text.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#91b2c3',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'          => 'text_selected_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Text selected color', 'ecolife'),
                        'subtitle'    => esc_html__('Select color for selected text.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
					array(
                        'id'          => 'pricesalecolor',
                        'type'        => 'color',
                        'title'       => esc_html__('Price Sale Off color', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for Price Sale Off color.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#cf2929',
                        'validate'    => 'color',
                    ),
                ),
            );
            //Header
            $header_layouts = array();
            $header_mobile_layouts = array();
            $header_sticky_layouts = array();
            $header_default = '';
            $header_mobile_default = '';
            $header_sticky_default = '';
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
                    $header_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                    $header_mobile_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                    $header_sticky_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                }
                $header_default = 'Header1';
                $header_mobile_default = 'HeaderMobile';
                $header_sticky_default = 'HeaderSticky';
            }
            $this->sections[] = array(
                'title'     => esc_html__('Header', 'ecolife'),
                'desc'      => esc_html__('Header options', 'ecolife'),
                'icon'      => 'el-icon-tasks',
                'fields'    => array(

                    array(
                        'id'                => 'header_layout',
                        'type'              => 'select',
                        'title'             => esc_html__('Header Layout', 'ecolife'),
                        'customizer_only'   => false,
                        'desc'              => esc_html__('Go to WPBakery Page Builder => Templates to create/edit layout', 'ecolife'),
                        'options'           => $header_layouts,
                        'default'           => $header_default,
                    ),
                    array(
                        'id'        => 'header_mobile_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Header Mobile Layout', 'ecolife'),
                        'customizer_only'   => false,
                        'desc'      => esc_html__('Go to WPBakery Page Builder => Templates to create/edit layout', 'ecolife'),
                        'options'   => $header_mobile_layouts,
                        'default'   => $header_mobile_default,
                    ),
                    array(
                        'id'        => 'header_bg',
                        'type'      => 'color',
                        'title'     => esc_html__('Header background', 'ecolife'),
                        'subtitle'  => esc_html__('Pick a color for header background.', 'ecolife'), 
                        'default'   => 'transparent',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'          => 'header_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Header text color', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for header color.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#253237',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'        => 'header_link_color',
                        'type'      => 'link_color',
                        'title'     => esc_html__('Header link color', 'ecolife'),
                        'subtitle'  => esc_html__('Pick a color for header link color.', 'ecolife'),
                        'default'   => array(
                            'regular'  => '#253237',
                            'hover'    => '#4fb68d',
                            'active'   => '#4fb68d',
                            'visited'  => '#4fb68d',
                        )
                    ),
                    array(
                        'id'          => 'dropdown_bg',
                        'type'        => 'color',
                        'title'       => esc_html__('Dropdown menu background', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for dropdown menu background.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                ),
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Sticky header', 'ecolife' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'sticky_header',
                        'type'      => 'switch',
                        'title'     => esc_html__('Use sticky header', 'ecolife'),
                        'default'   => true,
                    ),
                    array(
                        'id'                => 'header_sticky_layout',
                        'type'              => 'select',
                        'title'             => esc_html__('Header Sticky Layout', 'ecolife'),
                        'customizer_only'   => false,
                        'desc'              => esc_html__('Go to WPBakery Page Builder => Templates to create/edit layout', 'ecolife'),
                        'options'           => $header_sticky_layouts,
                        'default'           => $header_sticky_default,
                    ),
                    array(
                        'id'        => 'header_sticky_bg',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Header sticky background', 'ecolife'),
                        'subtitle'  => esc_html__('Set color and alpha channel', 'ecolife'),
                        'default'   => array(
                            'color'     => '#ffffff',
                            'alpha'     => 0.95,
                        ),
                        'options'       => array(
                            'show_input'                => true,
                            'show_initial'              => true,
                            'show_alpha'                => true,
                            'show_palette'              => true,
                            'show_palette_only'         => false,
                            'show_selection_palette'    => true,
                            'max_palette_size'          => 10,
                            'allow_empty'               => true,
                            'clickout_fires_change'     => false,
                            'choose_text'               => 'Choose',
                            'cancel_text'               => 'Cancel',
                            'show_buttons'              => true,
                            'use_extended_classes'      => true,
                            'palette'                   => null,
                            'input_text'                => 'Select Color'
                        ),                        
                    ),
                    array(
                        'id'          => 'header_sticky_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Header Sticky text color', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for header sticky color.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#253237',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'        => 'header_sticky_link_color',
                        'type'      => 'link_color',
                        'title'     => esc_html__('Header Sticky link color', 'ecolife'),
                        'subtitle'  => esc_html__('Pick a color for header sticky link color.', 'ecolife'),
                        'default'   => array(
                            'regular'  => '#253237',
                            'hover'    => '#4fb68d',
                            'active'   => '#4fb68d',
                            'visited'  => '#4fb68d',
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Top Bar', 'ecolife' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'topbar_bg',
                        'type'      => 'color',
                        'title'     => esc_html__('Topbar background', 'ecolife'),
                        'subtitle'  => esc_html__('Pick a color for topbar background.', 'ecolife'), 
                        'default'   => '#253237',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'          => 'topbar_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Top bar text color', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for top bar text color.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'        => 'topbar_link_color',
                        'type'      => 'link_color',
                        'title'     => esc_html__('Top bar link color', 'ecolife'),
                        'subtitle'  => esc_html__('Pick a color for top bar link color .', 'ecolife'),
                        'default'   => array(
                            'regular'  => '#ffffff',
                            'hover'    => '#4fb68d',
                            'active'   => '#4fb68d',
                            'visited'  => '#4fb68d',
                        )
                    ), 
                )
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Main Menu', 'ecolife' ),
                'fields'     => array(
                    array(
                        'id'        => 'mobile_menu_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Mobile menu label', 'ecolife'),
                        'subtitle'  => esc_html__('The label for mobile menu (example: Menu, Go to...', 'ecolife'),
                        'default'   => esc_html__('Menu', 'ecolife'),
                    ), 
                    array(
                        'id'          => 'sub_menu_bg',
                        'type'        => 'color',
                        'title'       => esc_html__('Submenu background', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for sub menu bg .', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                )
            ); 
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Categories Menu', 'ecolife' ),
                'fields'     => array(
                    array(
                        'id'        => 'categories_menu_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Category menu label', 'ecolife'),
                        'subtitle'  => esc_html__('The label for category menu', 'ecolife'),
                        'default'   => esc_html__('Browse categories', 'ecolife'),
                    ),
                    array(
                        'id'          => 'categories_menu_label_bg',
                        'type'        => 'color',
                        'title'       => esc_html__('Category menu label background', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for category menu label background.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#222222',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'          => 'categories_menu_bg',
                        'type'        => 'color',
                        'title'       => esc_html__('Category menu background', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for category menu background.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'          => 'categories_sub_menu_bg',
                        'type'        => 'color',
                        'title'       => esc_html__('Sub category menu background', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for category sub menu background.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#ffffff',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'            => 'categories_menu_items',
                        'type'          => 'slider',
                        'title'         => esc_html__('Number of items', 'ecolife'),
                        'desc'          => esc_html__('Number of menu items level 1 to show.', 'ecolife'),
                        "default"       => 9,
                        "min"           => 1,
                        "step"          => 1,
                        "max"           => 15,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'categories_more_label',
                        'type'      => 'text',
                        'title'     => esc_html__('More items label', 'ecolife'),
                        'subtitle'  => esc_html__('The label for more items button', 'ecolife'),
                        'default'   => esc_html__('Show More', 'ecolife'),
                    ),
                    array(
                        'id'        => 'categories_less_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Less items label', 'ecolife'),
                        'subtitle'  => esc_html__('The label for less items button', 'ecolife'),
                        'default'   => esc_html__('Show Less', 'ecolife'),
                    ),
                )
            );
            //Footer
            $footer_layouts = array();
            $footer_default = '';
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
                    $footer_layouts[$jscomposer_template->post_title] = $jscomposer_template->post_title;
                }
                $footer_default = 'Footer1';
            }
            $this->sections[] = array(
                'title'     => esc_html__('Footer', 'ecolife'),
                'desc'      => esc_html__('Footer options', 'ecolife'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(

                    array(
                        'id'                => 'footer_layout',
                        'type'              => 'select',
                        'title'             => esc_html__('Footer Layout', 'ecolife'),
                        'customizer_only'   => false,
                        'desc'              => esc_html__('Go to WPBakery Page Builder => Templates to create/edit layout', 'ecolife'),
                        'options'           => $footer_layouts,
                        'default'           => $footer_default
                    ),
                    array(
                        'id'        => 'footer_bg',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer background', 'ecolife'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'ecolife'), 
                        'default'   => '#efefef',
                    ), 
                    array(
                        'id'          => 'footer_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Footer text color', 'ecolife'),
                        'subtitle'    => esc_html__('Pick a color for footer color.', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#666666',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'        => 'footer_link_color',
                        'type'      => 'link_color',
                        'title'     => esc_html__('Footer link color', 'ecolife'),
                        'subtitle'  => esc_html__('Pick a color for footer link color.', 'ecolife'),
                        'default'   => array(
                            'regular'  => '#666666',
                            'hover'    => '#4fb68d',
                            'active'   => '#4fb68d',
                            'visited'  => '#4fb68d',
                        )
                    ),
                ),
            );
            $this->sections[] = array(
                'title'     => esc_html__('Social Icons', 'ecolife'),
                'icon'      => 'el-icon-website',
                'fields'     => array(
                    array(
                        'id'       => 'social_icons',
                        'type'     => 'sortable',
                        'title'    => esc_html__('Social Icons', 'ecolife'),
                        'subtitle' => esc_html__('Enter social links', 'ecolife'),
                        'desc'     => esc_html__('Drag/drop to re-arrange', 'ecolife'),
                        'mode'     => 'text',
                        'label'    => true,
                        'options'  => array(
                            'facebook'     => 'Facebook',
                            'twitter'      => 'Twitter',
                            'instagram'    => 'Instagram',
                            'tumblr'       => 'Tumblr',
                            'pinterest'    => 'Pinterest',
                            'google-plus'  => 'Google+',
                            'linkedin'     => 'LinkedIn',
                            'behance'      => 'Behance',
                            'dribbble'     => 'Dribbble',
                            'youtube'      => 'Youtube',
                            'vimeo'        => 'Vimeo',
                            'rss'          => 'Rss',
                        ),
                        'default' => array(
                            'facebook'    => 'www.facebook.com/roadthemes/',
                            'twitter'     => 'www.twitter.com/roadthemes',
                            'instagram'   => 'www.instagram.com',
                            'tumblr'      => '',
                            'pinterest'   => '',
                            'google-plus' => '',
                            'linkedin'    => 'www.linkedin.com/in/kevin-sobo-082878b6',
                            'behance'     => '',
                            'dribbble'    => '',
                            'youtube'     => '',
                            'vimeo'       => '',
                            'rss'         => '',
                        ),
                    ),
                )
            );
            //Fonts
            $this->sections[] = array(
                'title'     => esc_html__('Fonts', 'ecolife'),
                'desc'      => esc_html__('Fonts options', 'ecolife'),
                'icon'      => 'el-icon-font',
                'fields'    => array(

                    array(
                        'id'              => 'bodyfont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Body font', 'ecolife'),
                        'google'          => true,
                        'font-backup'     => false, 
                        'subsets'         => false,
                        'text-align'      => false,
                        'all_styles'      => true, 
                        'units'           => 'px',
                        'subtitle'        => esc_html__('Main body font.', 'ecolife'),
                        'default'         => array(
                            'color'         => '#888888',
                            'font-weight'   => '400',
                            'font-family'   => 'Open Sans',
                            'google'        => true,
                            'font-size'     => '14px',
                        ),
                    ),
                    array(
                        'id'              => 'headingfont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Heading font', 'ecolife'),
                        'google'          => true,
                        'font-backup'     => false,
                        'subsets'         => false,
                        'font-size'       => false,
                        'line-height'     => false,
                        'text-align'      => false,
                        'all_styles'      => true,
                        'units'           => 'px',
                        'subtitle'        => esc_html__('Heading font.', 'ecolife'),
                        'default'         => array(
                            'color'         => '#253237',
                            'font-weight'   => '600',
                            'font-family'   => 'Open Sans',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'menufont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Menu font', 'ecolife'),
                        'google'          => true,
                        'font-backup'     => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        'all_styles'      => true, 
                        'units'           => 'px',
                        'subtitle'        => esc_html__('Menu font.', 'ecolife'),
                        'default'         => array(
                            'color'         => '#253237',
                            'font-weight'   => '700',
                            'font-family'   => 'Open Sans',
                            'font-size'     => '14px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'submenufont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Sub menu font', 'ecolife'),
                        'google'          => true,
                        'font-backup'     => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        'all_styles'      => true,
                        'units'           => 'px',
                        'subtitle'        => esc_html__('sub menu font.', 'ecolife'),
                        'default'         => array(
                            'color'         => '#253237',
                            'font-weight'   => '600',
                            'font-family'   => 'Open Sans',
                            'font-size'     => '14px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'dropdownfont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Dropdown menu font', 'ecolife'),
                        'google'          => true,
                        'font-backup'     => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        'all_styles'      => true,
                        'units'           => 'px',
                        'subtitle'        => esc_html__('Dropdown menu font.', 'ecolife'),
                        'default'         => array(
                            'color'         => '#888888',
                            'font-weight'   => '400',
                            'font-family'   => 'Open Sans',
                            'font-size'     => '14px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'categoriesfont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Category menu font', 'ecolife'),
                        'google'          => true,
                        'font-backup'     => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        'all_styles'      => true,
                        'units'           => 'px',
                        'subtitle'        => esc_html__('Category menu font.', 'ecolife'),
                        'default'         => array(
                            'color'         => '#222222',
                            'font-weight'   => '400',
                            'font-family'   => 'Open Sans',
                            'font-size'     => '14px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'categoriessubmenufont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Category sub menu font', 'ecolife'),
                        'google'          => true,
                        'font-backup'     => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        'all_styles'      => true,
                        'units'           => 'px',
                        'subtitle'        => esc_html__('Category sub menu font.', 'ecolife'),
                        'default'         => array(
                            'color'         => '#999999',
                            'font-weight'   => '400',
                            'font-family'   => 'Open Sans',
                            'font-size'     => '14px',
                            'google'        => true,
                        ),
                    ),
                    array(
                        'id'              => 'pricefont',
                        'type'            => 'typography',
                        'title'           => esc_html__('Price font', 'ecolife'),
                        'google'          => true,
                        'font-backup'     => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'line-height'     => false,
                        'text-align'      => false,
                        'all_styles'      => true,
                        'units'           => 'px',
                        'subtitle'        => esc_html__('Price font.', 'ecolife'),
                        'default'         => array(
                            'color'         => '#555555',
                            'font-weight'   => '400',
                            'font-family'   => 'Open Sans',
                            'font-size'     => '15px', 
                            'google'        => true,
                        ),
                    ),
					
					
                ),
            );
            //Image slider
            $this->sections[] = array(
                'title'     => esc_html__('Image slider', 'ecolife'),
                'desc'      => esc_html__('Upload images and links', 'ecolife'),
                'icon'      => 'el-icon-website',
                'fields'    => array(
                    array(
                        'id'          => 'image_slider',
                        'type'        => 'slides',
                        'title'       => esc_html__('Images', 'ecolife'),
                        'desc'        => esc_html__('Upload images and enter links.', 'ecolife'),
                        'placeholder' => array(
                            'title'           => esc_html__('Title', 'ecolife'),
                            'description'     => esc_html__('Description', 'ecolife'),
                            'url'             => esc_html__('Link', 'ecolife'),
                        ),
                    ),
                ),
            );
            //Brand logos
            $this->sections[] = array(
                'title'     => esc_html__('Brand Logos', 'ecolife'),
                'desc'      => esc_html__('Upload brand logos and links', 'ecolife'),
                'icon'      => 'el-icon-briefcase',
                'fields'    => array(
                    array(
                        'id'          => 'brand_logos',
                        'type'        => 'slides',
                        'title'       => esc_html__('Logos', 'ecolife'),
                        'desc'        => esc_html__('Upload logo image and enter logo link.', 'ecolife'),
                        'placeholder' => array(
                            'title'           => esc_html__('Title', 'ecolife'),
                            'description'     => esc_html__('Description', 'ecolife'),
                            'url'             => esc_html__('Link', 'ecolife'),
                        ),
                    ),
                ),
            );
            // Sidebar
            $this->sections[] = array(
                'title'     => esc_html__('Sidebar', 'ecolife'),
                'desc'      => esc_html__('Sidebar options. Shop/Product sidebar and Blog sidebar are in Product and Blog sections', 'ecolife'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                    array(
                        'id'       => 'sidebarse_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Inner Pages Sidebar Position', 'ecolife'),
                        'subtitle' => esc_html__('Sidebar Position on pages (default pages). If there is no widget in this sidebar, the layout will be nosidebar', 'ecolife'),
                        'options'  => array(
                            'left' => esc_html__('Left', 'ecolife'),
                            'right'=> esc_html__('Right', 'ecolife'),
                        ),
                        'default'  => 'left'
                    ),
                    array(
                        'id'       =>'custom-sidebars',
                        'type'     => 'multi_text',
                        'title'    => esc_html__('Custom Sidebars', 'ecolife'),
                        'subtitle' => esc_html__('Add more sidebars', 'ecolife'),
                        'desc'     => esc_html__('Enter sidebar name (Only allow digits and letters). click Add more to add more sidebar. Edit your page to select a sidebar ', 'ecolife')
                    ),
                ),
            );
            // Product
            $this->sections[] = array(
                'title'     => esc_html__('Product', 'ecolife'),
                'desc'      => esc_html__('Use this section to select options for product', 'ecolife'),
                'icon'      => 'el-icon-tags',
                'fields'    => array(
                    array(
                        'id'        => 'shop_banner',
                        'type'      => 'media',
                        'title'     => esc_html__('Banner image in shop pages', 'ecolife'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload image here.', 'ecolife'),
                    ),
                    array(
                        'id'        => 'show_category_image',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show individual category thumbnail', 'ecolife'),
                        'subtitle'  => esc_html__('Show individual category thumbnail in product shop/product category pages. ', 'ecolife'),
                        'desc'      => esc_html__('If yes, product shop/product category page will display the thumbnail as banner. If no, product shop/product category page will display the shop banner (image uploaded above)', 'ecolife'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'shop_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Shop Layout', 'ecolife'),
                        'subtitle'  => esc_html__('If there is no widget in this sidebar, the layout will be nosidebar', 'ecolife'),
                        'options'   => array(
                            'sidebar'   => esc_html__('Sidebar', 'ecolife'),
                            'fullwidth' => esc_html__('Full Width', 'ecolife'),
                        ),
                        'default'   => 'sidebar',
                    ),
                    array(
                        'id'       => 'sidebarshop_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Shop Sidebar Position', 'ecolife'),
                        'subtitle' => esc_html__('Sidebar Position on shop page.', 'ecolife'),
                        'options'  => array(
                            'left' => esc_html__('Left', 'ecolife'),
                            'right'=> esc_html__('Right', 'ecolife'),
                        ),
                        'default'  => 'left'
                    ),
                    array(
                        'id'        => 'default_view',
                        'type'      => 'select',
                        'title'     => esc_html__('Shop default view', 'ecolife'),
                        'default'   => 'grid-view',
                        'options'   => array(
                            'grid-view' => esc_html__('Grid View', 'ecolife'),
                            'list-view' => esc_html__('List View', 'ecolife'),
                        ),
                    ),
                    array(
                        'id'          => 'product_name_color',
                        'type'        => 'color',
                        'title'       => esc_html__('Product name color', 'ecolife'),
                        'subtitle'    => esc_html__('Select color', 'ecolife'),
                        'transparent' => false,
                        'default'     => '#253237',
                        'validate'    => 'color',
                    ),
                    array(
                        'id'       => 'second_image',
                        'type'     => 'switch',
                        'title'    => esc_html__('Use secondary product image', 'ecolife'),
                        'desc'     => esc_html__('Show the secondary image when hover on product.', 'ecolife'),
                        'default'  => false,
                    ),
                    array(
                        'id'            => 'product_per_page',
                        'type'          => 'slider',
                        'title'         => esc_html__('Products per page', 'ecolife'),
                        'subtitle'      => esc_html__('Amount of products per page in category page', 'ecolife'),
                        "default"       => 12,
                        "min"           => 4,
                        "step"          => 1,
                        "max"           => 20,
                        'display_value' => 'text',
                    ),
                    array(
                        'id'            => 'product_per_row',
                        'type'          => 'slider',
                        'title'         => esc_html__('Product columns', 'ecolife'),
                        'subtitle'      => esc_html__('Amount of product columns in category page', 'ecolife'),
                        'desc'          => esc_html__('Only works with: 1, 2, 3, 4, 6', 'ecolife'),
                        "default"       => 4,
                        "min"           => 1,
                        "step"          => 1,
                        "max"           => 6,
                        'display_value' => 'text',
                    ),
                    array(
                        'id'            => 'product_per_row_fw',
                        'type'          => 'slider',
                        'title'         => esc_html__('Product columns on full width shop', 'ecolife'),
                        'subtitle'      => esc_html__('Amount of product columns in full width category page', 'ecolife'),
                        'desc'          => esc_html__('Only works with: 1, 2, 3, 4, 6', 'ecolife'),
                        "default"       => 4,
                        "min"           => 1,
                        "step"          => 1,
                        "max"           => 6,
                        'display_value' => 'text',
                    ),
                ),
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Product page', 'ecolife' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'single_product_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Single Product Layout', 'ecolife'),
                        'subtitle'  => esc_html__('If there is no widget in this sidebar, the layout will be nosidebar', 'ecolife'),
                        'default'   => 'fullwidth',
                        'options'   => array(
                            'sidebar'   => esc_html__('Sidebar', 'ecolife'),
                            'fullwidth' => esc_html__('Full Width', 'ecolife'),
                        ),
                    ),
                    array(
                        'id'       => 'sidebarsingleproduct_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Single Product Sidebar Position', 'ecolife'),
                        'subtitle' => esc_html__('Sidebar Position on single product page.', 'ecolife'),
                        'options'  => array(
                            'left' => esc_html__('Left', 'ecolife'),
                            'right'=> esc_html__('Right', 'ecolife'),
                        ),
                        'default'  => 'left'
                    ),
                    array(
                        'id'        => 'product_banner',
                        'type'      => 'media',
                        'title'     => esc_html__('Banner image for single product pages', 'ecolife'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload image here.', 'ecolife'),
                    ),
                    array(
                        'id'        => 'single_product_header_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Single Product header text', 'ecolife'),
                        'default'   => esc_html__('Product Details', 'ecolife'),
                    ), 
                    array(
                        'id'        => 'related_product_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related product title', 'ecolife'),
                        'default'   => esc_html__('Related Products', 'ecolife'),
                    ),
					array(
                        'id'        => 'related_product_sub_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related product sub title', 'ecolife'),
                        'default'   => esc_html__('Browse the collection of our related products.', 'ecolife'),
                    ),
                    array(
                        'id'        => 'upsell_product_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Upsell product title', 'ecolife'),
                        'default'   => esc_html__('Upsell Products', 'ecolife'),
                    ),
					array(
                        'id'        => 'upsell_product_sub_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Upsell product sub title', 'ecolife'),
                        'default'   => esc_html__('Browse the collection of our upsell products.', 'ecolife'),
                    ),
                    array(
                        'id'        => 'cross_sell_product_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Cross sell product title', 'ecolife'),
                        'default'   => esc_html__('Cross sell product', 'ecolife'),
                    ),
					array(
                        'id'        => 'crossell_product_sub_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Crossell product sub title', 'ecolife'),
                        'default'   => esc_html__('Browse the collection of our crossell products.', 'ecolife'),
                    ),
                    array(
                        'id'            => 'related_amount',
                        'type'          => 'slider',
                        'title'         => esc_html__('Number of related products', 'ecolife'),
                        "default"       => 10,
                        "min"           => 1,
                        "step"          => 1,
                        "max"           => 16,
                        'display_value' => 'text',
                    ),
                    array(
                        'id'        => 'product_share_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Product share title', 'ecolife'),
                        'default'   => esc_html__('Share this product', 'ecolife'),
                    ),
                )
            );
            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Quick View', 'ecolife' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'quickview_link_text',
                        'type'      => 'text',
                        'title'     => esc_html__('View all features text', 'ecolife'),
                        'desc'      => esc_html__('This is the text on quick view box', 'ecolife'),
                        'default'   => esc_html__('See all features', 'ecolife'),
                    ),
                    array(
                        'id'        => 'quickview',
                        'type'      => 'switch',
                        'title'     => esc_html__('Quick View', 'ecolife'),
                        'desc'      => esc_html__('Show quick view button on all pages', 'ecolife'),
                        'default'   => true,
                    ),
                )
            );
            // Blog options
            $this->sections[] = array(
                'title'     => esc_html__('Blog', 'ecolife'),
                'desc'      => esc_html__('Use this section to select options for blog', 'ecolife'),
                'icon'      => 'el-icon-file',
                'fields'    => array(
                    array(
                        'id'        => 'blog_header_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Blog header text', 'ecolife'),
                        'default'   => esc_html__('Blog', 'ecolife'),
                    ), 
                    array(
                        'id'        => 'blog_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Blog Layout', 'ecolife'),
                        'subtitle'  => esc_html__('If there is no widget in this sidebar, the layout will be nosidebar', 'ecolife'),
                        'options'   => array(
                            'sidebar'       => esc_html__('Sidebar', 'ecolife'),
                            'nosidebar'     => esc_html__('No Sidebar', 'ecolife'),
                            'largeimage'    => esc_html__('Large Image', 'ecolife'),
                            'grid'          => esc_html__('Grid', 'ecolife'),
                        ),
                        'default'   => 'sidebar',
                    ),
                    array(
                        'id'       => 'sidebarblog_pos',
                        'type'     => 'radio',
                        'title'    => esc_html__('Blog Sidebar Position', 'ecolife'),
                        'subtitle' => esc_html__('Sidebar Position on Blog pages.', 'ecolife'),
                        'options'  => array(
                            'left' => esc_html__('Left', 'ecolife'),
                            'right'=> esc_html__('Right', 'ecolife'),
                        ),
                        'default'  => 'right',
                    ),
                    array(
                        'id'        => 'readmore_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Read more text', 'ecolife'),
                        'default'   => esc_html__('Read more', 'ecolife'),
                    ),
                    array(
                        'id'        => 'blog_share_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Blog share title', 'ecolife'),
                        'default'   => esc_html__('Share this post', 'ecolife'),
                    ),
                ),
            );
            // Testimonials options
            $this->sections[] = array(
                'title'     => esc_html__('Testimonials', 'ecolife'),
                'desc'      => esc_html__('Use this section to select options for Testimonials', 'ecolife'),
                'icon'      => 'el-icon-comment',
                'fields'    => array(
                    array(
                        'id'       => 'testiscroll',
                        'type'     => 'switch',
                        'title'    => esc_html__('Auto scroll', 'ecolife'),
                        'default'  => false,
                    ),
                    array(
                        'id'            => 'testipause',
                        'type'          => 'slider',
                        'title'         => esc_html__('Pause in (seconds)', 'ecolife'),
                        'desc'          => esc_html__('Pause time, default value: 3000', 'ecolife'),
                        "default"       => 3000,
                        "min"           => 1000,
                        "step"          => 500,
                        "max"           => 10000,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'            => 'testianimate',
                        'type'          => 'slider',
                        'title'         => esc_html__('Animate in (seconds)', 'ecolife'),
                        'desc'          => esc_html__('Animate time, default value: 2000', 'ecolife'),
                        "default"       => 2000,
                        "min"           => 300,
                        "step"          => 100,
                        "max"           => 5000,
                        'display_value' => 'text'
                    ),
                ),
            );
            // Error 404 page
            $this->sections[] = array(
                'title'     => esc_html__('Error 404 Page', 'ecolife'),
                'desc'      => esc_html__('Error 404 page options', 'ecolife'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                    array(
                        'id'        => 'background_error',
                        'type'      => 'background',
                        'output'    => array('body.error404'),
                        'title'     => esc_html__('Error 404 background', 'ecolife'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'ecolife'),
                        'default'   => array('background-color' => '#ffffff'),
                    ),
                ),
            );
            // Less Compiler
            $this->sections[] = array(
                'title'     => esc_html__('Less Compiler', 'ecolife'),
                'desc'      => esc_html__('Turn on this option to apply all theme options. Turn of when you have finished changing theme options and your site is ready.', 'ecolife'),
                'icon'      => 'el-icon-wrench',
                'fields'    => array(
                    array(
                        'id'        => 'enable_less',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Less Compiler', 'ecolife'),
                        'default'   => true,
                    ),
                ),
            );
            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . esc_html__('<strong>Theme URL:</strong> ', 'ecolife') . '<a href="' . esc_url($this->theme->get('ThemeURI')) . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . esc_html__('<strong>Author:</strong> ', 'ecolife') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . esc_html__('<strong>Version:</strong> ', 'ecolife') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . esc_html__('<strong>Tags:</strong> ', 'ecolife') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';
            $this->sections[] = array(
                'title'     => esc_html__('Import / Export', 'ecolife'),
                'desc'      => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'ecolife'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => esc_html__('Import Export', 'ecolife'),
                        'subtitle'      => esc_html__('Save and restore your Redux options', 'ecolife'),
                        'full_width'    => false,
                    ),
                ),
            );
            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => esc_html__('Theme Information', 'ecolife'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );
        }
        public function setHelpTabs() {
            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => esc_html__('Theme Information 1', 'ecolife'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'ecolife')
            );
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html__('Theme Information 2', 'ecolife'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'ecolife')
            );
            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__('<p>This is the sidebar content, HTML is allowed.</p>', 'ecolife');
        }
        /**
          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {
            $theme = wp_get_theme();
            $this->args = array(
                'opt_name'          => 'ecolife_opt', 
                'display_name'      => $theme->get('Name'),
                'display_version'   => $theme->get('Version'),
                'menu_type'         => 'menu',
                'allow_sub_menu'    => true,
                'menu_title'        => esc_html__('Theme Options', 'ecolife'),
                'page_title'        => esc_html__('Theme Options', 'ecolife'),
                'google_api_key'    => '',
                'async_typography'  => true,
                'disable_google_fonts_link'  => true,
                'admin_bar'         => false,
                'global_variable'   => '',
                'dev_mode'          => false,
                'customizer'        => true,
                'page_priority'     => null,
                'page_parent'       => 'themes.php',
                'page_permissions'  => 'manage_options',
                'menu_icon'         => '',
                'last_tab'          => '',
                'page_icon'         => 'icon-themes',
                'page_slug'         => '_options',
                'save_defaults'     => true,
                'default_show'      => false,
                'default_mark'      => '',
                'show_import_export' => true,
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,
                'output_tag'        => true,
                'database'           => '',
                'system_info'        => false,
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );
            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => esc_html__('Visit us on GitHub', 'ecolife'),
                'icon'  => 'el-icon-github'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => esc_html__('Like us on Facebook', 'ecolife'),
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => esc_html__('Follow us on Twitter', 'ecolife'),
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => esc_html__('Find us on LinkedIn', 'ecolife'),
                'icon'  => 'el-icon-linkedin'
            );
            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
              } else {
            }
        }
    }
    global $reduxConfig;
    $reduxConfig = new ecolife_Theme_Config();
}
/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;
/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = esc_html__('just testing', 'ecolife');
        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;