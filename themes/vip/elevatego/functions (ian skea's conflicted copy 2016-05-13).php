<?php
/*
add_theme_support( 'menus' );

function register_theme_menus() {
	register_nav_menus(
		array(
			'primary-menu' 	=> __( 'Primary Menu', 'main' )
		)
	);
}
add_action( 'init', 'register_theme_menus' );
*/

/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */



/***********************************************************************************************/
/* Custom Functions */
/***********************************************************************************************/
function tt_excerpt( $id, $length = NULL ) {
	$length = !empty($length) ? $length : 55;
	$content = apply_filters( 'the_content', get_post_field('post_content', $id));
	$content = strip_shortcodes($content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = strip_tags($content);
	$content = substr($content, 0, $length);
	print $content;
}

function tt_load_composer() {
	if (class_exists('Vc_Manager')) {
		vc_set_shortcodes_templates_dir(TEMPLATEPATH . '/theme_config/vc_shortcodes');
		require_once(TEMPLATEPATH . '/theme_config/vc_shortcodes/theme_shortcodes.php');
		require_once(TEMPLATEPATH . '/theme_config/vc_shortcodes/rewrite_map.php');
		include_once(TEMPLATEPATH . '/theme_config/vc_shortcodes/params/google_map.php' );

	}
}
add_action('init','tt_load_composer');






/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Header Menu', 'twentysixteen' ),
		'social'  => __( 'Footer Menu', 'twentysixteen' ),

	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	//wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );


	// Theme stylesheet.
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/css/bootstrap.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'elevate-wp-style', get_template_directory_uri().'/css/elevate-wp.css' );



	// Theme stylesheet.
	wp_enqueue_style( 'bootstrap-style-elevate-arpita', get_template_directory_uri().'/css/elevate-wp_arpita.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'bootstrap-style-elevate-angela', get_template_directory_uri().'/css/elevate-wp_angela.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'bootstrap-style-elevate-edo', get_template_directory_uri().'/css/elevate-wp_edo.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'bootstrap-style-elevate-simon', get_template_directory_uri().'/css/elevate-wp_simon.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'bootstrap-style-elevate-piconfonts', get_template_directory_uri().'/css/piconfonts.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'bootstrap-style-elevate-wp-hack', get_template_directory_uri().'/css/mq_wp-hack.css' );




	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160412' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160412' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160412' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );



	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160412', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
	//	wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160412' );
	}

	//wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160412', true );
	wp_enqueue_script( 'elevate-wordpress-jquery', get_template_directory_uri() . '/js/jquery-2.2.3.min.js' );
	wp_enqueue_script( 'elevate-wordpress-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js' );
	wp_enqueue_script( 'elevate-wordpress-jquery_waypoints', get_template_directory_uri() . '/js/jquery.min.js' );
	wp_enqueue_script( 'elevate-wordpress-jquery2', get_template_directory_uri() . '/js/jquery.waypoints.min.js' );
	wp_enqueue_script( 'fingerprint-javascript', get_template_directory_uri() . '/js/fingerprint2.min.js' );
	wp_enqueue_script( 'elevate-wordpress-javascript', get_template_directory_uri() . '/js/elevate-wp.js' );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

include_once(TEMPLATEPATH . '/js_composer.php' );


function buildTree(array &$elements, $parentId = 0)
{
	$branch = array();
	foreach ($elements as &$element) {
		if ($element->menu_item_parent == $parentId) {
			$children = buildTree($elements, $element->ID);
			if ($children)
				$element->wpse_children = $children;

			$branch[$element->ID] = $element;
			unset($element);
		}
	}
	return $branch;
}

// $tree = return_nav_array( 'primary' );  // <-- Modify this to your needs!
//var_dump( $tree );

add_action( 'init', 'elv_tiles_post_type' );
function elv_tiles_post_type() {
	register_post_type( 'elv_tiles',
		array(
			'labels' => array(
				'name' => __( 'Tiles' ),
				'singular_name' => __( 'Tile' )
			),
			'public' => true,
			'has_archive' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-screenoptions',
			'description' => 'Modular callout tiles',
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies' => array( 'category', 'post_tag' ),
			'exclude_from_search' => true,
			'publicly_queryable' => false,
		)
	);
	//register_taxonomy_for_object_type( 'category', 'tags' );
}
flush_rewrite_rules();

$prefix = 'elv_tiles_';
$meta_box = array(
	'id' => 'tile-meta-box',
	'title' => 'Tile Information',
	'page' => 'elv_tiles',
	'context' => 'normal',
	'priority' => 'high',
	'taxonomies' => array('category'),
	'rewrite' => array('slug' => 'tiles'),
	'fields' => array(
		array(
			'desc' => 'Please select the class',
			'id' => $prefix . 'class',
			'name' => 'Background Colour:',
			'options' => array(
				'bg-blue' => 'Blue',
				'bg-grey' => 'Grey',
				'bg-grey-dark' => 'Dark Grey'
			),
			'std' => 'Background Class',
			'type' => 'select'
		),
		array(
			'desc' => 'Please enter the link for this tile',
			'id' => $prefix . 'link',
			'name' => 'Tile Link:',
			'std' => '/this-is-the-link/',
			'type' => 'text',
		),
		array(
			'desc' => 'Please enter the Sort Order',
			'id' => $prefix . 'sort',
			'name' => 'Sort Order:',
			'std' => '0',
			'type' => 'text',
		),
		array(
			'desc' => 'Please select pop-up type',
			'id' => $prefix . 'ptype',
			'name' => 'Pop-up Type:',
			'options' => array(
				'book' => 'Booking',
				'alert' => 'Alert',
				'subscribe' => 'Subscribe',
			),
			'std' => 'Menu Name',
			'type' => 'select'
		),
		array(
			'desc' => 'Please heading',
			'id' => $prefix . 'pSubscribeHeading',
			'name' => 'Subscribe Heading:',
			'std' => 'Subscribe to get expert advice and exclusive deals direct to your inbox',
			'type' => 'text',
		),
		array(
			'desc' => 'Please enter Booking Popup Heading',
			'id' => $prefix . 'pBookingHeading',
			'name' => 'Booking Popup Heading:',
			'std' => 'Mark Bouris',
			'type' => 'text',
		),
		array(
			'desc' => 'Please enter Booking Sub Heading',
			'id' => $prefix . 'pSubBookingHeading',
			'name' => 'Booking Sub Heading:',
			'std' => 'Ways to pay off your mortgage sooner',
			'type' => 'text',
		),
		array(
			'desc' => 'Please enter Booking Time | Locations  ',

			'id' => $prefix . 'pBookingTimeLocations',
			'name' => 'Booking Time | Locations:',
			'std' => '12.30pm | Conference Room, 1 Shelley Street, Sydney NSW 2000',
			'type' => 'text',
		),
		array(
			'desc' => 'Please enter Booking Date  ',

			'id' => $prefix . 'pBookingDate',
			'name' => 'Booking Date:',
			'std' => '21 May 2015',
			'type' => 'text',
		),
		array(
			'desc' => 'Please Booking Background Image',

			'id' => $prefix . 'pBooking',
			'name' => 'Booking Background Image:',
			'std' => 'http://www.macquarie.com/dafiles/Internet/mgl/au/personal/media/homepage/images/home-offer-1.jpg',
			'type' => 'text',
		),
		array(
			'desc' => 'Please enter URL for Alert Image',

			'id' => $prefix . 'alertImage',
			'name' => 'Alert Image:',
			'std' => 'Image or Javascript',
			'type' => 'text',
		),
		array(
			'desc' => 'Please enter Alert Heading',
			'id' => $prefix . 'alertHeading',
			'name' => 'Alert Heading:',
			'std' => 'unchanged at 2.0%',
			'type' => 'text',
		),
		array(
			'desc' => 'Please enter Alert Button 1 Link',
			'id' => $prefix . 'alertButton1',
			'name' => 'Alert Button 1 Link:',
			'std' => 'www.macquarie.com/fullstatement',
			'type' => 'text',
		),
		array(
			'desc' => 'Please enter Alert Button 1 Text',
			'id' => $prefix . 'alertButton1text',
			'name' => 'Alert Button 1 Text:',
			'std' => 'Read Full Statement',
			'type' => 'text',
		),
		array(
			'desc' => 'Please enter Alert Button 2 Link',
			'id' => $prefix . 'alertButton2',
			'name' => 'Alert Button 2 Link:',
			'std' => 'www.macquarie.com/home-loans',
			'type' => 'text',
		),
		array(
			'desc' => 'Please enter Alert Button 2 Text',
			'id' => $prefix . 'alertButton2text',
			'name' => 'Alert Button 2 Text:',
			'std' => 'View our home loans',
			'type' => 'text',
		),
	)
);
flush_rewrite_rules();

add_action('admin_menu', 'tiles_add_box');
function tiles_add_box() {
	global $meta_box;
	add_meta_box($meta_box['id'], $meta_box['title'], 'meta_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function meta_show_box() {
	global $meta_box, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tiles_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);

		echo '<tr>',
			'<th style="width:15%"><label for="' .  $field['id'] . '">' . $field['name'] . '</label></th>',
		'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . ($meta ? $meta : $field['std']) . '" size="30" style="width:97%" />' . '<br />' . $field['desc'];
				break;
			case 'textarea':
				echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '" cols="60" rows="4" style="width:97%">' . $meta ? $meta : $field['std'] . '</textarea>' . '<br />' . $field['desc'];
				break;
			case 'select':
				echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '">' . PHP_EOL;
				foreach ($field['options'] as $k => $v) {
					echo '<option value="'. $k .'" '. selected( $meta, $k, false ) . '>'. $v .'</option>' . PHP_EOL;
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="' . $field['id'] . '" value="' . $option['value'] . '"' . $meta == $option['value'] ? ' checked="checked"' : '' . ' />' . $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '"' . $meta ? ' checked="checked"' : '' . ' />';
				break;
		}
		echo     '</td><td>' . PHP_EOL .
			'</td></tr>';
	}
	echo '</table>';
}


