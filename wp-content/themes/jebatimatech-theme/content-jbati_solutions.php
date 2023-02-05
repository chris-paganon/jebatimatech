<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$categorie_technologie_value = '';
foreach ($args['acf_fields'] as $acf_field) {
  if ($acf_field['slug'] == 'categorie_technologie') {
    $categorie_technologie_value = $acf_field['value']['label'];
  }
}
?>

<article id="post-<?php esc_attr_e($args['id'], 'jebatimatech'); ?>" data-solution-id="<?php esc_attr_e($args['id'], 'jebatimatech'); ?>" class="jbati-solution active">
	<div class="inside-article">
    <h2><?php esc_html_e($args['title'], 'jebatimatech'); ?></h2>
    <h3><?php esc_html_e($categorie_technologie_value, 'jebatimatech'); ?></h3>
    <div class="entry-summary">
      <?php esc_html_e($args['content'], 'jebatimatech'); ?>
    </div>
  </div>
</article>