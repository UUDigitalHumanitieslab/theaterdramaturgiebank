<?php
/**
 * The template for displaying the page with the slug "keywords".
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 

<h2>
	Keywords
</h2>
<div class="listing">
	<ul>
	<?php
		$terms = get_terms(array('taxonomy' => 'keyword', 'hide_empty' => false));
		$current_first = '';
		foreach ($terms as $term)
		{
			$first = strtoupper($term->name[0]);
			if ($first != $current_first)
			{
				echo '<h3>' . $first . '</h3>';
				$current_first = $first;
			}
			echo '<li>';
			echo create_anchor('keywords', $term->name);
			echo '</li>';
		}
	?>
	</ul>
</div>

<?php get_template_part( 'parts/page-footer-1col'); ?> 

<?php get_footer();
