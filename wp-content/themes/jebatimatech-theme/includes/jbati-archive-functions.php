<?php
if (!defined('ABSPATH')) exit;

/**
 * Enqueue scripts
 */
add_action('wp_enqueue_scripts', 'jbati_theme_enqueue_scripts', 20);

function jbati_theme_enqueue_scripts() {
  if (is_post_type_archive( 'solutions' ) || is_search()) {
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
    $properties = array_merge($taxonomies_array, $acf_fields_array);
    $solutions[$key] = [
      'id' => $solution_post->ID,
      'active' => true,
      'title' => $solution_post->post_title,
      'content' => $solution_post->post_content,
      'link' => get_permalink($solution_post->ID),
      'properties' => $properties
    ];
  }
  return $solutions;
}

/**
 * Get taxonomies in the unified array schema format
 */
function jbati_get_taxonomies_array($solution_post) {
  $taxonomies_array = array();
  $taxonomies = get_object_taxonomies($solution_post, 'objects');
  foreach ($taxonomies as $taxonomy) {
    $terms_array = jbati_get_terms_array($solution_post, $taxonomy);
    $taxonomies_array[] = array(
      'slug' => $taxonomy->name,
      'label' => $taxonomy->label,
      'values' => $terms_array
    );
  }
  return $taxonomies_array;
}

/**
 * Get taxonomy terms in the unified array schema format
 */
function jbati_get_terms_array($solution_post, $taxonomy) {
  $terms_array = array();
  $terms = get_the_terms( $solution_post->ID, $taxonomy->name );
  if (empty($terms)) return $terms_array;
  foreach ($terms as $term) {
    $terms_array[] = array(
      'label' => $term->name,
      'slug' => $term->slug
    );
  }
  return $terms_array;
}

/**
 * Get acf_fields in the unified array schema format
 */
function jbati_get_acf_fields_array ($solution_post) {
  $acf_fields_array = array();
  $acf_fields = get_field_objects($solution_post->ID);
  foreach ($acf_fields as $acf_field) {
    $acf_fields_array[] = array(
      'slug' => $acf_field['name'],
      'label' => $acf_field['label'],
      'values' => [[
        'label' => $acf_field['value'],
        'slug' => sanitize_title($acf_field['value'])
      ]]
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
      'label' => "Pays d'origine",
      'slug' => 'pays_origine',
      'type' => 'taxonomy',
      'show_title' => false,
      'hide_filter' => true,
      'filter_items' => []
    ],
    [
      'label' => 'Catégorie de technologie',
      'slug' => 'categorie_technologie',
      'type' => 'acf',
      'show_title' => false,
      'filter_items' => []
    ],
    [
      'label' => 'Type d\'utilisateur',
      'slug' => 'categorie_de_clientele',
      'type' => 'taxonomy',
      'show_title' => true,
      'filter_items' => []
    ],
    [
      'label' => 'Taille d\'entreprise',
      'slug' => 'envergure_clientele_visee',
      'type' => 'taxonomy',
      'show_title' => true,
      'filter_items' => []
    ],
    [
      'label' => 'Spécialités',
      'slug' => 'disciplines_construction',
      'type' => 'taxonomy',
      'show_title' => true,
      'filter_items' => []
    ],
    [
      'label' => 'Langue d\'interface',
      'slug' => 'langue_de_travail',
      'type' => 'taxonomy',
      'show_title' => true,
      'filter_items' => []
    ],
    [
      'label' => 'Phases de projet',
      'slug' => 'phases_de_projet',
      'type' => 'taxonomy',
      'show_title' => true,
      'filter_items' => []
    ],
    [
      'label' => 'Type de projet',
      'slug' => 'categorie_de_projet',
      'type' => 'taxonomy',
      'show_title' => true,
      'filter_items' => []
    ],
    [
      'label' => 'Département',
      'slug' => 'pour_departement',
      'type' => 'taxonomy',
      'show_title' => true,
      'filter_items' => []
    ],
  ];
  
  foreach ( $filters as $filter_key => $filter ) {
    $filters[$filter_key]['filter_items'] = jbati_get_filter_items($filter, $solutions);
  }
  return $filters;
}

