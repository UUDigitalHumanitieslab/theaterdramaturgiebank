<?php
/**
 * The template for displaying the page with the slug "persons".
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Displays all posts of type 'record' in an alphabetical listing.
 */

get_header(); ?>

<?php get_template_part('parts/page-header-1col'); ?> 

<h2>
	Person index
</h2>
<div class="listing">
	<ul>
	<?php
		// Find posts with category person, sorted on last name
		$args = array(
			'post_type'			=> 'post',
			'category_name'		=> 'person',
			'order'				=> 'ASC',
			'meta_key'			=> 'last_name',
			'orderby' 			=> 'meta_value',
			'posts_per_page'	=>	'-1',
		);
		$wp_query = new WP_Query($args);
		$current_first = '';
	?>

	<?php if ($wp_query->have_posts()) : ?>	
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php

		$first = strtoupper(get_field('last_name')[0][0]);
		if ($first != $current_first)
		{
			echo '<h3>' . $first . '</h3>';
			$current_first = $first;
		}
		echo '<li>';
		echo create_anchor('person', get_the_title());
		echo '</li>';

		?>
	<?php endwhile; ?>
	<?php else : ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
	</ul>
</div>

<?php get_template_part('parts/page-footer-1col'); ?> 

<?php get_footer();
