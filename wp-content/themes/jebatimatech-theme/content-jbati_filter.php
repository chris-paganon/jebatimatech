<?php
if (!defined('ABSPATH')) exit;

foreach ($args as $filter_id => $filter_name) : ?>
  <input type="checkbox" id="filter-item-<?php esc_attr_e($filter_id, 'jebatimatech'); ?>" value="<?php esc_attr_e($filter_id, 'jebatimatech'); ?>">
  <label for="filter-item-<?php esc_attr_e($filter_id, 'jebatimatech'); ?>"><?php esc_html_e($filter_name, 'jebatimatech'); ?></label>
<?php endforeach ?>