<?php
/**
 * The template for displaying a list of posts with the 'record' category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 

	<?php if ( have_posts() ) : ?>

		<div class="row">
			<div class="col-sm-9">
				<div class="facetwp-template"> <!-- Allows facets to be displayed -->
					<table id="records" class="table table-striped">
						<thead>
							<tr>
								<th style="width: 25%">Author(s)</th>
								<th style="width: 70%">Title</th>
								<th style="width: 5%">Year</th>
							</tr>
						</thead>
						<tbody>
							<?php while (have_posts()) : the_post(); ?>
								<?php get_template_part('parts/record-loop'); ?> 
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>

				<div id="records_pager">
					<?php echo facetwp_display('pager'); // FacetWP pager/pagination ?>
				</div>
			</div>
			<div class="col-sm-3 record-sidebar">
				<a class="record-header">Search</a>
				<?php echo facetwp_display( 'facet', 'search' ); ?>
				<a class="record-header">Author</a>
				<?php echo facetwp_display( 'facet', 'author' ); ?>
				<a class="record-header">Collection</a>
				<?php echo facetwp_display( 'facet', 'collection' ); ?>
				<a class="record-header">City</a>
				<?php echo facetwp_display( 'facet', 'city' ); ?>
				<a class="record-header">Year</a>
				<?php echo facetwp_display( 'facet', 'year' ); ?>
				<a class="record-header">Language</a>
				<?php echo facetwp_display( 'facet', 'language' ); ?>
				<a class="record-header">People</a>
				<?php echo facetwp_display( 'facet', 'person' ); ?>
				<a class="record-header">Performances</a>
				<?php echo facetwp_display( 'facet', 'performance' ); ?>
				<a class="record-header">Journal</a>
				<?php echo facetwp_display( 'facet', 'journal' ); ?>
				<a class="record-header">Has full-text?</a>
				<?php echo facetwp_display( 'facet', 'full-text' ); ?>
				<a class="record-header">Keywords</a>
				<?php echo facetwp_display( 'facet', 'keywords' ); ?>
			</div>
		</div>

	<?php else : ?>

		<?php get_template_part('includes/template','error'); //wordpress template error message ?>

	<?php endif; ?>

<?php get_template_part( 'parts/page-footer-1col'); ?>

<?php get_footer();
