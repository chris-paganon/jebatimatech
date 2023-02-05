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
    $taxonomies_array = jbati_get_taxonomies_array($solution_post);
    $acf_fields_array = jbati_get_acf_fields_array($solution_post);
    $solutions[$key] = [
      'id' => $solution_post->ID,
      'active' => true,
      'title' => $solution_post->post_title,
      'content' => $solution_post->post_content,
      'acf_fields' => $acf_fields_array,
      'taxonomies' => $taxonomies_array
    ];
  }
  error_log(print_r($solutions, true));
  return $solutions;
}

function jbati_get_taxonomies_array($solution_post) {
  $taxonomies_array = array();
  $taxonomies = get_object_taxonomies($solution_post, 'objects');
  foreach ($taxonomies as $taxonomy) {
    $terms_array = jbati_get_terms_array($solution_post, $taxonomy);
    $taxonomies_array[] = array(
      'name' => $taxonomy->name,
      'label' => $taxonomy->label,
      'terms' => $terms_array
    );
  }
  return $taxonomies_array;
}

function jbati_get_terms_array($solution_post, $taxonomy) {
  $terms_array = array();
  $terms = get_the_terms( $solution_post->ID, $taxonomy->name );
  foreach ($terms as $term) {
    $terms_array[] = array(
      'id' => $term->term_id,
      'name' => $term->name,
      'slug' => $term->slug
    );
  }
  return $terms_array;
}

function jbati_get_acf_fields_array ($solution_post) {
  $acf_fields_array = array();
  $acf_fields = get_field_objects($solution_post->ID);
  error_log(print_r($acf_fields, true));
  foreach ($acf_fields as $acf_field) {
    $acf_fields_array[] = array(
      'id' => $acf_field['ID'],
      'name' => $acf_field['name'],
      'label' => $acf_field['label'],
      'value' => $acf_field['value']
    );
  }
  return $acf_fields_array;
}


/**
 * Get an array of all required filters
 */
add_filter( 'jbati_filters_array', 'jbati_get_all_filters_data', 10, 2 );

function jbati_get_all_filters_data( $filters, $solutions ) {
  $filters = [
    [
      'name' => 'Catégorie de technologie',
      'slug' => 'categorie_technologie',
      'type' => 'acf',
      'filter_items' => []
    ],
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
      case 'acf':
        $filters[$filter_key]['filter_items'] = jbati_get_acf_filter_items($filter['slug'], $solutions);
        break;
      case 'taxonomy':
        $filters[$filter_key]['filter_items'] = jbati_get_taxonomy_filter_items($filter['slug'], $solutions);
        break;
    }
  }
  error_log(print_r($filters, true));
  return $filters;
}

function jbati_get_taxonomy_filter_items($filter_slug, $solutions) {
  $filter_items = array();
  foreach ($solutions as $solution) {
    foreach ($solution['taxonomies'] as $taxonomy) {
      if ($taxonomy['name'] == $filter_slug) {
        $terms = $taxonomy['terms'];
        foreach ( $terms as $term ) {
          if ( !in_array($term['id'], array_column($filter_items, 'id')) ) {
            $filter_items[] = [
              'id' => $term['id'],
              'name' => $term['name'],
              'slug' => $term['slug'],
              'active' => false
            ];
          }
        }
      }
    }
  }
  return $filter_items;
}

function jbati_get_acf_filter_items($filter_slug, $solutions) {
  $filter_items = array();
  foreach ($solutions as $solution) {
    $acf_fields = $solution['acf_fields'];
    foreach ($acf_fields as $acf_field) {
      if ($acf_field['name'] == $filter_slug) {
        if ( !in_array($acf_field['value'], $filter_items) ) {
          $filter_items[] = $acf_field['value'];
        }
      }
    }
  }
  return $filter_items;
}