<?php
/**
 * The template for displaying a list of posts with the 'collection' category.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Displays all collections in a single-column page
 */

get_header(); ?>

<?php get_template_part('parts/page-header-1col'); ?> 

	<?php
		// Order the collections by title, ascending. Preserve other query parameters.
		global $wp_query;
		$args = array_merge($wp_query->query_vars, array('orderby' => 'title', 'order' => 'ASC'));
		query_posts($args);
	?>

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part('parts/collection-loop'); ?>

		<?php endwhile; ?>

		<?php get_template_part('includes/template','pager'); // WordPress template pager/pagination ?>

	<?php else : ?>

		<?php get_template_part('includes/template', 'error'); // WordPress template error message ?>

	<?php endif; ?>

<?php get_template_part('parts/page-footer-1col'); ?>

<?php get_footer();
