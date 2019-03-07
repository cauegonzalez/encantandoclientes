<?php
########################################################################################################################
# Welcome to "Hypnos" theme!
#=======================================================================================================================
# thank you for purchasing. This is a functions.php file. Here you can find any
# theme specific functions ( for example ajax calls, custom post types and
# other things ). Most of the other functions are located in our plugin
# Fresh Framework, which has to be activated in order to run this template
# without any problems.
########################################################################################################################
#																			                                           #
#																			                                           #
#																			                                           #
########################################################################################################################
# Framework Initialisation
#=======================================================================================================================
# this code initialise our fresh framework plugin. If the plugin is not
# presented, we run automatic installation which will result in installing
# and activating the plugin. Please do not change the framework initialisation ( lines 22 - 43 ), its complex
# and there is nothing you can gain by changing this
########################################################################################################################
require_once "install/install-plugins-by-tgm.php";

if ( ! isset( $content_width ) ) $content_width = 900;

require 'install/init.php';

if ( !class_exists('ffFrameworkVersionManager') && !is_admin() ) {
	echo '<span style="color:red; font-size:50px;">';
		echo 'The Fresh Framework plugin must be installed and activated in order to use this theme.';
	echo '</span>';
	die();
} else if( !class_exists('ffFrameworkVersionManager') && is_admin() ) {
	if( !function_exists('ff_plugin_fresh_framework_notification') ) {
		function ff_plugin_fresh_framework_notification() {
			?>
		    <div class="error">
		    <p><strong><em>Fresh</strong></em> plugins require the <strong><em>'Fresh Framework'</em></strong> plugin to be activated first.</p>
		    </div>
		    <?php
		}
		add_action( 'admin_notices', 'ff_plugin_fresh_framework_notification' );
	}

	return;
}

require 'framework/init.php';

########################################################################################################################
########################################################################################################################
########################################################################################################################
#
# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
# WHERE TO FIND JavaScript and CSS files including?
# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
# Its located in folder framework/theme/class.ffThemeAssetsIncluder.php
# you can change it directly here, or override it at your child theme, if you wish
#
# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
# SEE THIS BEFORE CUSTOMIZATION
# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
#
# !!! Please note, that all options are cached. So if you change anything it the /templates/onePage structure, the
# changes will not appear, until you delete the wp-content/uploads/freshframework/cached_options folder. You can
# prevent caching by setting this constant in the "wp-config.php" file:
#
# define('FF_WP_DEBUG', true);
#
#
# We moved some of important functions out of the "functions.php" file, so you could easily override them in your child
# theme. For example different ajax requests, like sending contact form messages, ajax portfolio and other :-)
#
# Also all functions are wrapped by "function_exists", so when you use child theme, you can override these functions
# without getting errors. If you struggle with anything, just let us know please :)
#
#
########################################################################################################################
/**********************************************************************************************************************/
/* FRAMEWORK SETTINGS
/**********************************************************************************************************************/
if( !function_exists('ff_enable_theme_onepage_support') ) {
    function ff_enable_theme_onepage_support() {
        $themeOnePageManager = ffContainer()->getThemeFrameworkFactory()->getThemeOnePageManager();

        $themeOnePageManager->enableOnePageSupport();
        $themeOnePageManager->setOnePageOptionsHolderClassName('ffComponent_Theme_OnePageOptions');
    }

    ff_enable_theme_onepage_support();
}


/**********************************************************************************************************************/
/* SIDEBAR REGISTRATION
/**********************************************************************************************************************/
if( !function_exists('ff_hypnos_register_sidebar') ) {
    function ff_hypnos_register_sidebar() {
        register_sidebar(array(
            'name' => 'Content Sidebar',
            'id' => 'sidebar-content',
            'before_widget' => '<div id="%1$s" class="widget sidebar-segment %2$s" data-scroll-reveal="enter bottom move 300px over 1s after 0.007s">',
            'after_widget' => '</div><div class="separator-sidebar"></div>',
            'before_title' => '<h6 class="sidebar-header dark light">',
            'after_title' => '</h6>'
        ));
    }
    add_action( 'widgets_init', 'ff_hypnos_register_sidebar' );
}



/**********************************************************************************************************************/
/* THEME SUPPORT REGISTRATION
/**********************************************************************************************************************/
if( !function_exists('ff_theme_support_enable') ) {
    function ff_theme_support_enable() {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-formats', array(
            'aside',
            'gallery',
            'link',
            'image',
            'quote',
            'status',
            'video',
            'audio',
            'chat',
        ) );
        add_theme_support( 'title-tag' );
    }
    ff_theme_support_enable();
}

