<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part( 'parts/page-header-2col'); ?> 

	<?php if ( have_posts() ) : ?>

		<div class="facetwp-template"> <!-- Allows facets to be displayed -->
			<table id="entries" class="table table-striped">
				<thead>
					<tr>
						<th>Auteur(s)</th>
						<th>Titel</th>
						<th>Jaar</th>
					</tr>
				</thead>
				<tbody>
					<?php while (have_posts()) : the_post(); ?>

						<?php get_template_part( 'parts/entry-loop'); ?> 

					<?php endwhile; ?>
				</tbody>
			</table>
		</div>

			<?php get_template_part('includes/template','pager'); //wordpress template pager/pagination ?>

	<?php else : ?>

		<?php get_template_part('includes/template','error'); //wordpress template error message ?>

	<?php endif; ?>

<?php get_template_part( 'parts/page-footer-2col'); ?>

<?php get_footer();
