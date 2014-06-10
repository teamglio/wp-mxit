<?php

// SETTINGS

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