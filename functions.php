<?php

// Adds a child theme CSS file
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_style', 30 );

function enqueue_child_theme_style() {
	wp_register_style( 'theaterdramaturgiebank', get_stylesheet_uri(), array('uu2014-stylesheet'));
    wp_enqueue_style( 'theaterdramaturgiebank' );
}

// Loads specific translations for this child theme
load_theme_textdomain( 'uu2014-theaterdramaturgiebank', get_stylesheet_directory() . '/languages' );

// Register Keyword Taxonomy (hiearchical)
function keywords_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Keywords', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Keyword', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Keywords', 'text_domain' ),
		'all_items'                  => __( 'All Keywords', 'text_domain' ),
		'parent_item'                => __( 'Parent Keyword', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Keyword:', 'text_domain' ),
		'new_item_name'              => __( 'New Keyword Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Keyword', 'text_domain' ),
		'edit_item'                  => __( 'Edit Keyword', 'text_domain' ),
		'update_item'                => __( 'Update Keyword', 'text_domain' ),
		'view_item'                  => __( 'View Keyword', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate keywords with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove keywords', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Keywords', 'text_domain' ),
		'search_items'               => __( 'Search Keywords', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Keywords list', 'text_domain' ),
		'items_list_navigation'      => __( 'Keywords list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'keyword', array( 'post' ), $args );
}
add_action( 'init', 'keywords_taxonomy', 0 );

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
function create_anchor($label, $value)
{
	$anchor = '/category/record/?fwp_' . strtolower($label);
	$anchor .= '=' . sanitize_title_with_dashes($value);  // TODO: does not work for items with a '.'
	return '<a href="' . $anchor . '">' . $value . '</a>';
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
	unset($options['date_desc']);
	unset($options['date_asc']);
	return $options;
}

add_filter('facetwp_sort_options', 'my_facetwp_sort_options', 10, 2);

?>
