<?php
if (!defined('ABSPATH')) exit;

/**
 * Enqueue styles
 */
add_action('wp_enqueue_scripts', 'jbati_theme_enqueue_styles', 10);

function jbati_theme_enqueue_styles() {
  wp_enqueue_style('jebatimatech-theme-css', get_stylesheet_directory_uri() . '/style.css', array('generate-style'), rand(111, 9999));
  wp_enqueue_style('jebatimatech-theme-general-css', get_stylesheet_directory_uri() . '/assets/css/jebatimatech-theme-general.css', array('jebatimatech-theme-css'), rand(111, 9999));
}