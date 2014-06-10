<?php
/**
 * Plugin Name: WP Mxit
 * Plugin URI: 
 * Description: Turn WordPress into a Mxit app.
 * Version: 0.0.1
 * Author: Glio
 * Author URI: http://www.glio.co.za
 * License: GPL2 GNU GPLv2+
 */

//Mxit Header
function is_mxit() {
  $headers = getallheaders();
  if ($headers["X_MXIT_USERID_R"]) {
    return true;
  } else {
    return false;
  }
}

//if mxit add tempate function
if (is_mxit()) {
  add_filter( 'page_template', 'wp_mxit_page_template' );
  add_filter( 'single_template', 'wp_mxit_single_template' );
  add_filter( 'archive_template', 'wp_mxit_archive_template' );
  add_filter( 'home_template', 'wp_mxit_home_template' );
  add_filter( 'category_template', 'wp_mxit_category_template' );
}
// REGISTER GETS
function get_mxit_header() {
    $header_file = 'parts/mxit-header.php';
    $mxit_header = plugin_dir_path( __FILE__ ) . $header_file;
    return include $mxit_header;
}
function get_mxit_footer() {
    $footer_file = 'parts/mxit-footer.php';
    $mxit_footer = plugin_dir_path( __FILE__ ) . $footer_file;
    return include $mxit_footer;
}
//Templates
function wp_mxit_page_template( $page_template ) {
    global $post;

    if ( is_page()) {
        $page_template = dirname( __FILE__ ) . '/templates/page.php';
    }
    return $page_template;
}

function wp_mxit_single_template($single_template) {
    global $post;

    if ( is_single()) {
        $single_template = dirname( __FILE__ ) . '/templates/single.php';
    }
    return $single_template;
}
function wp_mxit_archive_template( $archive_template ) {
    global $post;

    if ( is_archive() ) {
        $archive_template = dirname( __FILE__ ) . '/templates/archive.php';
    }
    return $archive_template;
}
function wp_mxit_category_template( $taxonomy_template ) {
    global $post;

    if ( is_category() ) {
        $category_template = dirname( __FILE__ ) . '/templates/archive.php';
    }
    return $category_template;
}
function wp_mxit_home_template( $home_template ) {
    global $post;

    if ( is_home()|| is_front_page() ) {
        $home_template = dirname( __FILE__ ) . '/templates/home.php';
    }
    return $home_template;
}
//REGISTER NAVS
register_nav_menus( array(
    'mxit_header_nav' => 'Mxit Top Navigation',
    'mxit_footer_nav' => 'Mxit Bottom Navigation'
) );


?>