add_action('save_post', 'tiles_save_data');
function tiles_save_data( $i_post_id ) {
	global $meta_box;

	if( !empty( $meta_box ) ) {

		// verify nonce
		if ( isset($_POST['tiles_meta_box_nonce']) && !wp_verify_nonce($_POST['tiles_meta_box_nonce'], basename(__FILE__)) ) {
			return $i_post_id;
		}

		// check autosave
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
			return $i_post_id;
		}

		// check permissions
		if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
			if (!current_user_can('edit_page', $i_post_id)) {
				return $i_post_id;
			}
		} elseif ( !current_user_can('edit_post', $i_post_id) ) {
			return $i_post_id;
		}

		foreach ( $meta_box['fields'] as $field ) {
			$s_old = '';
			$s_old = get_post_meta($i_post_id, $field['id'], true);

			$s_new = '';
			if( isset($_POST[$field['id']]) ) {
				$s_new = $_POST[$field['id']];
			}

			if ( $s_new != $s_old ) {
				update_post_meta( $i_post_id, $field['id'], $s_new );
			} elseif ( '' == $s_new && $s_old ) {
				delete_post_meta( $i_post_id, $field['id'], $s_old );
			}
		}
	}
}


/**
 *Setup of the FEATURES custom post type
 *
 * @since 1.0.0
 * @author Ian Skea
 *
 */

