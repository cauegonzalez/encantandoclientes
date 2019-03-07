<?php
/*
	Plugin Name: OT Slide Show
	Plugin URI: http://oceanthemes.net/
	Description: Declares a plugin that will create a custom post type displaying portfolio.
	Version: 1.0
	Author: OceanThemes Team
	Author URI: http://oceanthemes.net/
	Text Domain: ot_slide_show
	Domain Path: /lang
	License: GPLv2 or later
*/

/* UPDATE 
  register_activation_hook is not called when a plugin is updated
  so we need to use the following function 
*/
function ot_slide_show_update() {
	load_plugin_textdomain('ot_slide_show', FALSE, dirname(plugin_basename(__FILE__)) . '/lang/');
}
add_action('plugins_loaded', 'ot_slide_show_update');

add_action( 'init', 'register_ot_slide_show' );
function register_ot_slide_show() {
    
    $labels = array( 
        'name' => __( 'Slide Show', 'ot_slide_show' ),
        'singular_name' => __( 'Slide Show', 'ot_slide_show' ),
        'add_new' => __( 'Add New Slide', 'ot_slide_show' ),
        'add_new_item' => __( 'Add New Slide', 'ot_slide_show' ),
        'edit_item' => __( 'Edit Slide', 'ot_slide_show' ),
        'new_item' => __( 'New Slide', 'ot_slide_show' ),
        'view_item' => __( 'View Slide', 'ot_slide_show' ),
        'search_items' => __( 'Search Slide', 'ot_slide_show' ),
        'not_found' => __( 'No Slide found', 'ot_slide_show' ),
        'not_found_in_trash' => __( 'No Slide found in Trash', 'ot_slide_show' ),
        'parent_item_colon' => __( 'Parent Slide:', 'ot_slide_show' ),
        'menu_name' => __( 'Slide Show', 'ot_slide_show' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'List Slide',
        'supports' => array( 'title', 'editor', 'thumbnail', ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => null,
        'menu_icon' => 'dashicons-update',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,  
    );

    register_post_type( 'slide', $args );
}

?>