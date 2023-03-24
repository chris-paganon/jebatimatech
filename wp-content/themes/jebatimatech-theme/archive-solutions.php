<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<div class="jbati-intro">
  <h1>Logiciels et équipements pour la construction</h1>
  <p>Parcourez notre lexique dès maintenant pour découvrir des termes clés et des définitions utiles ! Enrichissez votre vocabulaire technologique et trouvez les solutions qui répondent à vos besoins.</p>
</div>

<?php
get_template_part('templates/content', 'jbati_archive');

get_footer();