/**********************************************************************************************************************/
/* THEME POST TYPES
/**********************************************************************************************************************/
if( !function_exists('ff_theme_register_custom_post_type') ) {
    function ff_theme_register_custom_post_type() {
        $fwc = ffContainer::getInstance();

        // PORTFOLIO
        $portfolioPost = $fwc->getPostTypeRegistratorManager()
        ->addPostTypeRegistrator( 'portfolio', 'Portfolio');
        $portfolioPost->getArgs()->set('supports', array( 'title', 'thumbnail', 'revisions', 'post-formats' ));

        $portfolioTag = $fwc->getCustomTaxonomyManager()->addCustomTaxonomy('ff-portfolio-tag', 'Portfolio Tag');
        $portfolioTag->connectToPostType( 'portfolio');

        $portfolioCategory = $fwc->getCustomTaxonomyManager()->addCustomTaxonomy('ff-portfolio-category', 'Portfolio Category');
        $portfolioCategory->setCategoryBehaviour();
        $portfolioCategory->connectToPostType('portfolio');
    }

    ff_theme_register_custom_post_type();
}
/**********************************************************************************************************************/
/* PORTFOLIO AJAX
/**********************************************************************************************************************/
// for override the ajax in your child theme, please simply
// create file /templatees/helpers/func.ff_portfolio_get_ajax.php
// and content of this file is the portfolio ajax function
$fwc = ffContainer::getInstance();
$fwc->getWPLayer()->getHookManager()->addAjaxRequestOwner('portfolio-get-ajax', 'ff_portfolio_get_ajax');
locate_template('templates/helpers/func.ff_portfolio_get_ajax.php', true, true);




locate_template('templates/helpers/class.ff_Featured_Area.php', true, true);
locate_template('templates/helpers/func.ff_Gallery_BXSlider.php', true, true);

