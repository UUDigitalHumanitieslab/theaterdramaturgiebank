<?php
/**
 * The template for displaying the page with the slug "keywords".
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<?php get_template_part( 'parts/page-header-1col'); ?> 

<?php
	wp_list_categories(array('taxonomy' => 'keyword', 'title_li' => '<h2>Keywords</h2>'));
?>

<?php get_template_part( 'parts/page-footer-1col'); ?> 

<?php get_footer();
