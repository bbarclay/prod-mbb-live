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

