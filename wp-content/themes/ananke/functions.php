<?php
/**
 * Redux Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ananke
 */

if ( ! class_exists( 'ReduxFramewrk' ) ) {
    require_once( get_template_directory() . '/framework/sample-config.php' );
	function removeDemoModeLink() { // Be sure to rename this function to something more unique
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
		}
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
		}
	}
	add_action('init', 'removeDemoModeLink');
}

//Custom fields:
require_once get_template_directory() . '/framework/bfi_thumb-master/BFI_Thumb.php';
require_once get_template_directory() . '/framework/Custom-Metaboxes/metabox-functions.php';
require_once get_template_directory() . '/shortcodes.php';
require_once get_template_directory() . '/framework/wp_bootstrap_navwalker.php';

//Theme Set up:
function ananke_theme_setup() {
	if ( ! isset( $content_width ) ) { 
		$content_width = 900;
	}
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cubic, use a find and replace
	 * to change 'cubic' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ananke', get_template_directory() . '/languages' );

    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
	add_theme_support( 'custom-header' ); 
	add_theme_support( 'custom-background' );
	add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );
    // Switches default core markup for search form, comment form, and comments
    // to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
    //Post formats
    add_theme_support( 'post-formats', array(
        'audio',  'gallery', 'image', 'quote', 'video'
    ) );
    // This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'   => __('Menu Home <b>Only Use For Home Page</b>', 'ananke'),		
		'secondary' => __('Menu Pages <b>Only Use For All Other Pages</b>', 'ananke'),
	) );
    // This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
    add_shortcode('gallery', '__return_false');
}
add_action( 'after_setup_theme', 'ananke_theme_setup' );

