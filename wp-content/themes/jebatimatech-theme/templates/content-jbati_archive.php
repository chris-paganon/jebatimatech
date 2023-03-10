<?php 
/**
 * The template for displaying the solutions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wp_query;
$solutions = apply_filters( 'jbati_solutions_array', $wp_query->get_posts() );
$filters = apply_filters( 'jbati_filters_array', array(), $solutions );
do_action( 'jbati_before_archive', $solutions, $filters );
?>

<main class="site-main" id="main">
  <div class="jbati-extra-filter-controls-wrapper">
    <div class="jbati-active-filters-pills"></div>
    <?php get_template_part( 'templates/component', 'ca_switch', [] ); ?>
  </div>

  <div class="jabti-solutions-archive-grid">
    <div class="jbati-solutions-archive-sidebar sidebar is-left-sidebar" id="left-sidebar">
      <div class="inside-left-sidebar">
        <h2 class="filters-title filters-title-accordion-button">Filtres</h2>
        <div class="jbati-filters-wrapper">
          <?php 
          foreach ( $filters as $filter) : 
            get_template_part( 'templates/content', 'jbati_filter', $filter );
          endforeach
          ?>
        </div>
      </div>
    </div>

    <div class="jbati-solutions-archive-content content-area" id="primary">
      <div class="empty-solutions-message">
        <h2 class="empty-solutions-message-title">Aucune solution ne correspond à votre recherche</h2>
        <p class="empty-solutions-message-text">Veuillez modifier vos filtres de recherche</p>
      </div>
      <?php 
      foreach ( $solutions as $solution) : 
        get_template_part( 'templates/content', 'jbati_solutions', $solution );
      endforeach
      ?>
    </div>
  </div>
</main>