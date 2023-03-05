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


/**
 * Add the rating field to the comment form
 */
add_action( 'comment_form_top', 'jbati_add_star_rating' );

function jbati_add_star_rating() {
  ?>
  <div class="star-rating-wrapper">
    <input class="star star-5" id="star-5" type="radio" value="5" name="jbati_rating"/>
    <label class="star star-5" for="star-5"></label>
    <input class="star star-4" id="star-4" type="radio" value="4" name="jbati_rating"/>
    <label class="star star-4" for="star-4"></label>
    <input class="star star-3" id="star-3" type="radio" value="3" name="jbati_rating"/>
    <label class="star star-3" for="star-3"></label>
    <input class="star star-2" id="star-2" type="radio" value="2" name="jbati_rating"/>
    <label class="star star-2" for="star-2"></label>
    <input class="star star-1" id="star-1" type="radio" value="1" name="jbati_rating"/>
    <label class="star star-1" for="star-1"></label>
  </div>
  <?php
}


/**
 * Validate the comment rating
 */
add_filter( 'pre_comment_on_post', 'jbati_validate_comment_rating', 10, 1 );

function jbati_validate_comment_rating( $comment_post_id ) {
  error_log(print_r($_POST, true));
  if ( ! isset( $_POST['jbati_rating'] ) || empty($_POST['jbati_rating']) ) {
    wp_die( __( 'Erreur: veuillez donner une note à la solution.', 'jebatimatech' ) );
  }
}


/**
 * Save the comment rating along with comment
 */
add_action( 'comment_post', 'jbati_save_comment_rating' );

function jbati_save_comment_rating( $comment_id ) {
  if ( isset( $_POST['jbati_rating'] ) && ! empty($_POST['jbati_rating']) ) {
    add_comment_meta( $comment_id, 'jbati_rating', $_POST['jbati_rating'], true );
  }
}