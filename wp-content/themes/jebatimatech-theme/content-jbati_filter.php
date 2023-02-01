<?php
if (!defined('ABSPATH')) exit;
?>

<div class="filter" id="filter-<?php esc_attr_e($args['slug'], 'jebatimatech'); ?>">
  <h3><?php esc_html_e($args['name'], 'jebatimatech'); ?></h3>
  <?php foreach ($args['filter_items'] as $filter_item) : ?>
    <div class="filter-item-wrapper">
      <input type="checkbox" class="checkbox" id="filter-item-<?php esc_attr_e($filter_item['id'], 'jebatimatech'); ?>" value="<?php esc_attr_e($filter_item['id'], 'jebatimatech'); ?>">
      <label class="label" for="filter-item-<?php esc_attr_e($filter_item['id'], 'jebatimatech'); ?>"><?php esc_html_e($filter_item['name'], 'jebatimatech'); ?></label>
    </div>
  <?php endforeach ?>
</div>