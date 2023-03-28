<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<div class="jbati-intro">
  <h1>Recherche: <?php print_r(get_search_query()); ?></h1>
</div>

<?php
get_template_part('templates/content', 'jbati_archive');

get_footer();