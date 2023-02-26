<?php
if (!defined('ABSPATH')) exit;
?>

<div class="filter jbati-accordion-item" id="filter-<?php esc_attr_e($args['slug'], 'jebatimatech'); ?>">
  <?php if ($args['show_title']) : ?>
    <h3 class="filter-title jbati-accordion-button"><?php esc_html_e($args['label'], 'jebatimatech'); ?></h3>
  <?php endif ?>
  <div class="filter-items-wrapper jbati-accordion-content <?php if (!$args['show_title']) echo 'active'; ?>">
    <?php foreach ($args['filter_items'] as $filter_item) : ?>
      <?php if($filter_item['show']) : ?>
        <div class="filter-item-wrapper">
          <input type="checkbox" class="checkbox" id="filter-item-<?php echo esc_attr($filter_item['slug']); ?>" value="filter-item-<?php echo esc_attr($filter_item['slug']); ?>">
          <label class="label" for="filter-item-<?php echo esc_attr($filter_item['slug']); ?>"><?php esc_html_e($filter_item['label'], 'jebatimatech'); ?></label>
        </div>
      <?php endif ?>
    <?php endforeach ?>
  </div>
</div>