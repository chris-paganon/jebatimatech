<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$categorie_technologie_value = '';
$solution_link = '';
foreach ($args['properties'] as $property) {
  switch ($property['slug']) {
    case 'categorie_technologie':
      $categorie_technologie_value = $property['values'][0]['label'];
      break;
    case 'solution_link':
      $solution_link = $property['values'][0]['label'];
      break;
  }
}
?>

<article id="post-<?php esc_attr_e($args['id'], 'jebatimatech'); ?>" data-solution-id="<?php esc_attr_e($args['id'], 'jebatimatech'); ?>" class="jbati-solution active">
  <div class="inside-article">
    <div class="solution-item-header">
      <div class="solution-item-header-title-wrapper">
        <div class="entry-thumbnail">
          <?php echo get_the_post_thumbnail($args['id']); ?>
        </div>
        <a href="<?php echo esc_attr($args['link']); ?>">
          <h3><?php esc_html_e($args['title'], 'jebatimatech'); ?></h3>
        </a>
      </div>
      <div class="solution-item-header-link-wrapper">
        <div class="button button-primary">
          <a target="_blank" href="<?php esc_attr_e($solution_link, 'jebatimatech'); ?>"><?php esc_html_e('Visiter le site web', 'jebatimatech'); ?></a>
        </div>
      </div>
    </div>
    <div class="entry-summary">
      <?php esc_html_e($args['content'], 'jebatimatech'); ?>
    </div>
    <div class="solution-footer">
      <ul>
        <li><span class="checkmark <?php echo esc_attr(get_functionality_class($args, 'productivite')) ?>">✓</span>Productivité</li>
        <li><span class="checkmark <?php echo esc_attr(get_functionality_class($args, 'securite')) ?>">✓</span>Sécurité</li>
        <li><span class="checkmark <?php echo esc_attr(get_functionality_class($args, 'environnement')) ?>">✓</span>Environnement</li>
      </ul>
    </div> 
  </div>
</article>