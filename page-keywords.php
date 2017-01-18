<?php
/**
 * The template for displaying the page with the slug "keywords".
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * This page will output all terms of the taxonomy "keyword" as a alphabetical listing.
 */

get_header(); ?>

<?php get_template_part('parts/page-header-1col'); ?> 

<h2>
	Keyword index
</h2>
<div class="listing">
	<ul>
	<?php
		$terms = get_terms(array('taxonomy' => 'keyword', 'hide_empty' => FALSE));
		$current_first = '';
		foreach ($terms as $term)
		{
			$first = strtoupper($term->name[0]);
			if ($first != $current_first)
			{
				// We found a new first character, create a new sub-heading
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

<?php get_template_part('parts/page-footer-1col'); ?> 

<?php get_footer();