/**
 * Get an array of all the filter items available from the solutions
 */
function jbati_get_filter_items($filter, $solutions) {
  $filter_items = array();

  // Get all taxonomy filter items in the right order
  if ($filter['type'] === 'taxonomy') {
    $terms = get_terms( array(
      'taxonomy' => $filter['slug'],
      'hide_empty' => true,
    ) );
    foreach ($terms as $term) {
      $filter_items[] = [
        'label' => $term->name,
        'slug' => $term->slug,
        'show' => false,
        'active' => false
      ];
    }
  }

  // Get ACF filter items & only show relevant taxonomy filter items
  foreach ($solutions as $solution) {
    foreach ($solution['properties'] as $property) {
      if ($property['slug'] == $filter['slug']) {
        foreach ( $property['values'] as $value ) {
          if ( !in_array($value['slug'], array_column($filter_items, 'slug')) ) {
            //Add missing filter items (for ACF)
            $filter_items[] = [
              'label' => $value['label'],
              'slug' => $value['slug'],
              'show' => true,
              'active' => false
            ];
          } else {
            // Show taxonomy filter items that are relevant to the solutions
            foreach ($filter_items as $filter_item_key => $filter_item) {
              if ($filter_item['slug'] == $value['slug']) {
                $filter_items[$filter_item_key]['show'] = true;
              }
            }
          }
        }
      }
    }
  }
  return $filter_items;
}

/**
 * Set active class if the functionality exists in the solution
 */
function get_functionality_class($solution, $functionality_slug) {
  foreach ($solution['properties'] as $property) {
    if ($property['slug'] == 'themes') {
      foreach ($property['values'] as $value) {
        if ($value['slug'] == $functionality_slug) {
          return 'active';
        }
      }
    }
  }
  return '';
}

/**
 * Display a list of terms and the taxonomy label from a taxonomy slug and a postid
 */
function jbati_get_terms_list($taxonomy_slug, $post_id, $extra_classes = '') {
  $terms = get_the_terms( $post_id, $taxonomy_slug );
  if (empty($terms)) return;
  $taxonomy = get_taxonomy($taxonomy_slug);

  $terms_list = '<div class="jbati-taxonomy-content-wrapper ' . esc_attr($extra_classes) . '">';
  $terms_list .= '<h3 class="taxonomy-label">' . esc_html__($taxonomy->label, 'jebatimatech') . '</h3>';
  $terms_list .= '<ul>';
  foreach ($terms as $term) {
    $terms_list .= '<li class="term">' . esc_html__($term->name, 'jebatimatech') . '</li>';
  }
  $terms_list .= '</ul></div>';

  return $terms_list;
}

/**
 * Display a ACF field value and label from a field slug and a postid
 */
function jbati_get_acf_field_value($field_slug, $post_id) {
  $field = get_field_object($field_slug, $post_id);
  if (empty($field)) return;

  $label = $field['label'];
  $value = $field['value'];
  $percent_bar = '';

  if ($field['type'] === 'number' && $field['append'] === '%') {
    ob_start(); ?>
    <div class="acf-percent-outer-bar">
      <div class="acf-percent-bar" style="width:<? echo $value; ?>%"></div>
    </div>
    <?php
    $percent_bar = ob_get_clean();

    $html = <<<HTML
    <div class="jbati-acf-content-wrapper">
      <h3 class="acf-label">$label</h3>
      <div class="acf-percent-wrapper">
        $percent_bar
        <span class="acf-value">$value%</span>
      </div>
    </div>
    HTML;
  } else {
    if ($field['type'] === 'true_false') {
      $value = $value ? 'Oui' : 'Non';
    }
    $html = <<<HTML
    <div class="jbati-acf-content-wrapper">
      <h3 class="acf-label">$label</h3>
      <p class="acf-value">$value</p>
    </div>
    HTML;
  }

  return $html;
}