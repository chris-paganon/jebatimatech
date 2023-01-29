<?php
if (!defined('ABSPATH')) exit;
?>

<div id="filter-<?php esc_attr_e($args['slug'], 'jebatimatech'); ?>">
  <h3><?php esc_html_e($args['name'], 'jebatimatech'); ?></h3>
  <?php foreach ($args['filter_items'] as $filter_item) : ?>
    <input type="checkbox" id="filter-item-<?php esc_attr_e($filter_item['id'], 'jebatimatech'); ?>" value="<?php esc_attr_e($filter_item['id'], 'jebatimatech'); ?>">
    <label for="filter-item-<?php esc_attr_e($filter_item['id'], 'jebatimatech'); ?>"><?php esc_html_e($filter_item['name'], 'jebatimatech'); ?></label>
  <?php endforeach ?>
</div>