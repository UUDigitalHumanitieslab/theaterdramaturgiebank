<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 

	<?php if ( have_posts() ) : ?>

		<div class="row">
			<div class="col-sm-9">
				<div class="facetwp-template"> <!-- Allows facets to be displayed -->
					<h2>Gevonden resultaten</h2>
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

								<?php get_template_part('parts/entry-loop'); ?> 

							<?php endwhile; ?>
						</tbody>
					</table>
				</div>

				<div id="entries_pager">
					<?php echo facetwp_display('pager'); // FacetWP pager/pagination ?>
				</div>
			</div>
			<div class="col-sm-3 entry">
				<h2>Filters</h2>
				<a class="entry-header">Auteur</a>
				<?php echo facetwp_display( 'facet', 'author' ); ?>
				<a class="entry-header">Plaats van publicatie</a>
				<?php echo facetwp_display( 'facet', 'cities' ); ?>
				<a class="entry-header">Jaar</a>
				<?php echo facetwp_display( 'facet', 'year' ); ?>
				<a class="entry-header">Keywords</a>
				<?php echo facetwp_display( 'facet', 'tags' ); ?>
				<a class="entry-header">Zoek</a>
				<?php echo facetwp_display( 'facet', 'search' ); ?>

			</div>

		</div>

	<?php else : ?>

		<?php get_template_part('includes/template','error'); //wordpress template error message ?>

	<?php endif; ?>

<?php get_template_part( 'parts/page-footer-1col'); ?>

<?php get_footer();
