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

//TODO:
/**
	* Analytics
	* Referral link
*/

//Mxit Header
function is_mxit() {
	$headers = getallheaders();
		if ((array_key_exists ( "X_MXIT_USERID_R", $headers ) ) || (array_key_exists ( "X-Mxit-Userid-R", $headers ) ) ) {
		return true;
	} else {
		return false;
	}
}

if (is_mxit()) {
	add_filter( 'page_template', 'wp_mxit_page_template' );
	add_filter( 'single_template', 'wp_mxit_single_template' );
	add_filter( 'archive_template', 'wp_mxit_archive_template' );
	add_filter( 'category_template', 'wp_mxit_category_template' );
	add_filter( 'home_template', 'wp_mxit_home_template' );
}

// Parts
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

function get_mxit_nav() {
		$nav_file = 'parts/mxit-nav.php';
		$mxit_nav = plugin_dir_path( __FILE__ ) . $nav_file;
		return include $mxit_nav;
}

function get_mxit_home() {
		$home_file = 'templates/home.php';
		$mxit_home = plugin_dir_path( __FILE__ ) . $home_file;
		return include $mxit_home;
}

// 	Templates
function wp_mxit_home_template ($page_template) {
	if (is_home() && is_front_page()) {
		$page_template = dirname( __FILE__ ) . '/templates/home.php';
	} else  {
		$page_template = dirname( __FILE__ ) . '/templates/archive.php'; 
	}
	return $page_template;
}

function wp_mxit_page_template( $page_template ) {
		global $post;

		if ( is_front_page() ) {
				$page_template = dirname( __FILE__ ) . '/templates/front-page.php';
		} else {
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

// Nav
register_nav_menus( array(
		'mxit_nav' => 'Mxit Navigation',
) );

// Settings
include_once (  plugin_dir_path( __FILE__ ) . 'admin/settings.php');

?>