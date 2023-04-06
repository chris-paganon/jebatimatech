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
  <h1><?php echo esc_html(get_option( 'jbati_archive_intro_title' )); ?></h1>
  <p><?php echo get_option( 'jbati_archive_intro_text' ); ?></p>
</div>

<?php
get_template_part('templates/content', 'jbati_archive');

get_footer();