<?php
if (!defined('ABSPATH')) exit;

/**
 * Include php files
 */
add_action( 'init', 'jbati_theme_initialie' );

function jbati_theme_initialie() {
  include_once(  get_stylesheet_directory() . '/includes/jbati-archive-functions.php');
  include_once(  get_stylesheet_directory() . '/includes/jbati-single-functions.php');
}


/**
 * Enqueue styles
 */
add_action('wp_enqueue_scripts', 'jbati_theme_enqueue_styles', 10);

function jbati_theme_enqueue_styles() {
  wp_enqueue_style('jebatimatech-theme-css', get_stylesheet_directory_uri() . '/style.css', array('generate-style'), rand(111, 9999));
  wp_enqueue_style('jebatimatech-theme-general-css', get_stylesheet_directory_uri() . '/assets/css/jebatimatech-theme-general.css', array('jebatimatech-theme-css'), rand(111, 9999));
  if (is_singular('solutions')) {
    wp_enqueue_style('jbati-single-solutions-css', get_stylesheet_directory_uri() . '/assets/css/jbati-single-solutions.css', array('jebatimatech-theme-general-css'), rand(111, 9999));
  }
  if (is_archive() || is_search()) {
    wp_enqueue_style('jbati-archive-solutions-css', get_stylesheet_directory_uri() . '/assets/css/jbati-archive-solutions.css', array('jebatimatech-theme-general-css'), rand(111, 9999));
  }
}