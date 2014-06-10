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
  * Advertising
  * Referral link
*/

//Mxit Header
function is_mxit() {
  $headers = getallheaders();
    if (array_key_exists ( "X_MXIT_USERID_R", $headers ) ) {
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
  add_filter( 'category_template', 'wp_mxit_category_template' );
  add_filter( 'home_template', 'wp_mxit_home_page_template' );
  add_filter( 'home_template', 'wp_mxit_home_blog_template' );

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

# Static home page
function wp_mxit_home_page_template( $home_template ) {
    global $post;
    if ( is_front_page() ) {
        $home_template = dirname( __FILE__ ) . '/templates/page.php';
    }
    return $home_template;
}

# Blog home page
function wp_mxit_home_blog_template( $home_template ) {
    global $post;
    if ( is_home() ) {
        $home_template = dirname( __FILE__ ) . '/templates/archive.php';
    }
    return $home_template;
}

//REGISTER NAVS
register_nav_menus( array(
    'mxit_header_nav' => 'Mxit Top Navigation',
    'mxit_footer_nav' => 'Mxit Bottom Navigation'
) );

// Add settings admin menu

add_action( 'admin_menu', 'wp_mxit_settings_menu' );

function wp_mxit_settings_menu() {
  add_options_page( 'WP Mxit Settings', 'WP Mxit Settings', 'manage_options', 'wp-mxit-settings', 'wp_mxit_settings_page' );
}

function wp_mxit_settings_page() {
  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
?>
  <h1>WP Mxit</h1>
  <form method="POST" action="options.php">

    <?php settings_fields( 'wp-mxit-settings' );
    do_settings_sections( 'wp-mxit-settings' );
    submit_button();
    ?>

  </form>

<?php
}

add_action( 'admin_init', 'wp_mxit_settings_api_init' );

function wp_mxit_settings_api_init() {
  // Add the section to reading settings so we can add our
  // fields to it
  add_settings_section(
    'wp_mxit_app_settings_section',
    '<h2>App settings</h2>',
    'render_wp_mxit_app_settings_section',
    'wp-mxit-settings'
  );

  add_settings_field(
    'wp_mxit_app_id',
    'Mxit ID',
    'render_wp_mxit_app_id',
    'wp-mxit-settings',
    'wp_mxit_app_settings_section'
  );
  
  add_settings_field(
    'wp_mxit_auid',
    'AUID',
    'render_wp_mxit_auid',
    'wp-mxit-settings',
    'wp_mxit_app_settings_section'
  );

  register_setting( 'wp-mxit-settings', 'wp_mxit_auid' );
  register_setting( 'wp-mxit-settings', 'wp_mxit_app_id' );  
 }
  
 function render_wp_mxit_app_settings_section() {

 }
  
 function render_wp_mxit_auid() {
  echo '<input name="wp_mxit_auid" id="wp_mxit_auid" type="text" value="' . get_option( 'wp_mxit_auid' ) . '" />';
 }

  function render_wp_mxit_app_id() {
    echo '<input name="wp_mxit_app_id" id="wp_mxit_app_id" type="text" value="' . get_option( 'wp_mxit_app_id' ) . '" />';
  }


 ?>