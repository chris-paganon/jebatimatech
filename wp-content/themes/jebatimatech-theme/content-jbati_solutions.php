<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="inside-article">
    <h2><?php the_title(); ?></h2>
    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div>
  </div>
</article>