function ananke_theme_scripts_styles() {
	global $theme_option;
	$protocol = is_ssl() ? 'https' : 'http';
  
	wp_enqueue_style( 'fonts-Montserrat', "$protocol://fonts.googleapis.com/css?family=Montserrat:400,700", true);
	wp_enqueue_style( 'fonts-Lato', "$protocol://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic", true);
	wp_enqueue_style( 'fonts-Open+Sans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800", true);
	wp_enqueue_style( 'fonts-Open+Sans+subset', "$protocol://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic", true);
	wp_enqueue_style( 'fonts-Satisfy', "$protocol://fonts.googleapis.com/css?family=Satisfy", true);

	wp_enqueue_style( 'ananke-base', get_template_directory_uri().'/css/base.css');
	if (isset($theme_option['theme_layout']) and $theme_option['theme_layout'] == 'layout1320') {
		wp_enqueue_style( 'ananke-skeleton', get_template_directory_uri().'/css/skeleton-1320.css');
	}elseif (isset($theme_option['theme_layout']) and $theme_option['theme_layout'] == 'layout1200') {
		wp_enqueue_style( 'ananke-skeleton', get_template_directory_uri().'/css/skeleton-1200.css');
	}else{
		wp_enqueue_style( 'ananke-skeleton', get_template_directory_uri().'/css/skeleton-960.css');
	}
	
	wp_enqueue_style( 'ananke-style', get_stylesheet_uri(), array(), '2014-11-11' );

	if($theme_option['show_pre'] != 'no') { 
		if (isset($theme_option['type_preload']) and $theme_option['type_preload'] == 'preload_logo') { 
			wp_enqueue_style( 'preload-logo', get_template_directory_uri().'/css/preload-logo.css');
		}else{ 
			wp_enqueue_style( 'preload-text', get_template_directory_uri().'/css/preload-text.css');
		} 	
	}

	wp_enqueue_style( 'ananke-font-awesome', get_template_directory_uri().'/css/css/font-awesome.css');
	wp_enqueue_style( 'ananke-flat', get_template_directory_uri().'/css/flat_filled_styles.css');
	wp_enqueue_style( 'ananke-fancybox', get_template_directory_uri().'/css/jquery.fancybox.css');
	wp_enqueue_style( 'ananke-retina', get_template_directory_uri().'/css/retina.css');
	
	// Style Dark color for Skill Dark
	if (isset($theme_option['theme_style']) and $theme_option['theme_style'] != 'light') {
		wp_enqueue_style( 'dark-color', get_template_directory_uri().'/css/dark.css');
	}
	
	wp_enqueue_style( 'color', get_template_directory_uri().'/framework/color.php');
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
		wp_enqueue_script( 'comment-reply' );
	}
			
	wp_enqueue_script("ananke-modernizr", get_template_directory_uri()."/js/modernizr.custom.js",array( 'jquery' ), '20160621', false);
	if($theme_option['show_pre'] != 'no') { 
		wp_enqueue_script("preloader", get_template_directory_uri()."/js/royal_preloader.min.js",array( 'jquery' ), '20160621', false);
	}
	wp_enqueue_script("ananke-classie", get_template_directory_uri()."/js/classie.js",array( 'jquery' ), '20160621', true);
	wp_enqueue_script("ananke-cbpAnimatedHeader", get_template_directory_uri()."/js/cbpAnimatedHeader.min.js",array( 'jquery' ), '20160621', true);
	wp_enqueue_script("ananke-retina-js", get_template_directory_uri()."/js/retina-1.1.0.min.js",array( 'jquery' ), '20160621', true);
	wp_enqueue_script("ananke-easing", get_template_directory_uri()."/js/jquery.easing.js",array( 'jquery' ), '20160621', true);
	wp_enqueue_script("ananke-flippy", get_template_directory_uri()."/js/flippy.js",array( 'jquery' ), '20160621', true);
	if(is_page_template('page-templates/template-canvas.php') ){
		wp_enqueue_script("ananke-tiltSlider", get_template_directory_uri()."/js/tiltSlider.js",array( 'jquery' ), '20160621', false);
	}		
	wp_enqueue_script("ananke-flexslider", get_template_directory_uri()."/js/jquery.flexslider-min.js",array( 'jquery' ), '20160621', true);
	wp_enqueue_script("ananke-parallax", get_template_directory_uri()."/js/jquery.parallax-1.1.3.js",array( 'jquery' ), '20160621', true);
	wp_enqueue_script("ananke-scroll", get_template_directory_uri()."/js/jquery.localscroll-1.2.7-min.js",array( 'jquery' ), '20160621', true);
	wp_enqueue_script("ananke-scrollTo", get_template_directory_uri()."/js/jquery.scrollTo-1.4.2-min.js",array( 'jquery' ), '20160621', true);
	wp_enqueue_script("ananke-fancybox-js", get_template_directory_uri()."/js/jquery.fancybox.js",array( 'jquery' ), '20160621', true);
	wp_enqueue_script("ananke-flat-js", get_template_directory_uri()."/js/svg_inject_flat_icons_filled.js",array( 'jquery' ), '20160621', true);
	wp_enqueue_script("ananke-mapapi", "$protocol://maps.googleapis.com/maps/api/js?key=AIzaSyAvpnlHRidMIU374bKM5-sx8ruc01OvDjI",array( 'jquery' ), '20160621', false);
	wp_enqueue_script("ananke-plugins", get_template_directory_uri()."/js/plugins.js",array( 'jquery' ), '20160621', true);
	if($theme_option['animate-switch'] == true){
		wp_enqueue_script("ananke-scrollReveal", get_template_directory_uri()."/js/scrollReveal.js",array( 'jquery' ), '20160621', true);
	}	
	wp_enqueue_script("ananke-fitvids", get_template_directory_uri()."/js/jquery.fitvids.js",array( 'jquery' ), '20160621', true);
	wp_enqueue_script("ananke-malihu", get_template_directory_uri()."/js/jquery.malihu.PageScroll2id.js",array( 'jquery' ), '20160621', true);	
	wp_enqueue_script("ananke-template", get_template_directory_uri()."/js/template.js",array( 'jquery' ), '20160621', true); 
}
add_action( 'wp_enqueue_scripts', 'ananke_theme_scripts_styles');

// Add a class from the body_class array.
function ananke_body_classes( $classes ) {
	global $theme_option;
	if($theme_option['show_pre'] != 'no') {
   		$classes[] = 'royal_loader';
    } 
    return $classes;
}
add_filter( 'body_class','ananke_body_classes' );

// Add custom css code
if(!function_exists('ananke_custom_frontend_style')){
	function ananke_custom_frontend_style(){
		global $theme_option;
		echo '<style type="text/css">'.$theme_option['custom-css'].'</style>';
	}
}
add_action('wp_head', 'ananke_custom_frontend_style');

// Custom javascript code
if(!function_exists('ananke_custom_frontend_scripts')){
	function ananke_custom_frontend_scripts(){
		global $theme_option;		
		if($theme_option['show_pre'] != 'no') { 	
		?>
			<script type="text/javascript">
				window.jQuery = window.$ = jQuery;	
				(function($) { "use strict";				
					<?php if ($theme_option['type_preload'] == 'preload_logo') { ?>
						Royal_Preloader.config({
							mode:           'logo', // 'number', "text" or "logo"
							logo:           '<?php echo esc_url($theme_option['logo_preload']['url']); ?>',
							timeout:        0,
							showInfo:       false,
							opacity:        1,
							background:     ['<?php echo esc_attr($theme_option['bgpreload']); ?>']
						});
					<?php }else{ ?>
						Royal_Preloader.config({
						  mode:           'text', // 'number', "text" or "logo"
						  text:           '<?php echo esc_attr($theme_option['preloadtext']); ?>',
						  timeout:        0,
						  showInfo:       true,
						  opacity:        1,
						  background:     ['<?php echo esc_attr($theme_option['bgpreload']); ?>']
						});
					<?php } ?>	
				})(jQuery);
			</script>
		<?php
		}
	}
}
add_action('wp_footer', 'ananke_custom_frontend_scripts');

