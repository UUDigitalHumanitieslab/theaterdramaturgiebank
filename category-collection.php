<?php
/**
 * The template for displaying a list of posts with the 'collection' category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part('parts/page-header-1col'); ?> 

	<?php if ( have_posts() ) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part( 'parts/post-loop'); ?> 

		<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part('includes/template', 'error'); //wordpress template error message ?>

	<?php endif; ?>

<?php get_template_part('parts/page-footer-1col'); ?>

<?php get_footer();
