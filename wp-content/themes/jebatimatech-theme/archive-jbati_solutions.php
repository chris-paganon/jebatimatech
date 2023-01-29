<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
do_action( 'jbati_before_archive' ); ?>

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
    }
    ?>
  </main>
</div>

<?php
get_footer();