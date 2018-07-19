<?php

/** =============================
* 1. HOOK
=============================  */

// 1.0 -  Enqueue child scripts
add_action( 'wp_enqueue_scripts', 'mbb_enqueue_styles' );

// 1.1 -  Register Menu
add_action( 'init', 'mbb_register_menu');
add_action( 'wp_enqueue_scripts', 'mbb_dequeue_algolia_styles', 9999 );
add_action( 'after_setup_theme', 'mbb_image_size' );

add_filter( 'query_vars', 'mbb_query_vars_filter' );

//add_action('wp_enqueue_scripts', 'mbb_check_shortcodes');

/** =============================
* 2. ACTION
=============================  */

function mbb_image_size() {
	add_image_size( 'custom-size', 250, 250, true );
}


// 2.0 -  Enqueue child scripts
function mbb_enqueue_styles() {

    $parent_style = 'parent-style'; 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'mbb-child', get_stylesheet_directory_uri() . '/js/app.js', array(), false, true );

    if( is_page('reset-password') ) {

    	wp_enqueue_script( 'password-strength-meter' );
    }
}

// 2.1 -  Register Menu
function mbb_register_menu() {

	register_nav_menu('topmenu', __('Top Menu'));

}


/**
 * Dequeue default Algolia styles.
 */
function mbb_dequeue_algolia_styles() {
	wp_dequeue_script( 'cascade-search' );
	wp_enqueue_script( 'cascade-search-child', get_stylesheet_directory_uri() . '/js/search.js', array( 'algolia-instantsearch', 'jquery' ), false, true );
	
}


/**
 * Deregister plugin scripts if no shortcode found on the content
 *
 * 
 */
function mbb_check_shortcodes() {
    global $post;
    //Check content for layerslider shortcode
    if (!has_shortcode($post->post_content, 'rpp_popup')) {
        add_action('wp_print_scripts', 'reset_password_deenqueue_scripts', 99999);
    }
    if (!has_shortcode($post->post_content, 'frontendtodo') || !has_shortcode($post->post_content, 'consultantviewtodo')) {
        add_action('wp_print_scripts', 'reset_todo_deenqueue_scripts', 99999);
        add_action('wp_print_styles', 'reset_todo_deenqueue_styles', 99999);
    }
    if (!has_shortcode($post->post_content, 'contact-form-7')) {
        add_action('wp_print_styles', 'reset_contact_form_7_styles', 99999);
        add_action('wp_print_scripts', 'reset_contact_form_7_scripts', 99999);
    }
    if (
        !has_shortcode($post->post_content, 'flickr_photostream') || 
        !has_shortcode($post->post_content, 'flickr_set') || 
        !has_shortcode($post->post_content, 'flickr_gallery') || 
        !has_shortcode($post->post_content, 'flickr_tags') || 
        !has_shortcode($post->post_content, 'flickr_group') || 
        !has_shortcode($post->post_content, 'flickrps') ) {

        add_action('wp_print_scripts', 'reset_flickr_scripts', 99999);
        add_action('wp_print_styles', 'reset_flickr_styles', 99999);
    }
}

/**
 * Removes Reset Password
 */
function reset_password_deenqueue_scripts() {
    wp_dequeue_script('reset-password-popup');
 
}

/**
 * Removes To Do List 
 */
function reset_todo_deenqueue_scripts() {
    wp_dequeue_script('mybb-todo-jquery');
    wp_dequeue_script('mybb-todo-jquery-ui');
    wp_dequeue_script('mybb-todovalidation');
    wp_dequeue_script('mybb-todo-date-picker');
    wp_dequeue_script('mybb-todoSortable');
    wp_dequeue_script('mybb-todo');
}

function reset_todo_deenqueue_styles() {
    wp_dequeue_style('mybb-todo-font-awesome');
    wp_dequeue_style('mybb-todo');
}

function reset_contact_form_7_scripts() {
    wp_deregister_script('contact-form-7');
}

function reset_contact_form_7_styles() {
    wp_deregister_style('contact-form-7');
}

function reset_flickr_scripts() {
    wp_deregister_script('justifiedGallery');
    wp_deregister_script('flickrJustifiedGalleryWPPlugin');
}
function reset_flickr_styles() {
    wp_deregister_style('justifiedGallery');
    wp_deregister_style('flickrJustifiedGalleryWPPlugin');
}

/**
 * Register custom query var
 * @param  id    $vars User's Ontraport Id
 * @return array    
 */
function mbb_query_vars_filter($vars) {
  $vars[] .= 'ontraport_id';
  return $vars;
}
