<?php
if (!defined('ABSPATH')) exit;
?>

<div class="filter" id="filter-<?php esc_attr_e($args['slug'], 'jebatimatech'); ?>">
  <h3><?php esc_html_e($args['label'], 'jebatimatech'); ?></h3>
  <?php foreach ($args['filter_items'] as $filter_item) : ?>
    <div class="filter-item-wrapper">
      <input type="checkbox" class="checkbox" id="filter-item-<?php echo esc_attr($filter_item['slug']); ?>" value="filter-item-<?php echo esc_attr($filter_item['slug']); ?>">
      <label class="label" for="filter-item-<?php echo esc_attr($filter_item['slug']); ?>"><?php esc_html_e($filter_item['label'], 'jebatimatech'); ?></label>
    </div>
  <?php endforeach ?>
</div>