add_action( 'init', 'elv_feature_post_type' );

function elv_feature_post_type() {
	register_post_type( 'elv_feature',
		array(
			'labels' => array(
				'name' => __( 'Menu Features' ),
				'singular_name' => __( 'Menu Feature' )
			),
			'public' => true,
			'has_archive' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-align-center',
			'description' => 'Modular feature items',
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies' => array( 'category', 'post_tag' )
		)
	);
	//register_taxonomy_for_object_type( 'category', 'tags' );
}
flush_rewrite_rules();

add_action( 'init', 'elv_authors_post_type' );

function elv_authors_post_type() {
	register_post_type( 'elv_authors',
		array(
			'labels' => array(
				'name' => __( 'Authors' ),
				'singular_name' => __( 'Author' )
			),
			'public' => true,
			'has_archive' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-align-center',
			'description' => 'Modular feature items',
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies' => array( 'category', 'post_tag' )
		)
	);
	//register_taxonomy_for_object_type( 'category', 'tags' );
}



flush_rewrite_rules();




$prefix = 'elv_feature_';
$a_feature_meta_box = array();
$a_feature_meta_box = array(
	'id' => 'feature-meta-box',
	'title' => 'Menu Feature Setup',
	'page' => 'elv_feature',
	'context' => 'normal',
	'priority' => 'high',
	'taxonomies' => array('category'),
	'rewrite' => array('slug' => 'tiles'),
	'fields' => array(
		array(
			'desc' => 'Please select the Menu Name',
			'id' => $prefix . 'tag',
			'name' => 'Menu Name:',
			'options' => array(
				'1' => 'Column One',
				'2' => 'Column Two',
				'3' => 'Column Three',
				'4' => 'Column Four',
			),
			'std' => 'Menu Name',
			'type' => 'select'
		),
		array(
			'desc' => 'Please enter the link for this Menu Feature',
			'id' => $prefix . 'link',
			'name' => 'Tile Link:',
			'std' => '/this-is-the-link/',
			'type' => 'text',
		),
		array(
			'desc' => 'Please add the CTA for the button',
			'id' => $prefix . 'cta',
			'name' => 'Call to Action:',
			'std' => 'Get Started',
			'type' => 'text',
		),
	)
);
flush_rewrite_rules();


