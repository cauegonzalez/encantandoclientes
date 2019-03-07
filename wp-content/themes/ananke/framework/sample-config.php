<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "theme_option";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'theme_option',
        'use_cdn' => TRUE,
        'display_name'     => $theme->get('Name'),
        'display_version'  => $theme->get('Version'),
        'page_title' => 'Ananke Options',
        'update_notice' => FALSE,
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'Ananke Options',
        'allow_sub_menu' => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'customizer' => FALSE,
        'dev_mode'   => false,
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );    

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'gocargo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'gocargo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'gocargo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'gocargo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'gocargo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    // ACTUAL DECLARATION OF SECTIONS  
    
    Redux::setSection( $opt_name, array(
        'icon' => ' el-icon-stackoverflow',
        'title' => __('Miscellaneous Settings', 'archi'),
        'fields' => array(                    
            array(
                'id'       => 'animate-switch',
                'type'     => 'switch', 
                'title'    => __('Animation Off?', 'archi'),
                'subtitle' => __('Look, it\'s on!', 'archi'),
                'default'  => true,
            ),
            array(
                'id' => 'theme_layout',
                'type' => 'select',
                'title' => __('Layout for all pages.', 'ananke'),
                'subtitle' => __('Select layout', 'ananke'),
                'desc' => __('', 'ananke'),
                'options'  => array(
                    'layout960' => 'Layout 960',
                    'layout1200'  => 'Layout 1200',
                    'layout1320'  => 'Layout 1320',
                ),
                'default' => 'layout960',
            ),                                                 
        )
    ) );
    
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-repeat',
        'title' => __('Preload Settings', 'ananke'),
        'fields' => array(
            array(
                'id' => 'show_pre',
                'type' => 'select',
                'title' => __('Show Preload?', 'ananke'),
                'subtitle' => __('Option Show Preload', 'ananke'),
                'desc' => __('', 'ananke'),
                'options'  => array(
                    'yes' => 'Yes',
                    'no'  => 'No',
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'type_preload',
                'type' => 'select',
                'title' => __('Preload Style?', 'ananke'),
                'subtitle' => __('Option Preload Style.', 'ananke'),
                'desc' => __('Default: Preload Text.', 'ananke'),
                'options'  => array(
                    'preload_text' => 'Preload Text',
                    'preload_logo'  => 'Preload Logo',                            
                ),
                'default' => 'preload_text',
            ),
            array(
                'id' => 'preloadtext',
                'type' => 'text',
                'title' => __('Preload Text', 'ananke'),
                'subtitle' => __('Input Preload Text', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => 'Ananke'
            ),  
            array(
                'id' => 'logo_preload',
                'type' => 'media',
                'url' => true,
                'title' => __('Logo Preload.', 'ananke'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your logo preload', 'ananke'),
                'subtitle' => __('Recommended size: 146px & 80px', 'ananke'),
                'default' => array('url' => get_template_directory_uri().'/images/logo.png'),
            ), 
            array(
                'id' => 'prelogo_width',
                'type' => 'text',
                'title' => __('Fix Width Logo scroll down page, Default: 146', 'ananke'),
                'subtitle' => __('Input Width logo', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => '146'
            ),  
            array(
                'id' => 'prelogo_height',
                'type' => 'text',
                'title' => __('Fix Height Logo scroll down page, Default: 80', 'ananke'),
                'subtitle' => __('Input Height Logo', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => '80'
            ),  
            array(
                'id' => 'bgpreload',
                'type' => 'color',
                'title' => __('Background Preload Color', 'ananke'),
                'subtitle' => __('Pick the Background Preload color for the theme (default: #FFFFFF).', 'ananke'),
                'default' => '#FFFFFF',
                'validate' => 'color',
            ),                      
         )
    ) );
    
    Redux::setSection( $opt_name, array(
        'icon' => ' el-icon-picture',
        'title' => __('Logo & Favicon Settings', 'ananke'),
        'fields' => array(
            array(
                'id' => 'favicon',
                'type' => 'media',
                'url' => true,
                'title' => __('Custom Favicon', 'ananke'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Favicon.', 'ananke'),
                'subtitle' => __('', 'ananke'),
                'default' => array('url' => get_template_directory_uri().'/images/favicon.png'),
            ),
            array(
                'id' => 'logo',
                'type' => 'media',
                'url' => true,
                'title' => __('Logo', 'ananke'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your logo.', 'ananke'),
                'subtitle' => __('Recommended size: Max-Height: 92px and Max-Width: 250px', 'ananke'),
                'default' => array('url' => get_template_directory_uri().'/images/logo.png'),
            ),
            array(
                'id' => 'logo_width',
                'type' => 'text',
                'title' => __('Fix Width Logo, Default: 146px', 'ananke'),
                'subtitle' => __('Input Width logo', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => '146px'
            ),  
            array(
                'id' => 'logo_height',
                'type' => 'text',
                'title' => __('Fix Height Logo, Default: 80px', 'ananke'),
                'subtitle' => __('Input Height Logo', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => '80px'
            ),                     
            array(
                'id' => 'logo_scroll',
                'type' => 'media',
                'url' => true,
                'title' => __('Logo Scroll Down.', 'ananke'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your logo scroll down..', 'ananke'),
                'subtitle' => __('Recommended size: Max-Height: 70px and Width: 200px', 'ananke'),
                'default' => array('url' => get_template_directory_uri().'/images/logo.png'),
            ), 
            array(
                'id' => 'logo_widths',
                'type' => 'text',
                'title' => __('Fix Width Logo scroll down page, Default: 116px', 'ananke'),
                'subtitle' => __('Input Width logo', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => '116px'
            ),  
            array(
                'id' => 'logo_heights',
                'type' => 'text',
                'title' => __('Fix Height Logo scroll down page, Default: 60px', 'ananke'),
                'subtitle' => __('Input Height Logo', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => '60px'
            ),  
            array(
                'id' => 'logo_margin_top',
                'type' => 'text',
                'title' => __('Margin Top for logo.', 'ananke'),
                'subtitle' => __('Input Margin Top number.', 'ananke'),
                'desc' => __('Ex: 10px', 'ananke'),
                'default' => '10px'
            ),   

            array(
                'id' => 'logo_width_mobile',
                'type' => 'text',
                'title' => __('Fix Width Logo on mobile devices, Default: 80px', 'ananke'),
                'subtitle' => __('Input Width logo', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => '80'
            ),  
            array(
                'id' => 'logo_height_mobile',
                'type' => 'text',
                'title' => __('Fix Height Logo on mobile devices, Default: 50px', 'ananke'),
                'subtitle' => __('Input Height Logo', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => '50px'
            ),  

            array(
                'id' => 'apple_icon',
                'type' => 'media',
                'url' => true,
                'title' => __('Apple Touch Icon 57x57', 'ananke'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Apple touch icon 57x57.', 'ananke'),
                'subtitle' => __('', 'ananke'),
                'default' => array('url' => get_template_directory_uri().'/images/apple-touch-icon.png'),
            ),                  
            array(
                'id' => 'apple_icon_72',
                'type' => 'media',
                'url' => true,
                'title' => __('Apple Touch Icon 72x72', 'ananke'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Apple touch icon 72x72.', 'ananke'),
                'subtitle' => __('', 'ananke'),
                'default' => array('url' => get_template_directory_uri().'/images/apple-touch-icon-72x72.png'),
            ),
            array(
                'id' => 'apple_icon_114',
                'type' => 'media',
                'url' => true,
                'title' => __('Apple Touch Icon 114x114', 'ananke'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Apple touch icon 114x114.', 'ananke'),
                'subtitle' => __('', 'ananke'),
                'default' => array('url' => get_template_directory_uri().'/images/apple-touch-icon-114x114.png'),
            ),                  
        )
    ) );

    Redux::setSection( $opt_name, array(
        'icon' => ' el-icon-credit-card',
        'title' => __('Header Settings', 'ananke'),
        'fields' => array(  
            array(
                'id' => 'colormenu',
                'type' => 'color',
                'title' => __('Menu Item Color', 'ananke'),
                'subtitle' => __('Pick the menu item color for the theme (default: #000000).', 'ananke'),
                'default' => '#000000',
                'validate' => 'color',
            ),
            array(
                'id' => 'bgheader',
                'type' => 'color',
                'title' => __('Background Header Static Color', 'ananke'),
                'subtitle' => __('Pick the Background Header color for the theme (default: rgba(250,250,250,.9)).', 'ananke'),
                'default' => 'rgba(250,250,250,.9)',
                'validate' => 'color',
            ),
            array(
                'id' => 'colormenu_scroll',
                'type' => 'color',
                'title' => __('Menu Item Scroll Color', 'ananke'),
                'subtitle' => __('Pick the menu item scroll color for the theme (default: #000000).', 'ananke'),
                'default' => '#000000',
                'validate' => 'color',
            ),                                          
            array(
                'id' => 'bgheader_scroll',
                'type' => 'color',
                'title' => __('Background Header Scroll Color', 'ananke'),
                'subtitle' => __('Pick the Background Header Scroll color for the theme (default: rgba(250,250,250,.9)).', 'ananke'),
                'default' => 'rgba(250,250,250,1)',
                'validate' => 'color',
            ),     
        )
    ) );

    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-font',
        'title' => __('Typography', 'ananke'),
        'fields' => array(
            array(
                'id' => 'h1-typography',
                'type' => 'typography',
                'output' => array('h1'),
                'title' => __('Heading 1', 'ananke'),
                'subtitle' => __('Specify the heading 1 font properties.', 'ananke'),
                'google' => true,
                'default' => array(
                    'color'       => '', 
                    'font-style'  => '', 
                    'font-family' => '',
                    'font-size'   => '', 
                    'line-height' => ''
                ),
            ),   
            array(
                'id' => 'h2-typography',
                'type' => 'typography',
                'output' => array('h2'),
                'title' => __('Heading 2', 'ananke'),
                'subtitle' => __('Specify the heading 2 font properties.', 'ananke'),
                'google' => true,
                'default' => array(
                    'color'       => '', 
                    'font-style'  => '', 
                    'font-family' => '',
                    'font-size'   => '', 
                    'line-height' => ''
                ),
            ), 
            array(
                'id' => 'h3-typography',
                'type' => 'typography',
                'output' => array('h3'),
                'title' => __('Heading 3', 'ananke'),
                'subtitle' => __('Specify the heading 3 font properties.', 'ananke'),
                'google' => true,
                'default' => array(
                    'color'       => '', 
                    'font-style'  => '', 
                    'font-family' => '',
                    'font-size'   => '', 
                    'line-height' => ''
                ),
            ), 
            array(
                'id' => 'h4-typography',
                'type' => 'typography',
                'output' => array('h4'),
                'title' => __('Heading 4', 'ananke'),
                'subtitle' => __('Specify the heading 4 font properties.', 'ananke'),
                'google' => true,
                'default' => array(
                    'color'       => '', 
                    'font-style'  => '', 
                    'font-family' => '',
                    'font-size'   => '', 
                    'line-height' => ''
                ),
            ), 
            array(
                'id' => 'h5-typography',
                'type' => 'typography',
                'output' => array('h5'),
                'title' => __('Heading 5', 'ananke'),
                'subtitle' => __('Specify the heading 5 font properties.', 'ananke'),
                'google' => true,
                'default' => array(
                    'color'       => '', 
                    'font-style'  => '', 
                    'font-family' => '',
                    'font-size'   => '', 
                    'line-height' => ''
                ),
            ), 
            array(
                'id' => 'h6-typography',
                'type' => 'typography',
                'output' => array('h6'),
                'title' => __('Heading 6', 'ananke'),
                'subtitle' => __('Specify the heading 6 font properties.', 'ananke'),
                'google' => true,
                'default' => array(
                    'color'       => '', 
                    'font-style'  => '', 
                    'font-family' => '',
                    'font-size'   => '', 
                    'line-height' => ''
                ),
            ),    
            array(
                'id' => 'menu-typography',
                'type' => 'typography',
                'output' => array('ul.slimmenu li a'),
                'title' => __('Menu item', 'ananke'),
                'subtitle' => __('Specify the Menu item font properties.', 'ananke'),
                'google' => true,
                'default' => array(
                    'color'       => '', 
                    'font-style'  => '', 
                    'font-family' => '',
                    'font-size'   => '', 
                    'line-height' => '',
                ),
            ),                                   
        )
    ) );

    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-blogger',
        'title' => __('Blog Settings', 'ananke'),
        'fields' => array(
            array(
                'id'       => 'blog_layout',
                'type'     => 'image_select',
                'title'    => __( 'Blog Layout', 'ananke' ),
                'subtitle' => __( 'Click on image layout to chooise', 'ananke' ),
                'desc'     => __( 'Select layout you want use for all your blog page.', 'ananke' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    'fw' => array(
                        'alt' => '1 Column',
                        'img' => get_template_directory_uri().'/images/theme-options/1c.png'
                    ),                    
                    'wsbl' => array(
                        'alt' => '2 Column Left',
                        'img' => get_template_directory_uri().'/images/theme-options/2cl.png'
                    ),    
                    'wsb' => array(
                        'alt' => '2 Column Right',
                        'img' => get_template_directory_uri().'/images/theme-options/2cr.png'
                    ),                                 
                ),
                'default'  => 'wsb'
            ),

            array(
                'id' => 'blog_title',
                'type' => 'text',
                'title' => __('Blog Title', 'ananke'),
                'subtitle' => __('Input Blog Title', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => 'the blog'
            ),      
            array(
                'id' => 'blog_subtitle',
                'type' => 'text',
                'title' => __('Blog Subtitle', 'ananke'),
                'subtitle' => __('Input Blog Subtitle', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => 'Latest news.'
            ),  
            array(
                'id' => 'blog_excerpt',
                'type' => 'text',
                'title' => __('Blog custom excerpt leng', 'ananke'),
                'subtitle' => __('Input Blog custom excerpt leng', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => '30'
            ),  
            array(
                'id' => 'read_more',
                'type' => 'text',
                'title' => __('Button Text For Post', 'ananke'),
                'subtitle' => __('Input Button Text', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => 'Read more'
            ),
            array(
                'id' => 'blog_thumbnail',
                'type' => 'media',
                'url' => true,
                'title' => __('Blog Background Top Page', 'ananke'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Blog Background Top Page.', 'ananke'),
                'subtitle' => __('', 'ananke'),
                'default' => array('url' => get_template_directory_uri().'/images/parallax/blog.jpg'),
            ),
         )
    ) );

    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-briefcase',
        'title' => __('Portfolio Settings', 'ananke'),
        'fields' => array(  
            array(
                'id' => 'portfolio_live',
                'type' => 'text',
                'title' => __('Text Link Out Project', 'ananke'),
                'subtitle' => __('Text Link Out Project', 'ananke'),
                'default' => 'view live'
            ),
            array(
                'id' => 'archive_portfolio_thumbnail',
                'type' => 'media',
                'url' => true,
                'title' => __('Archive Background Top Page', 'ananke'),
                'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Upload your Archive Background Top Page.', 'ananke'),
                'default' => array('url' => get_template_directory_uri().'/images/parallax/blog.jpg'),
            ),
            array(
                'id' => 'archive_title',
                'type' => 'text',
                'title' => __('Archive Portfolio Page Title', 'ananke'),
                'subtitle' => __('Archive portfolio page tilte', 'ananke'),
                'default' => 'Work'
            ),  
            array(
                'id' => 'archive_stitle',
                'type' => 'text',
                'title' => __('Archive Portfolio Page Sub Title', 'ananke'),
                'subtitle' => __('Archive portfolio page sub tilte', 'ananke'),
                'default' => 'We believe our work speaks for itself. Browse our most recent projects below.'
            ), 
            array(
                'id' => 'archive_number',
                'type' => 'text',
                'title' => __('Number show post', 'ananke'),
                'subtitle' => __('Number show post per page on Archive Portfolio Page.', 'ananke'),
                'default' => 8,
            ),
            array(
                'id' => 'archive_showall',
                'type' => 'text',
                'title' => __('Text filter: Show All', 'ananke'),
                'subtitle' => __('Text button filter on Archive Portfolio Page: Show All', 'ananke'),
                'default' => 'Show All'
            ),                                         
         )
    ) );
    
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-graph',
        'title' => __('404 Settings', 'ananke'),
        'fields' => array(
             array(
                'id' => '404_title',
                'type' => 'text',
                'title' => __('404 Title', 'ananke'),
                'subtitle' => __('Input 404 Title', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => '404'
            ),                              
             array(
                'id' => '404_content',
                'type' => 'editor',
                'title' => __('404 Content', 'ananke'),
                'subtitle' => __('Enter 404 Content', 'ananke'),
                'desc' => __('', 'ananke'),
                'default' => 'The page you are looking for no longer exists. Perhaps you can return back to the sites homepage see you can find what you are looking for.'
            ),      
            array(
                'id' => 'back_404',
                'type' => 'text',
                'title' => __('Button Back Home', 'ananke'),                        
                'desc' => __('Text Button Go To Home.', 'ananke'),
                'subtitle' => __('', 'ananke'),
                'default' => 'Back To Home',
            ),                  
         )
    ) );

    Redux::setSection( $opt_name, array(
        'icon' => ' el-icon-credit-card',
        'title' => __('Footer Settings', 'ananke'),
        'fields' => array(  
            array(
                'id' => 'background_footer',
                'type' => 'color',
                'title' => __('Footer Background Color', 'ananke'),
                'subtitle' => __('Pick a background color for the footer (default: #151515).', 'ananke'),
                'default' => '#151515',
                'validate' => 'color',
            ),
            array(
                'id' => 'color_footer',
                'type' => 'color',
                'title' => __('Footer  Color', 'ananke'),
                'subtitle' => __('Pick a  color for the footer (default: #fff).', 'ananke'),
                'default' => '#fff',
                'validate' => 'color',
            ),                    
            array(
                'id' => 'footer_text',
                'type' => 'editor',
                'title' => __('Footer Text', 'ananke'),
                'subtitle' => __('Copyright Text', 'ananke'),
                'default' => '©2016 ALL RIGHT RESERVED. DESIGNED BY IG DESIGN',
            ),
                    
        )
    ) );      
    
    Redux::setSection( $opt_name, array(
        'icon' => 'el-icon-website',
        'title' => __('Styling Options', 'ananke'),
        'fields' => array(
            array(
                'id' => 'theme_style',
                'type' => 'select',
                'title' => __('Theme Style', 'ananke'),
                'subtitle' => __('Select Theme Style : Dark Or Light', 'ananke'),
                'desc' => __('Use Style Dark Or Style Light for full website.', 'ananke'),
                'options'  => array(
                    'light' => 'Theme Style Light',
                    'dark' => 'Theme Style Dark',                            
                ),
                'default' => 'light',
            ),
            array(
                'id' => 'main-color',
                'type' => 'color',
                'title' => __('Theme Main Color', 'ananke'),
                'subtitle' => __('Pick the main color for the theme (default: #cfa144).', 'ananke'),
                'default' => '#cfa144',
                'validate' => 'color',
            ),  
            array(
                'id' => 'body-font2',
                'type' => 'typography',
                'output' => array('body'),
                'title' => __('Body Font', 'ananke'),
                'subtitle' => __('Specify the body font properties.', 'ananke'),
                'google' => true,
                'default' => array(
                    'color' => '',
                    'font-size' => '',
                    'line-height' => '',
                    'font-family' => '',
                    'font-weight' => ''
                ),
            ),
             array(
                'id' => 'custom-css',
                'type' => 'ace_editor',
                'title' => __('CSS Code', 'ananke'),
                'subtitle' => __('Paste your CSS code here.', 'ananke'),
                'mode' => 'css',
                'theme' => 'monokai',
                'desc' => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                'default' => "#header{\nmargin: 0 auto;\n}"
            ),
        )
    ) );

    /*
     * <--- END SECTIONS
     */
