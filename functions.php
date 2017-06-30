<?php

/**
 * This file contains functions and hooks for this child theme.
 */

// Sets the search page used throughout this child theme
defined('SEARCH_PAGE') or define('SEARCH_PAGE', '/category/record/?fwp_per_page=10');

// Adds child theme CSS files
function enqueue_child_theme_styles()
{
	wp_register_style('theaterdramaturgiebank', get_stylesheet_uri(), array('uu2014-stylesheet'));
    wp_enqueue_style('theaterdramaturgiebank');
}

add_action('wp_enqueue_scripts', 'enqueue_child_theme_styles');

// Adds child theme JavaScript files
function enqueue_child_theme_scripts()
{
    wp_register_script('excerpts', get_stylesheet_directory_uri() . '/js/excerpts.js', array('jquery'));
    wp_enqueue_script('excerpts');
}

add_action('wp_enqueue_scripts', 'enqueue_child_theme_scripts');

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


// Find posts with category record and having collection the current collection, and order by name
function collection_linked_records($post_id) {
	$args = array(
		'post_type'			=> 'post',
		'category_name'		=> 'record',
		'meta_query'		=> array(
			array(
				'key'		=> 'collection',
				'value'		=> $post_id,
				'compare'	=> '=',
			)
		),
		'meta_key'			=> 'year',
		'orderby'			=> 'meta_value',
		'posts_per_page'	=>	'-1',
	);

	return new WP_Query($args);
}

/*********************/
/* Facet WP functions and hooks
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

function year_uncertain()
{
	return get_field('year_uncertain') ? '?' : '';
}

// Display the link back for years using the min-max notation
function create_year_anchor($field, $value)
{
	$link = SEARCH_PAGE;
	$link .= '&fwp_' . $field . '=' . $value . '%2C ' . $value;
	return '<a href="' . $link . '">' . $value . '</a>' . year_uncertain();
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
	$options['default']['label'] = 'Relevance';
	unset($options['date_desc']);
	unset($options['date_asc']);
	unset($options['title_desc']);
	return $options;
}

add_filter('facetwp_sort_options', 'my_facetwp_sort_options', 10, 2);

// Custom per page options
add_filter('facetwp_per_page_options', function($options) {
    return array(10, 25, 50);
});

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

/*********************/
/* Single usage scripts
/*********************/

//add_action('after_setup_theme', 'set_type_miscellaneous');

// Sets the 'type' ACF field to lowercase
function set_type_lowercase()
{
	$posts = get_posts(array('post_type' => 'post', 'category_name' => 'record', 'numberposts' => -1));
	foreach ($posts as $post)
	{
		$id = $post->ID;
		$lower_type = strtolower(get_field('type', $id));

		update_field('type', $lower_type, $id);
	}
}

// Set the 'type' ACF field to 'YZ miscellaneous' if it's currently 'yz'
function set_type_miscellaneous()
{
	$posts = get_posts(array('post_type' => 'post', 'category_name' => 'record', 'numberposts' => -1));
	foreach ($posts as $post)
	{
		$id = $post->ID;
		if (get_field('type', $id) == 'yz')
		{
			update_field('type', 'YZ miscellaneous', $id);
		}
	}
}
