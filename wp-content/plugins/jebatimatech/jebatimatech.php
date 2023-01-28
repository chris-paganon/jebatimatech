<?php
if ( !defined( 'ABSPATH' ) ) exit;

/*
Plugin Name: Je Batimatech
Description: All custom features for the website
Version: 1.0
Author: Christophe Paganon
Author URI: https://chrispaganon.com/
*/

add_action( 'plugins_loaded', 'jebatimatech_initialize' );

function jebatimatech_initialize() {
  define( 'JABTI_INCLUDE_DIR', plugin_dir_path( __FILE__ ) . 'includes/' );

  include_once( JABTI_INCLUDE_DIR . 'jbati-general.php' );
}