// Widget Sidebar
function ananke_widgets_init() {
	register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'ananke' ),
        'id'            => 'sidebar-1',        
		'description'   => __( 'Appears in the sidebar section of the site.', 'ananke' ),        
		'before_widget' => '<div id="%1$s" class="widget %2$s">',        
		'after_widget'  => '</div>',        
		'before_title'  => '<h6>',        
		'after_title'   => '</h6>'
    ) );
}
add_action( 'widgets_init', 'ananke_widgets_init' );

//function tag widgets
function ananke_tag_cloud_widget($args) {
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 11; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	$args['exclude'] = array(20, 80, 92); //exclude tags by ID
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'ananke_tag_cloud_widget' );

// Excerpt Section Blog Post
function ananke_blog_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

//pagination
function ananke_pagination($prev = '<i class="fa fa-chevron-left"></i>', $next = '<i class="fa fa-chevron-right"></i>', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
		'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $pages,
		'prev_text' => $prev,
        'next_text' => $next,		
        'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
);
    $return =  paginate_links( $pagination );
	echo str_replace( "<ul class='page-numbers'>", '<ul>', $return );
}

function ananke_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="search_form" action="' . home_url( '/' ) . '" >  
    	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'. __( 'Search the site...', 'ananke' ) .'" />
    	<input type="submit" class="search_btn" id="searchsubmit" value="'. __( 'Search', 'ananke' ) .'" />    
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'ananke_search_form' );

//Custom comment List:
function ananke_theme_comment($comment, $args, $depth) {    
   $GLOBALS['comment'] = $comment; ?>
   <div class="post-down">
		<div class="rpl-but"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div> 
		<?php echo get_avatar($comment,$size='100',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=70' ); ?>
		<h6><?php printf( '%s', get_comment_author_link()) ?> <span>on <?php $d = "F j, Y \A\T h a"; printf(get_comment_date($d)) ?></span></h6>
		<?php if ($comment->comment_approved == '0'){ ?>
			 <p><em><?php _e('Your comment is awaiting moderation.','ananke') ?></em></p>
		<?php }else{ ?>
        <?php comment_text() ?>
		<?php } ?>
	<div class="clearfix"></div>	
	</div> 
<?php
}

//Code Visual Compurso.
require_once dirname( __FILE__ ) . '/vc_shortcode.php';
//if(class_exists('WPBakeryVisualComposerSetup')){
function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
    if($tag=='vc_row' || $tag=='vc_row_inner') {
        $class_string = str_replace('vc_row-fluid', '', $class_string);
    }
    if($tag=='vc_column' || $tag=='vc_column_inner') {
		$class_string = preg_replace('/vc_col-sm-1/', 'one columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-2/', 'two columns', $class_string);		
		$class_string = preg_replace('/vc_col-sm-3/', 'three columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-4/', 'four columns', $class_string);		
		$class_string = preg_replace('/vc_col-sm-5/', 'five columns ', $class_string);
		$class_string = preg_replace('/vc_col-sm-6/', 'six columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-7/', 'seven columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-8/', 'eight columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-9/', 'nine columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-10/', 'ten columns', $class_string);
		$class_string = preg_replace('/vc_col-sm-11/', 'eleven columns', $class_string);	
		$class_string = preg_replace('/vc_col-sm-12/', 'twelve columns', $class_string);
    }
    return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2); 
