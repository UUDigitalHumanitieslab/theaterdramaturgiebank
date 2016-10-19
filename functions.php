<?php

// Adds a child theme CSS file
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_style', 30 );

function enqueue_child_theme_style() {
	wp_register_style( 'theaterdramaturgiebank', get_stylesheet_uri(), array('uu2014-stylesheet'));
    wp_enqueue_style( 'theaterdramaturgiebank' );
}

// Loads specific translations for this child theme
load_theme_textdomain( 'uu2014-theaterdramaturgiebank', get_stylesheet_directory() . '/languages' );

// Gets post cat slug and looks for single-[cat slug].php and applies it
// Found on: https://wordpress.org/support/topic/how-to-change-single-post-template-based-on-category
add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(STYLESHEETPATH . "/single-{$cat->slug}.php") )
		return STYLESHEETPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);

?>
