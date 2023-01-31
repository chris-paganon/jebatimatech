<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<article id="post-<?php esc_attr_e($args['id'], 'jebatimatech'); ?>" data-solution-id="<?php esc_attr_e($args['id'], 'jebatimatech'); ?>" class="jbati-solution">
	<div class="inside-article">
    <h2><?php esc_html_e($args['title'], 'jebatimatech'); ?></h2>
    <h3>
      <?php
      foreach ($args['categories'] as $category) {
        esc_html_e($category->name, 'jebatimatech'); 
      }
      ?>
    </h3>
    <div class="entry-summary">
      <?php esc_html_e($args['content'], 'jebatimatech'); ?>
    </div>
  </div>
</article>