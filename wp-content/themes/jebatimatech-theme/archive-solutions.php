<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

global $wp_query;
$solutions = apply_filters( 'jbati_solutions_array', $wp_query->get_posts() );
$filters = apply_filters( 'jbati_filters_array', array(), $solutions );
do_action( 'jbati_before_archive', $solutions, $filters );
?>

<div class="jbati-intro">
  <h1>Logiciels pour la construction</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>

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
      <?php 
      foreach ( $solutions as $solution) : 
        get_template_part( 'content', 'jbati_solutions', $solution );
      endforeach
      ?>
  </div>
</main>

<?php
get_footer();