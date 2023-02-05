<?php
if (!defined('ABSPATH')) exit;
?>

<div class="filter" id="filter-<?php esc_attr_e($args['slug'], 'jebatimatech'); ?>">
  <h3><?php esc_html_e($args['name'], 'jebatimatech'); ?></h3>
  <?php foreach ($args['filter_items'] as $filter_item) : ?>
    <div class="filter-item-wrapper">
      <?php 
      switch ($args['type']) {
        case 'taxonomy':
          $input_id = "filter-item-" . $filter_item['id'];
          $filter_name = $filter_item['name'];
          break;
        case 'acf':
          $input_id = "filter-item-$filter_item";
          $filter_name = $filter_item;
          break;
      }
      ?>
      <input type="checkbox" class="checkbox" id="<?php echo esc_attr($input_id); ?>" value="<?php echo esc_attr($input_id); ?>">
      <label class="label" for="<?php echo esc_attr($input_id); ?>"><?php esc_html_e($filter_name, 'jebatimatech'); ?></label>
    </div>
  <?php endforeach ?>
</div>