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

?>
