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
        get_template_part( 'content', 'jbati_filter', $filter );
      endforeach
      ?>
    </div>
  </div>

  <div class="jbati-solutions-archive-content content-area" id="primary">
    <div class="jbati-active-filters-pills"></div>
    <?php 
    foreach ( $solutions as $solution) : 
      get_template_part( 'content', 'jbati_solutions', $solution );
    endforeach
    ?>
  </div>
</main>