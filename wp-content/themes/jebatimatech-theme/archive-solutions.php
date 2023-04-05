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
  <h1>Pour obtenir des suggestions et des résultats de recherche</h1>
  <p>Sélectionnez à gauche des critères de recherche qui correspondent à votre profil.</p>
  <br>
  <p>Ils vous permettront de trouver et filtrer différentes technologies disponibles pour vous. Plus vous en sélectionnerez, plus les technologies trouvées ou suggérées seront précises et restraintes.</p>
  <br>
  <p>Si des critères disparaissent dans les filtres, cela indique qu'aucune technologie trouvée ou suggérée ne correspondent à ces critères.</p>
</div>

<?php
get_template_part('templates/content', 'jbati_archive');

get_footer();