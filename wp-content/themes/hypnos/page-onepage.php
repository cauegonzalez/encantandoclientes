<?php
/**
 * Template Name: One Page
 *
 * @package WordPress
 * @subpackage Hypnos
 * @since Hypnos 1.0
 */
get_header();

/****************************************/
// One Page Custom Navigation
/****************************************/

$fwc = ffContainer::getInstance();
$postMeta = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade( $post->ID );
$onePage = $postMeta->getOption( 'onepagenavigation');
$onePage = unserialize( base64_decode( $onePage ));
$sectionQuery = ffContainer::getInstance()->getOptionsFactory()->createQuery( $onePage, 'ffComponent_Theme_OnePageOptions');

if( $sectionQuery->get('menu use_custom_menu') ){
	$GLOBALS['_ff_special_one_page_custom_menu'] = $sectionQuery->get('menu nav_menu');
}

get_template_part( 'templates/header/navigation');

/****************************************/
// One Page Sections
/****************************************/

$fwc = ffContainer::getInstance();
$postMeta = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade( $post->ID );
$onePage = $postMeta->getOptionCoded( 'onepage');
//$onePage = unserialize( base64_decode( $onePage ));
$sectionQuery = ffContainer::getInstance()->getOptionsFactory()->createQuery( $onePage, 'ffComponent_Theme_OnePageOptions');


foreach ( $sectionQuery->get('sections') as $query ) {

	$GLOBALS['ff-query'] = $query;

	$variation_type = $query->getVariationType();

	$variation_sections = array(
			'about',
			'blog',
			'contact',
			'featured',
			'fun-facts',
			'map',
			'parallax-gallery-item',
			'portfolio',
			'pricing',
			'services',
			'slider',
			'small-header',
			'team',
			'testimonials',
			'text-boxes',
			'text-with-icon-boxes',
			'twitter',
			'video',
			'html',
	);

	if( in_array($variation_type, $variation_sections) ){
		get_template_part( 'templates/onePage/sections/' . $variation_type );
	}
}

get_footer();
