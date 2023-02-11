<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$categorie_technologie_value = '';
$compagnie_value = '';
foreach ($args['properties'] as $property) {
  switch ($property['slug']) {
    case 'categorie_technologie':
      $categorie_technologie_value = $property['values'][0]['label'];
      break;
    case 'compagnie':
      $compagnie_value = $property['values'][0]['label'];
      break;
  }
}
?>

<article id="post-<?php esc_attr_e($args['id'], 'jebatimatech'); ?>" data-solution-id="<?php esc_attr_e($args['id'], 'jebatimatech'); ?>" class="jbati-solution active">
  <div class="inside-article">
    <div class="solution-item-header">
      <div class="entry-thumbnail">
        <?php echo get_the_post_thumbnail($args['id'], 'medium'); ?>
      </div>
      <h3><?php esc_html_e($args['title'], 'jebatimatech'); ?></h3>
      <div class="button button-primary">
        <a target="_blank" href="<?php esc_attr_e($compagnie_value, 'jebatimatech'); ?>"><?php esc_html_e('Visiter le site web', 'jebatimatech'); ?></a>
      </div>
    </div>
    <div class="entry-summary">
      <?php esc_html_e($args['content'], 'jebatimatech'); ?>
    </div>
    <div class="solution-footer">
      <h4>Fonctionalitées</h4>
      <ul>
        <li><span class="checkmark <?php echo esc_attr(get_functionality_class($args, 'productivite')) ?>">✓</span>Productivité</li>
        <li><span class="checkmark <?php echo esc_attr(get_functionality_class($args, 'securite')) ?>">✓</span>Sécurité</li>
        <li><span class="checkmark <?php echo esc_attr(get_functionality_class($args, 'environnement')) ?>">✓</span>Environnement</li>
      </ul>
    </div> 
  </div>
</article>