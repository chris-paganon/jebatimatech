<?php
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Add a settings page
 */
add_action( 'admin_menu', 'jbati_add_settings_pages' );

function jbati_add_settings_pages() {
  add_options_page( 'JeBatimatech', 'JeBatimatech', 'manage_options', 'jbati-settings-page', 'jbati_settings_page' );
}

function jbati_settings_page() {
  ?>
  <div class="wrap">
    <h1>JeBatimatech</h1>
    <form method="post" action="options.php">
      <?php
      settings_fields( 'jbati-settings-group' );
      do_settings_sections( 'jbati-settings-page' );
      submit_button();
      ?>
    </form>
  </div>
  <?php
}


/**
 * Register settings section and fields
 * Register_setting manages the saving of the settings
 * add_settings_field is the callback function that will display the field
 */
add_action( 'admin_init', 'jbati_register_settings' );

function jbati_register_settings() {
  add_settings_section( 'jbati-settings-section', 'Settings', '', 'jbati-settings-page' );

  register_setting( 'jbati-settings-group', 'jbati_archive_intro_title' );
  add_settings_field( 'jbati-archive-intro-title-field', 'Titre intro archive', 'jbati_archive_intro_title_field', 'jbati-settings-page', 'jbati-settings-section' );

  register_setting( 'jbati-settings-group', 'jbati_archive_intro_text' );
  add_settings_field( 'jbati-archive-intro-text-field', 'Texte intro archive', 'jbati_archive_intro_text_field', 'jbati-settings-page', 'jbati-settings-section' );
}

function jbati_archive_intro_text_field() {
  $value = get_option( 'jbati_archive_intro_text' );
  wp_editor(
    $value, 
    'jbati_archive_intro_text',
    array(
      'textarea_rows' => 5,
      'media_buttons' => false,
      'teeny' => true,
      'wpautop' => false,
    )
  );
}

function jbati_archive_intro_title_field() {
  $value = get_option( 'jbati_archive_intro_title' );
  echo '<input type="text" name="jbati_archive_intro_title" value="' . $value . '" style="width: 100%;" />';
}