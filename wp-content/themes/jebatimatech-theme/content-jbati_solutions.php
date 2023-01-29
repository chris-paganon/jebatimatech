<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<article id="post-<?php esc_attr_e($args['id'], 'jebatimatech'); ?>" >
	<div class="inside-article">
    <h2><?php esc_html_e($args['title'], 'jebatimatech'); ?></h2>
    <div class="entry-summary">
      <?php esc_html_e($args['content'], 'jebatimatech'); ?>
    </div>
  </div>
</article>