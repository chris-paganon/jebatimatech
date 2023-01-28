<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div class="sidebar is-left-sidebar" id="left-sidebar">
  <div class="inside-left-sidebar">
    <h2>Filters</h2>
  </div>
</div>

<div class="content-area" id="primary">
  <main class="site-main" id="main">
    <h1>Solutions</h1>
    <?php
    if (have_posts()) {
      while (have_posts()) {
        the_post();
        generate_do_template_part( 'jbati_solutions' );
      }
      print_r(get_posts());
    }
    ?>
  </main>
</div>

<?php
get_footer();