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
			<div class="solution-header-top-wrapper">
				<div class="solution-header-image-name-wrapper">
					<?php the_post_thumbnail(); ?>
					<div class="solution-header-name">
						<h1><?php the_title(); ?></h1>
						<h3><?php the_field('categorie_technologie'); ?></h3>
					</div>
				</div>
				<div class="button button-primary">
					<a target="_blank" href="<?php esc_attr_e(the_field('solution_link'), 'jebatimatech'); ?>"><?php esc_html_e('Visiter le site web', 'jebatimatech'); ?></a>
				</div>
			</div>
			<div class="solution-header-bottom-wrapper">
				<ul>
					<li><span class="checkmark <?php echo esc_attr(has_term('productivite', 'categories', get_the_ID()) ? 'active' : '') ?>">✓</span>Productivité</li>
					<li><span class="checkmark <?php echo esc_attr(has_term('securite', 'categories', get_the_ID()) ? 'active' : '') ?>">✓</span>Sécurité</li>
					<li><span class="checkmark <?php echo esc_attr(has_term('environnement', 'categories', get_the_ID()) ? 'active' : '') ?>">✓</span>Environnement</li>
				</ul>
			</div> 
		</section>

		<section class="solution-section solution-content has-side-content">
			<div class="section-content-vertical">
				<h3><?php esc_html_e('EN SAVOIR PLUS', 'jebatimatech'); ?></h3>
				<?php the_content(); ?>
				<div class="content-language">
					<?php echo jbati_get_terms_list('pays_origine', get_the_ID()); ?>
					<?php echo jbati_get_terms_list('langue_du_service', get_the_ID()); ?>
				</div>
				<p><?php echo esc_html__('Sur le marché depuis:', 'jebatimatech') . ' '. get_field('existence_technologie'); ?></p>
			</div>
		</section>

		<section class="solution-section solution-users">
			<h2><?php esc_html_e('Utilisateurs', 'jebatimatech'); ?></h2>
			<div class="section-content">
				<div class="section-main-content jbati-2-columns">
					<?php echo jbati_get_terms_list('taille_entreprise', get_the_ID()); ?>
					<?php echo jbati_get_acf_field_value('moyenne_utilisateur_par_entreprise', get_the_ID()); ?>
					<?php echo jbati_get_terms_list('type_utilisateurs', get_the_ID()); ?>
					<?php echo jbati_get_terms_list('pour_departement', get_the_ID()); ?>
				</div>
				<div class="section-side-content">
					<?php echo jbati_get_terms_list('specialite', get_the_ID(), 'boxes-list'); ?>
				</div>
			</div>
		</section>

		<section class="solution-section solution-projects">
			<h2><?php esc_html_e('Projets', 'jebatimatech'); ?></h2>
			<div class="section-content">
				<div class="section-side-content">
					<?php echo jbati_get_terms_list('categorie_de_projet', get_the_ID()); ?>
					<?php echo jbati_get_terms_list('taille_entreprise', get_the_ID()); ?>
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
				<?php echo jbati_get_acf_field_value('solution_complementaire', get_the_ID()); ?>
			</div>
		</section>

		<section class="solution-section solution-pricing">
			<h2><?php esc_html_e('Tarification', 'jebatimatech'); ?></h2>
			<div class="section-content jbati-3-columns">
				<?php echo jbati_get_acf_field_value('mode_de_tarification', get_the_ID(), true); ?>
				<?php echo jbati_get_acf_field_value('modulation_tarification', get_the_ID(), true); ?>
				<?php echo jbati_get_terms_list('delais_demarrage', get_the_ID(), true); ?>
				<?php echo jbati_get_terms_list('essais_gratuits', get_the_ID(), false); ?>
				<?php echo jbati_get_terms_list('tarification_achat', get_the_ID(), true); ?>
			</div>
		</section>

		<section class="solution-section solution-functionalities">
			<h2><?php esc_html_e('Fonctionalités', 'jebatimatech'); ?></h2>
			<div class="jbati-full-width">
				<?php echo jbati_get_acf_field_value('fonction_principale', get_the_ID()); ?>
			</div>
			<ul class="theme-items">
				<?php foreach( get_the_terms( get_the_ID(), 'fonctions_secondaires' ) as $term ) : ?>
        	<li><span class="checkmark active">✓</span><?php esc_html_e($term->name, 'jebatimatech'); ?></li>
				<?php endforeach; ?>
      </ul>
		</section>

		<section class="solution-section solution-comments">
			<h2><?php esc_html_e('Commentaires', 'jebatimatech'); ?></h2>
			<?php comment_form([
				'label_submit' => esc_html__('Envoyer', 'jebatimatech'),
				'title_reply' => esc_html__('Laisser un commentaire', 'jebatimatech'),
			]); ?>
		</section>
	</main>
</div>

<?php 
get_footer();