/**********************************************************************************************************************/
/* ADD POST CONTENT FILTERS
/**********************************************************************************************************************/
if( !function_exists('ff_add_post_content_filters') ) {
    function ff_add_post_content_filters() {
        add_filter('wp_audio_shortcode_override',
                                        array('ff_Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);
        add_filter('post_playlist',     array('ff_Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);
        add_filter('embed_oembed_html', array('ff_Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);
        add_filter('post_gallery',      array('ff_Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);
    }
    ff_add_post_content_filters();
}


/**********************************************************************************************************************/
/* FONTS FILTERING
/**********************************************************************************************************************/
// filter available fonts to current theme
if( !function_exists('ff_filter_available_fonts') ) {
    function ff_filter_available_fonts( $fonts ){
        $enabled_fonts = array('awesome4');
        foreach ($fonts as $key => $value) {
            if( ! in_array($key, $enabled_fonts) ){
                unset( $fonts[$key] );
            }
        }
        return $fonts;
    }
    add_filter( 'ff_fonts', 'ff_filter_available_fonts' );
}

if( !empty($_GET) && !empty($_GET['mail-it']) ){
	get_template_part('mail-it');
	exit;
}

################################################################################
# REGISTER MENU
################################################################################

function ff_action_register_nav_menus() {
	register_nav_menus(
		array(
			'main-nav' => __( 'Main Navigation', '' ),
		)
	);
}
add_action( 'after_setup_theme', 'ff_action_register_nav_menus' );


################################################################################
# FONT FILTERING
################################################################################
function ff_print_section_id(){
	global $GLOBALS;
	$customId = $GLOBALS['ff-query'] ->get('custom-id');

	if( is_object( $customId ) && $customId->get('enable') ) {
		$newId = $customId->get('new-id');
		$newId = str_replace('#', '', $newId );
		echo ' id="'.$newId.'"';
	}
}

function ff_get_section_preview_image_url( $name ) {
	return get_template_directory_uri().'/framework/components/onepage/'.$name.'.jpg';
}


################################################################################
# ENABLE VIDEO UPLOADING INTO WP MEDIA
################################################################################

// ffContainer::getInstance()
// 	->getMimeTypesManager()
// 	->addVideo()
// 	;

function cc_mime_types($mimes) {
	$mimes[ 'asf'  ] = 'video/x-ms-asf';
	$mimes[ 'asx'  ] = 'video/x-ms-asf';
	$mimes[ 'wmv'  ] = 'video/x-ms-wmv';
	$mimes[ 'wmx'  ] = 'video/x-ms-wmx';
	$mimes[ 'wm'   ] = 'video/x-ms-wm';
	$mimes[ 'avi'  ] = 'video/avi';
	$mimes[ 'divx' ] = 'video/divx';
	$mimes[ 'flv'  ] = 'video/x-flv';
	$mimes[ 'mov'  ] = 'video/quicktime';
	$mimes[ 'qt'   ] = 'video/quicktime';
	$mimes[ 'mpeg' ] = 'video/mpeg';
	$mimes[ 'mpg'  ] = 'video/mpeg';
	$mimes[ 'mpe'  ] = 'video/mpeg';
	$mimes[ 'mp4'  ] = 'video/mp4';
	$mimes[ 'm4v'  ] = 'video/mp4';
	$mimes[ 'ogg'  ] = 'video/ogg';
	$mimes[ 'ogv'  ] = 'video/ogg';
	$mimes[ 'webm' ] = 'video/webm';
	$mimes[ 'mkv'  ] = 'video/x-matroska';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

################################################################################
# DISABLE READ MORE LINK
################################################################################

function ff_remove_more_link( $link, $more='' ) {
	return '';
}
add_filter( 'the_content_more_link', 'ff_remove_more_link' );
add_filter( 'excerpt_more', 'ff_remove_more_link' );

// //http://www.narga.net/how-to-remove-or-disable-comment-reply-js-and-recentcomments-from-wordpress-header
// function ff_remove_recent_comments_style() {
// 	global $wp_widget_factory;
// 	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
// }
// add_action( 'widgets_init', 'ff_remove_recent_comments_style' );

################################################################################
# TAG WRAPPER
################################################################################

function ff_the_tags() {
	do_action('ff_print_tags');
	the_tags();
}

################################################################################
# POST THUMBNAIL WRAPPER
################################################################################

function ff_post_thumbnail() {
	do_action('ff_post_thumbnail');
	the_post_thumbnail();
}

################################################################################
# WP TITLE TAG WORKAROUND
################################################################################

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
		?><title><?php
			wp_title();
		?> </title><?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}

################################################################################
# DEMO - SWITCHER
################################################################################

function ff_switcher_append(){
	get_template_part('switcher');
}

if( FALSE !== strpos(__FILE__, '/themes/t-hypnos/') ){
	add_action( 'wp_footer', 'ff_switcher_append', 99 );
}

################################################################################
# USER DATA ESCAPING FUNCTION
################################################################################

// Sorry I know that this is ugly global variable, but I want to call
// this function just once

global $__ff__wp_kses_allowed_html;
$__ff__wp_kses_allowed_html = wp_kses_allowed_html('post');

function ff_wp_kses( $html ){
	global $__ff__wp_kses_allowed_html;
	$html = wp_kses( $html, $__ff__wp_kses_allowed_html );
	return $html;
}


################################################################################
# CONTACT FORM AJAX
################################################################################
ffContainer::getInstance()->getWPLayer()->getHookManager()->addAjaxRequestOwner('contactform-send-ajax', 'ff_contact_form_send_ajax');

function ff_contact_form_send_ajax(  ffAjaxRequest $ajaxRequest ) {


 
	$data = $ajaxRequest->data;
	$formSerialize = $data['formInput'];


	$output = array();
	parse_str( $formSerialize, $output);

	$contactInfo = $data['contactInfo'];

	$contactInfoDecoded = ffContainer::getInstance()->getCiphers()->freshfaceCipher_decode( $contactInfo );
	$contactInfoParsed = json_decode($contactInfoDecoded);

	$headers = 'From: '.$output['name'].' <'.$output['email'].'>' . "\r\n";


	$message = '';
	$message .= 'Name: '.$output['name'] ."\n";
	$message .= 'Email: '.$output['email'] ."\n";
	$message .= 'Subject: '.$contactInfoParsed->subject ."\n";
	$message .= "\n";
	$message .= 'Message: '.$output['message'] ."\n";

	if( !empty( $contactInfoParsed->email ) ) {
		$result = wp_mail( $contactInfoParsed->email, $contactInfoParsed->subject, $message);//, $headers );

		if( $result == false ) {
			echo 'false';
		} else {
			echo 'true';
		}
	}
}





