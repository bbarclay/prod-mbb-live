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
    wp_enqueue_script( 'bodymovin', 'https://cdnjs.cloudflare.com/ajax/libs/bodymovin/4.13.0/bodymovin.min.js', array(), false, false );
    wp_enqueue_script( 'eventcalendar', 'https://addevent.com/libs/atc/1.6.1/atc.min.js', array(), false, false );
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

function filter_search_post( $should_index, WP_Post $post )
{
    if( 19397 === $post->ID  ) {
        return false;
    }
    if( 63048 === $post->ID  ) {
        return false;
    }
    if( 63041 === $post->ID  ) {
        return false;
    }
    if( 63094 === $post->ID  ) {
        return false;
    }
    if( 63096 === $post->ID  ) {
        return false;
    }
    if( 63098 === $post->ID  ) {
        return false;
    }
    if( 63100 === $post->ID  ) {
        return false;
    }

    return $should_index;
}

// Hook into Algolia to manipulate the post that should be indexed.
add_filter( 'algolia_should_index_searchable_post', 'filter_search_post', 10, 2 );
add_filter( 'algolia_should_index_post', 'filter_search_post', 10, 2 );

/**
 * Register custom query var
 * @param  id    $vars User's Ontraport Id
 * @return array    
 */
function mbb_query_vars_filter($vars) {
  $vars[] .= 'ontraport_id';
  return $vars;
}


function mbb_is_silver() {
    $is_silver =  do_shortcode('[mbb_silver_membership]');
}

function mbb_customer_type() {

    return $customer_type =  do_shortcode('[mbb_get_customer_type]'); 

  
}

/**
 * Check the customer type and 
 * then show conference date
 * @return [type] [description]
 */
function mbb_conference_dates() {

     $customer_type =  do_shortcode('[mbb_get_customer_type]'); 

      if( $customer_type == 'Fasttrack Gold') {
        $show_dates = 'conference_dates';
      }
      else if ( $customer_type == 'Fasttrack Platinum') {
        $show_dates = 'conference_dates';
      }
      else if ( $customer_type == 'Elite Gold' ) {
        $show_dates = 'elite_conference_dates';
      }
      else if ( $customer_type == 'Elite Platinum'  ) {
        $show_dates = 'elite_conference_dates';
      }
      else {
        $show_dates = 'conference_dates';
      }

      return $show_dates;  
}

/**
 * Check the customer type and 
 * then show total numbers of days
 * @return [type] [description]
 */
function mbb_allowed_dates() {

     $customer_type =  do_shortcode('[mbb_get_customer_type]'); 

      if( $customer_type == 'Fasttrack Gold') {
            $days = 2;
      }
      else if ( $customer_type == 'Fasttrack Platinum') {
            $days = 4;
      }
      else if ( $customer_type == 'Elite Gold' ) {
            $days = 2;
      }
      else if ( $customer_type == 'Elite Platinum'  ) {
            $days = 4;
      }
      else {
            $days = 4;
      }

      return $days;  
}

function mbb_create_post_type() {
  register_post_type( 'mybbp_timelytech',
    array(
      'labels' => array(
        'name' => __( 'Timely Tech' ),
        'singular_name' => __( 'Timely Tech' ),
        'menu_name'             => 'Timely Tech',
        'name_admin_bar'        => 'Timely Tech',
        'archives'              => 'Timely Tech Archives',
        'parent_item_colon'     => 'Parent Timely Tech:',
        'all_items'             => 'All Timely Tech',
        'add_new_item'          => 'Add New Timely Tech',
        'add_new'               => 'Add Timely Tech',
        'new_item'              => 'New Timely Tech',
        'edit_item'             => 'Edit Timely Tech',
        'update_item'           => 'Update Timely Tech',
        'view_item'             => 'View Timely Tech',
        'search_items'          => 'Search Timely Tech',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into timely tech',
        'uploaded_to_this_item' => 'Uploaded to this timely tech',
        'items_list'            => 'Timely Tech list',
        'items_list_navigation' => 'Timely Tech list navigation',
        'filter_items_list'     => 'Filter series list'
      ),
      'menu_position' => 16,
      'menu_icon' => 'dashicons-awards',
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'tech-videos'),
    )
  );  
  register_post_type( 'mybbp_summit',
    array(
      'labels' => array(
        'name' => __( 'Summit' ),
        'singular_name' => __( 'VA Summit' ),
        'menu_name'             => 'Summit',
        'name_admin_bar'        => 'VA Summit',
        'archives'              => 'VA Summit Archives',
        'parent_item_colon'     => 'Parent Summit:',
        'all_items'             => 'All Summit',
        'add_new_item'          => 'Add New Summit',
        'add_new'               => 'Add Summit',
        'new_item'              => 'New Summit',
        'edit_item'             => 'Edit Summit',
        'update_item'           => 'Update Summit',
        'view_item'             => 'View Summit',
        'search_items'          => 'Search Summit',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into summit',
        'uploaded_to_this_item' => 'Uploaded to this summit',
        'items_list'            => 'Summit list',
        'items_list_navigation' => 'Summit list navigation',
        'filter_items_list'     => 'Filter series list'
      ),
      'menu_position' => 17,
      'menu_icon' => 'dashicons-clipboard',
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'va-summit'),
      'capability_type'       => 'page',
    )
  );

}
add_action( 'init', 'mbb_create_post_type' );