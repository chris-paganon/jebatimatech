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

/**
 * Add GTM tracking
 */
add_action('wp_head', 'jbati_gtm_tracking_head', 10);

function jbati_gtm_tracking_head() {
  ?>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-KWD5WM9');</script>
  <!-- End Google Tag Manager -->
  <?php
}

add_action('wp_body_open', 'jbati_gtm_tracking_body', 1);

function jbati_gtm_tracking_body() {
  ?>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KWD5WM9"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <?php
}