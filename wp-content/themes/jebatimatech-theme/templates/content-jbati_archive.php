<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wp_query;
$solutions = apply_filters( 'jbati_solutions_array', $wp_query->get_posts() );
$filters = apply_filters( 'jbati_filters_array', array(), $solutions );
do_action( 'jbati_before_archive', $solutions, $filters );
?>

<main class="site-main jabti-solutions-archive-grid" id="main">
  <div class="jbati-solutions-archive-sidebar sidebar is-left-sidebar" id="left-sidebar">
    <div class="inside-left-sidebar">
      <h2 class="filters-title">Filtrer par:</h2>
      <?php 
      foreach ( $filters as $filter) : 
        get_template_part( 'templates/content', 'jbati_filter', $filter );
      endforeach
      ?>
    </div>
  </div>

  <div class="jbati-solutions-archive-content content-area" id="primary">
    <div class="jbati-extra-filter-controls-wrapper">
      <div class="jbati-active-filters-pills"></div>
      <div class="jbati-made-in-ca-switch-wrapper jbati-switch-wrapper">
        <div class="jbati-made-in-ca-switch jbati-switch">
          <div class="jbati-switch-track"></div>
          <div class="jbati-switch-control">
            <input type="checkbox" id="jbati-made-in-ca-switch" class="jbati-made-in-ca-switch-input jbati-switch-input" value="false">
            <div class="jbati-switch-thumb"></div>
          </div>
        </div>
        <label for="jbati-made-in-ca-switch" class="jbati-made-in-ca-switch-label"><span class="jbati-flag-icon">🇨🇦</span>Solutions Canadiennes</label>
      </div>
    </div>
    <?php 
    foreach ( $solutions as $solution) : 
      get_template_part( 'templates/content', 'jbati_solutions', $solution );
    endforeach
    ?>
  </div>
</main>