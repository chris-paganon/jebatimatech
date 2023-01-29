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
do_action( 'jbati_before_archive', $solutions );
?>

<div class="sidebar is-left-sidebar" id="left-sidebar">
  <div class="inside-left-sidebar">
    <h2>Filters</h2>
    <input type="checkbox" id="test-hide">
  </div>
</div>

<div class="content-area" id="primary">
  <main class="site-main" id="main">
    <h1>Solutions</h1>
    <p><?php print_r($solutions) ?></p>
    <?php 
    foreach ( $solutions as $solution) : 
      get_template_part( 'content', 'jbati_solutions', $solution );
    endforeach
    ?>
  </main>
</div>

<?php
get_footer();