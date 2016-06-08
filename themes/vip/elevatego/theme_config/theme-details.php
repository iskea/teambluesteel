<?php
define('THEME_NAME', 'duality');
define('THEME_PRETTY_NAME', 'Duality');

//Load Textdomain
add_action('after_setup_theme', 'tt_theme_textdomain_setup');
function tt_theme_textdomain_setup(){
	if(load_theme_textdomain('duality', get_template_directory() . '/languages'))
		define('TT_TEXTDOMAIN_LOADED',true);
}


//content width
if (!isset($content_width))
    $content_width = 1170;

//============Theme support=======
//post-thumbnails
add_theme_support('post-thumbnails');

function tt_add_thumb_sizes() {
    add_image_size( 'featured-image', 960, 210, true );
}
add_action( 'after_setup_theme', 'tt_add_thumb_sizes' );

//add feed support
add_theme_support('automatic-feed-links');