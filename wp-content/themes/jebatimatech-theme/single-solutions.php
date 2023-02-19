<?php 
/**
 * The template for displaying the soltuions Archive page.
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div <?php generate_do_attr( 'content' ); ?>>
	<main <?php generate_do_attr( 'main' ); ?>>
		<section class="solution-section solution-header">
			<?php the_post_thumbnail(); ?>
			<div class="solution-header-name">
				<h1><?php the_title(); ?></h1>
				<h3><?php the_field('categorie_technologie'); ?></h3>
			</div>
			<div class="button button-primary">
				<a target="_blank" href="<?php esc_attr_e(the_field('compagnie'), 'jebatimatech'); ?>"><?php esc_html_e('Visiter le site web', 'jebatimatech'); ?></a>
			</div>
		</section>

		<section class="solution-section solution-content has-side-content">
			<div class="section-content">
				<div class="section-main-content">
					<h3><?php esc_html_e('EN SAVOIR PLUS SUR BIOLIFT', 'jebatimatech'); ?></h3>
					<?php the_content(); ?>
					<div class="content-language">
						<?php echo jbati_get_terms_list('pays_origine', get_the_ID()); ?>
						<?php echo jbati_get_terms_list('langue_du_service', get_the_ID()); ?>
					</div>
					<p><?php echo esc_html__('Sur le marché depuis:', 'jebatimatech') . ' '. get_field('existence_technologie'); ?></p>
				</div>
				<div class="section-side-content">
					<h4><?php esc_html_e('Options de tarifications dès:', 'jebatimatech'); ?></h4>
				</div>
			</div>
		</section>

		<section class="solution-section solution-users">
			<h2><?php esc_html_e('Utilisateurs', 'jebatimatech'); ?></h2>
			<div class="section-content">
				<div class="section-main-content jbati-2-columns">
					<?php echo jbati_get_terms_list('envergure_clientele_visee', get_the_ID()); ?>
					<?php echo jbati_get_acf_field_value('moyenne_utilisateur_par_entreprise', get_the_ID()); ?>
					<?php echo jbati_get_terms_list('categorie_de_clientele', get_the_ID()); ?>
					<?php echo jbati_get_terms_list('pour_departement', get_the_ID()); ?>
				</div>
				<div class="section-side-content">
					<?php echo jbati_get_terms_list('disciplines_construction', get_the_ID(), 'boxes-list'); ?>
				</div>
			</div>
		</section>

		<section class="solution-section solution-projects">
			<h2><?php esc_html_e('Projets', 'jebatimatech'); ?></h2>
			<div class="section-content">
				<div class="section-side-content">
					<?php echo jbati_get_terms_list('categorie_de_projet', get_the_ID()); ?>
					<?php echo jbati_get_terms_list('envergure_de_projets', get_the_ID()); ?>
				</div>
				<div class="section-main-content">
					<?php echo jbati_get_terms_list('phases_de_projet', get_the_ID(), 'boxes-list'); ?>
				</div>
			</div>
		</section>

		<section class="solution-section solution-specifications">
			<h2><?php esc_html_e('Sécifications', 'jebatimatech'); ?></h2>
			<div class="section-content jbati-3-columns">
				<?php echo jbati_get_acf_field_value('pourcent_quebecois', get_the_ID()); ?>
				<?php echo jbati_get_terms_list('delais_demarrage', get_the_ID()); ?>
				<?php echo jbati_get_terms_list('import_export', get_the_ID()); ?>
				<?php echo jbati_get_acf_field_value('pourcent_quebecois_service', get_the_ID()); ?>
				<?php echo jbati_get_acf_field_value('equipement_fonctionne_avec_logiciel', get_the_ID()); ?>
			</div>
		</section>

		<section class="solution-section solution-functionalities">
			<h2><?php esc_html_e('Fonctionalités', 'jebatimatech'); ?></h2>
			<?php echo jbati_get_acf_field_value('fonction_principale', get_the_ID()); ?>
			<?php echo jbati_get_terms_list('themes', get_the_ID()); ?>
		</section>
	</main>
</div>

<?php 
get_footer();