<?php
if ( !defined( 'ABSPATH' ) ) exit;

add_action('init', 'jbati_register_software_post_type');

function jbati_register_software_post_type() {
  $labels = array(
    'name'               => __( 'Solutions', 'jebatimatech' ),
    'singular_name'      => __( 'Solution', 'jebatimatech' ),
    'menu_name'          => __( 'Solutions', 'jebatimatech' )
  );
    $args = array(
    'labels'        => $labels,
    'description'   => 'Logiciels et équipements',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'comments', 'revisions', 'author', 'excerpt', 'thumbnail', 'custom-fields' ),
    'has_archive'   => true,
  );
  register_post_type( 'jbati_solutions', $args );
}