// Add new Param in Row
if(function_exists('vc_add_param')){
vc_add_param('vc_row',array(
                              "type" => "textfield",
                              "heading" => __('Extra id name', 'wpb'),
                              "param_name" => "extra_id",
                              "value" => "",
                              "description" => __("If you wish to style particular content element differently, then use this field to add a id name and then refer to it in your css file.", "wpb"),   
    ));
vc_add_param('vc_row',array(
                              "type" => "textfield",
                              "heading" => __('Section Title', 'wpb'),
                              "param_name" => "ses_title",
                              "value" => "",
                              "description" => __("Title of Section, Leave a blank do not show front-end.", "wpb"),   
    ));	
vc_add_param('vc_row',array(
                              "type" => "textarea",
                              "heading" => __('Section Sub Title', 'wpb'),
                              "param_name" => "ses_sub_title",
                              "value" => "",
                              "description" => __("Sub Title of Section, Leave a blank do not show front-end.", "wpb"),   
    ));
vc_add_param('vc_row',array(
                              "type" => "dropdown",
                              "heading" => __('Overlay Pattern', 'wpb'),
                              "param_name" => "wrap_class",
                              "value" => array(   
                                                __('No', 'wpb') => 'no',  
                                                __('Yes', 'wpb') => 'yes',                                                                                
                                              ),
                              "description" => __("Container Class", "wpb"),   
    ));
vc_add_param('vc_row',array(
                              "type" => "dropdown",
                              "heading" => __('Fullwidth', 'wpb'),
                              "param_name" => "fullwidth",
                              "value" => array(   
                                                __('No', 'wpb') => 'no',  
                                                __('Yes', 'wpb') => 'yes',                                                                                
                                              ),
                              "description" => __("Select Fullwidth or not, Default: No fullwidth", "wpb"),      
                            ) 
    );
	
// Add new Param in Column	
vc_add_param('vc_column',array(
                              "type" => "textfield",
                              "heading" => __('Column Title', 'wpb'),
                              "param_name" => "title",
                              "value" => "",
                              "description" => __("Title of column", "wpb"),      
                            ) 
    );
vc_add_param('vc_column',array(
                              "type" => "textfield",
                              "heading" => __('Container Class', 'wpb'),
                              "param_name" => "wap_class",
                              "value" => "",
                              "description" => __("Container Class", "wpb"),      
                            ) 
    );
vc_add_param('vc_column',array(
                              "type" => "textfield",
                              "heading" => __('Container id', 'wpb'),
                              "param_name" => "wap_id",
                              "value" => "",
                              "description" => __("Container ID, Only use for content slider.", "wpb"),      
                            ) 
    );	
vc_add_param('vc_column',array(
                              "type" => "dropdown",
                              "heading" => __('Column Effect', 'wpb'),
                              "param_name" => "column_effect",
                              "value" => array(    
                              					__('None', 'wpb') => 'none', 
                                                __('Bottom Move', 'wpb') => 'bottommove',     
												__('Top Move', 'wpb') => 'topmove', 													
                                              ),
                              "description" => __("Select Effect for column, Default: Move Bottom", "wpb"),      
                            ) 
    );	
	// Remove some param in Row   	
	vc_remove_param( "vc_row", "el_id" );
	vc_remove_param( "vc_row", "parallax" );
	vc_remove_param( "vc_row", "parallax_image" );
	vc_remove_param( "vc_row", "full_width" );
	vc_remove_param( "vc_row", "full_height" );
	vc_remove_param( "vc_row", "video_bg" );
	vc_remove_param( "vc_row", "video_bg_parallax" );
	//vc_remove_param( "vc_row", "content_placement" );
	vc_remove_param( "vc_row", "video_bg_url" );
	vc_remove_param( "vc_row", "parallax_speed_bg" );
	vc_remove_param( "vc_row", "parallax_speed_video" );
	//vc_remove_param( "vc_row", "equal_height" );
	vc_remove_param( "vc_row", "columns_placement" );
	vc_remove_param( "vc_row", "gap" );

	// Remove some param in Column  
	vc_remove_param( "vc_column", "offset" );
	vc_remove_param( "vc_column", "css_animation" );

}
//}


require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'ananke_register_required_plugins' );
function ananke_register_required_plugins() {
	$plugins = array(
		// This is an example of how to include a plugin from the WordPress Plugin Repository.				
		array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
        ),	        
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),		
		array(            
			'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => 'http://oceanthemes.net/plugins-required/js_composer.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),         
        array(            
            'name'               => 'Slider Revolution', // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => 'http://oceanthemes.net/plugins-required/revslider.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),         
        array(            
            'name'               => 'One Click Import Demo', // The plugin name.
            'slug'               => 'ot-themes-one-click-import', // The plugin slug (typically the folder name).
            'source'             => 'http://oceanthemes.net/plugins-required/ananke/ot-themes-one-click-import.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ), 	
        array(            
            'name'               => 'OT Portfolios', // The plugin name.
            'slug'               => 'ot_portfolio', // The plugin slug (typically the folder name).
            'source'             => 'http://oceanthemes.net/plugins-required/ananke/ot_portfolio.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ), 
        array(            
            'name'               => 'OT Slide Show', // The plugin name.
            'slug'               => 'ot_slide_show', // The plugin slug (typically the folder name).
            'source'             => 'http://oceanthemes.net/plugins-required/ananke/ot_slide_show.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ), 		
	);
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

?>