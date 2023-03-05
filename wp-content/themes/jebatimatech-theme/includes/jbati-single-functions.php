<?php
if (!defined('ABSPATH')) exit;


/**
 * Overwrite the label of the comment form field placeholders
 */
add_filter( 'comment_form_default_fields', 'jbati_overwrite_comment_fields', 10, 1 );

function jbati_overwrite_comment_fields( $fields ) {
  unset($fields['url']);
  $fields['author'] = str_replace( 'Name', 'Nom', $fields['author'] );
  $fields['email'] = str_replace( 'Email', 'Courriel', $fields['email'] );
  return $fields;
}