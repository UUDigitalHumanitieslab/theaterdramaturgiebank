<?php

/**
 * This file contains functions and hooks for this child theme.
 */

// Sets the search page used throughout this child theme
defined('SEARCH_PAGE') or define('SEARCH_PAGE', '/category/record/?fwp_sort=year_desc');

// Adds a child theme CSS file
add_action('wp_enqueue_scripts', 'enqueue_child_theme_style', 30);

function enqueue_child_theme_style() {
	wp_register_style('theaterdramaturgiebank', get_stylesheet_uri(), array('uu2014-stylesheet'));
    wp_enqueue_style('theaterdramaturgiebank');
}

// Loads specific translations for this child theme
load_theme_textdomain('uu2014-theaterdramaturgiebank', get_stylesheet_directory() . '/languages');

// Gets post cat slug and looks for single-[cat slug].php and applies it
// Found on: https://wordpress.org/support/topic/how-to-change-single-post-template-based-on-category
add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(STYLESHEETPATH . "/single-{$cat->slug}.php") )
		return STYLESHEETPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);

// On save, set the full-text to TRUE iff the post has content
function my_save_post($post_id)
{
	$has_content = (bool) get_post_field('post_content', $post_id);
	update_field('full-text', $has_content, $post_id);
}

add_action('save_post', 'my_save_post');

/*********************/
/* Facet WP
/*********************/

// Display the ACF-fields with a link back to the search page
function create_anchor($field, $value, $label = NULL)
{
	if (!$label)
	{
		$label = $value;
	}

	$anchor = SEARCH_PAGE . '&fwp_' . $field;
	$anchor .= '=' . sanitize_title_with_dashes($value);  // TODO: does not work for items with a '.'
	return '<a href="' . $anchor . '">' . $label . '</a>';
}

// Display the link back to the search page for repeater fields (viz. authors, languages, people, performances)
function create_repeater_anchor($field, $value)
{
	$subs = array(
		'authors'		=> 'author',
		'languages'		=> 'language',
		'people'		=> 'person',
		'performances'	=> 'performance',
	);
	$anchors = array();
	foreach ($value as $sub)
	{
		$s_key = $subs[$field];
		$s_value = $sub[$s_key];
		if ($s_value)
		{
			array_push($anchors, create_anchor($s_key, $s_value));
		}
	}
	
	return implode(', ', $anchors);
}

// Display the link back for years using the min-max notation
function create_year_anchor($field, $value)
{
	$link = SEARCH_PAGE;
	$link .= '&fwp_' . $field . '=' . $value . '%2C ' . $value;
	return '<a href="' . $link . '">' . $value . '</a>';
}

// For collections, display a link to the individual post
function create_collection_anchor($field, $value)
{
	return '<a href="' . get_permalink($value->ID) . '">' . $value->post_title . '</a>';
}

// Add sorting on year, remove sorting on date
function my_facetwp_sort_options($options, $params)
{
	$options['year_asc'] = array(
		'label' => 'Year (ascending)',
		'query_args' => array(
			'orderby'	=> 'meta_value_num',
			'meta_key'	=> 'year',
			'order'		=> 'ASC',
		)
	);
	$options['year_desc'] = array(
		'label' => 'Year (descending)',
		'query_args' => array(
			'orderby'	=> 'meta_value_num',
			'meta_key'	=> 'year',
			'order'		=> 'DESC',
		)
	);
	$options['default']['query_args'] = $options['year_desc']['query_args'];
	unset($options['date_desc']);
	unset($options['date_asc']);
	return $options;
}

add_filter('facetwp_sort_options', 'my_facetwp_sort_options', 10, 2);

/*********************/
/* WP All Import
/*********************/

require 'libraries/Parsedown.php';

// Uses Parsedown to convert Markdown to HTML. See https://github.com/erusev/parsedown for details. Used in WP All Import.
function markdown_to_html($str)
{
	$Parsedown = new Parsedown();
	return $Parsedown->text($str);
}

?>
