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
      'taxonomy_names' => get_object_taxonomies($solution_post),
      'acf_fields' => get_fields($solution_post->ID)
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
  $filters = [
    // [
    //   'name' => 'Catégorie de technologie',
    //   'slug' => 'categorie_technologie',
    //   'type' => 'acf',
    //   'filter_items' => []
    // ],
    [
      'name' => 'Thèmes',
      'slug' => 'themes',
      'type' => 'taxonomy',
      'filter_items' => []
    ],
    [
      'name' => 'Envergure de projets',
      'slug' => 'envergure_de_projets',
      'type' => 'taxonomy',
      'filter_items' => []
    ]
  ];
  
  foreach ( $filters as $filter_key => $filter ) {
    switch ($filter['type']) {
      // case 'acf':
      //   $filters[$filter_key]['filter_items'] = jbati_get_acf_filter_items($filter['slug'], $solutions);
      //   break;
      case 'taxonomy':
        $filters[$filter_key]['filter_items'] = jbati_get_taxonomy_filter_items($filter['slug'], $solutions);
        break;
    }
  }
  return $filters;
}

function jbati_get_taxonomy_filter_items($filter_slug, $solutions) {
  $filter_items = array();
  foreach ($solutions as $solution) {
    foreach ($solution['taxonomy_names'] as $taxonomy_name) {
      if ($taxonomy_name == $filter_slug) {
        $terms = get_the_terms( $solution['id'], $taxonomy_name );
        foreach ( $terms as $term ) {
          if ( !in_array($term->term_id, array_column($filter_items, 'id')) ) {
            $filter_items[] = [
              'id' => $term->term_id,
              'name' => $term->name,
              'slug' => $term->slug,
              'active' => false
            ];
          }
        }
      }
    }
  }
  return $filter_items;
}