<?php
if (!defined('ABSPATH')) exit;

/**
 * Enqueue scripts
 */
add_action('wp_enqueue_scripts', 'jbati_theme_enqueue_scripts', 20);

function jbati_theme_enqueue_scripts() {
  if (is_post_type_archive( 'solutions' ) ) {
    wp_enqueue_script('jbati-archive', get_stylesheet_directory_uri() . '/assets/js/jbati-archive.js', array('jquery'), rand(111, 9999), true);
  }
}


/**
 * Send data to JS
 */
add_action( 'jbati_before_archive', 'jbati_send_data_to_js', 10 , 2 );

function jbati_send_data_to_js($solutions, $filters) {
  wp_add_inline_script( 
    'jbati-archive', 
    'let solutions = ' . json_encode($solutions) . ';' .
    'let filters = ' . json_encode($filters)
  );
}


/**
 * Get an array of solutions with all the data
 */
add_filter( 'jbati_solutions_array', 'jbati_get_all_solutions_data', 10, 1 );

function jbati_get_all_solutions_data($solutions_query) {
  $solutions = array();
  foreach ( $solutions_query as $key => $solution_post ) {
    $solutions[$key] = [
      'id' => $solution_post->ID,
      'active' => true,
      'title' => $solution_post->post_title,
      'content' => $solution_post->post_content,
      'categories' => get_field('categories', $solution_post->ID)
    ];
  }
  error_log(print_r($solutions, true));
  return $solutions;
}


/**
 * Get an array of all required filters
 */
add_filter( 'jbati_filters_array', 'jbati_get_all_filters_data', 10, 2 );

function jbati_get_all_filters_data( $filters, $solutions ) {
  $filters_needed = [
    [
      'name' => 'Catégories',
      'slug' => 'categories',
      'type' => 'taxonomy',
      'filter_items' => []
    ],
    [
      'name' => 'Fonction principale',
      'slug' => 'fonction_principale',
      'type' => 'string',
      'filter_items' => []
    ]
  ];
  
  // Hardcoded one filter for now. Need to use a static array (see above) as an input to choose what filters we need
  $filters[] = [
    'name' => 'Catégories',
    'slug' => 'categories',
    'type' => 'taxonomy',
    'filter_items' => []
  ];
  foreach ( $solutions as $solution ) {
    foreach ( $solution['categories'] as $category ) {
      $filter_category_exists = false;
      foreach ( $filters[0]['filter_items'] as $filter_item ) {
        if ( $filter_item && $filter_item['id'] == $category->term_id ) {
          $filter_category_exists = true;
        }
      }
      if ( ! $filter_category_exists ) {
        $filters[0]['filter_items'][] = [
          'id' => $category->term_id,
          'name' => $category->name,
          'slug' => $category->slug,
          'active' => false
        ];
      }
    }
  }
  return $filters;
}