add_action('admin_menu', 'feature_add_box');
// Add meta box
function feature_add_box() {
	global $a_feature_meta_box;
	$a = array();
	$a = $a_feature_meta_box;
	add_meta_box($a['id'], $a['title'], 'meta_show_box', $a['page'], $a['context'], $a['priority']);
}


// Save data from meta box
function feature_save_data($post_id) {
	global $a_feature_meta_box;

	if( !empty( $a_feature_meta_box) ) {

		// verify nonce
		if (isset($_POST['feature_meta_box_nonce']) && !wp_verify_nonce($_POST['feature_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		foreach ( $a_feature_meta_box['fields'] as $field ) {
			$old = get_post_meta( $post_id, $field['id'], true );
			$new = $_POST[$field['id']];

			if ( $new && $new != $old ) {
				update_post_meta( $post_id, $field['id'], $new );
			} elseif ( '' == $new && $old ) {
				delete_post_meta( $post_id, $field['id'], $old );
			}
		}
	}
}


// hook into the init action and call create_book_taxonomies when it fires

add_action( 'init', 'create_author_taxonomies' );

// create two taxonomies, genres and writers for the post type "book"
function create_author_taxonomies() {

	$labels = array(
		'name'                       => _x( 'Writers', 'taxonomy general name' ),
		'singular_name'              => _x( 'Writer', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Writers' ),
		'popular_items'              => __( 'Popular Writers' ),
		'all_items'                  => __( 'All Writers' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Writer' ),
		'update_item'                => __( 'Update Writer' ),
		'add_new_item'               => __( 'Add New Writer' ),
		'new_item_name'              => __( 'New Writer Name' ),
		'separate_items_with_commas' => __( 'Separate writers with commas' ),
		'add_or_remove_items'        => __( 'Add or remove writers' ),
		'choose_from_most_used'      => __( 'Choose from the most used writers' ),
		'not_found'                  => __( 'No writers found.' ),
		'menu_name'                  => __( 'Writers' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'writer' ),
	);

	register_taxonomy( 'writer', 'book', $args );
}


function some_custom_data_function() {
	$author_id = array();
	$query = new WP_Query( array( 'post_type' => 'elv_authors') );
	while ( $query->have_posts() ) : $query->the_post();

		$s_name = get_the_title(get_the_ID());
		$author_id[] =  array( 'name' => $s_name , 'value'  => get_the_ID());

	endwhile; wp_reset_postdata();
	//var_dump(  $author_id );exit();
	return  $author_id ;
}


// fieldmanager setup
add_action( 'fm_post_post', function() {
	$fm = new Fieldmanager_Group( array(
		'name' => 'slideshow',
		'children' => array(
			'sort' => new Fieldmanager_Textfield( 'Sort Order' ),
			//'authors' => new Fieldmanager_Textfield( 'Author' ),
			'sample-select' => new Fieldmanager_Select( array(
				'first_element' => array( '', '' ),
				'label' => null,
				'name' => 'sample-select',
				'data' => some_custom_data_function(),
			) ),
			'disclaimer1' => new Fieldmanager_RichTextarea(
				'Disclaimer 1'
			),
			'disclaimer2' => new Fieldmanager_RichTextarea(
				'Disclaimer 2'
			),
			'disclaimer3' => new Fieldmanager_RichTextarea(
				'Disclaimer 3'
			),
			'disclaimer4' => new Fieldmanager_RichTextarea(
				'Disclaimer 4'
			),
		),
	) );
	$fm->add_meta_box( 'Expertise Articles', 'post' );
} );
flush_rewrite_rules();



add_action( 'wp_ajax_my_action', 'my_action_callback' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );

function my_action_callback() {
	global $wpdb; // this is how you get access to the database

	$whatever = intval( $_POST['whatever'] );

	$whatever += 10;

	echo $whatever;

	wp_die(); // this is required to terminate immediately and return a proper response
}