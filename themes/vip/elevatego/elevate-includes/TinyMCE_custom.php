<?php

/** This file contains all the global functions */



/**
 *
 *
 *
 * Updated TinyMCE functionality
 *
 *
 */

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );


// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {
    // Define the style_formats array
    $style_formats = array(
        // Each array child is a format with it's own settings
        array(
            'title' => '.translation',
            'block' => 'blockquote',
            'classes' => 'translation',
            'wrapper' => true,

        ),
        array(
            'title' => '⇠.rtl',
            'block' => 'blockquote',
            'classes' => 'rtl',
            'wrapper' => true,
        ),
        array(
            'title' => '.ltr⇢',
            'block' => 'blockquote',
            'classes' => 'ltr',
            'wrapper' => true,
        ),
        array(
            'title' => 'Content Block',
            'block' => 'span',
            'classes' => 'content-block',
            'wrapper' => true,

        ),
        array(
            'title' => 'Para with Lead',
            'block' => 'span',
            'classes' => 'lead',
            'wrapper' => true,

        ),
        array(
            'title' => 'Blue Button',
            'block' => 'span',
            'classes' => 'blue-button',
            'wrapper' => true,
        ),
        array(
            'title' => 'Red Button',
            'block' => 'span',
            'classes' => 'red-button',
            'wrapper' => true,
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );
    $init_array['entities'] = '160,nbsp,38,amp,60,lt,62,gt,8224,dagger,8225,Dagger';

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );


function enable_more_buttons($buttons) {

    $buttons[] = 'backcolor';
    $buttons[] = 'newdocument';
    $buttons[] = 'cut';
    $buttons[] = 'copy';
    $buttons[] = 'hr';

    return $buttons;
}
add_filter("mce_buttons_3", "enable_more_buttons");

/**
 *
 *
 * Adding button functionality to WordPress Editor
 *
 *
 */

add_shortcode( 'recent-posts', 'wptuts_recent_posts' );
function wptuts_recent_posts( $atts ) {
    extract( shortcode_atts( array(
        'numbers' => '5',
    ), $atts ) );
    $rposts = new WP_Query( array( 'posts_per_page' => -1, 'orderby' => 'date' ) );
    if ( $rposts->have_posts() ) {
        $html = '<h3>Recent Posts</h3><ul class="recent-posts">';
        while( $rposts->have_posts() ) {
            $rposts->the_post();
            $html .= sprintf(
                '<li><a href="%s" title="%s">%s</a></li>',
                get_permalink($rposts->post->ID),
                get_the_title(),
                get_the_title()
            );
        }
        $html .= '</ul>';
    }
    wp_reset_query();
    return $html;
}

add_action( 'init', 'wptuts_buttons' );
function wptuts_buttons() {
    add_filter( "mce_external_plugins", "wptuts_add_buttons" );
    add_filter( 'mce_buttons', 'wptuts_register_buttons' );
}
function wptuts_add_buttons( $plugin_array ) {
    $plugin_array['wptuts'] = get_template_directory_uri() . '/js/wp-editor.js';
    return $plugin_array;
}
function wptuts_register_buttons( $buttons ) {
    array_push( $buttons, 'dropcap', 'showrecent' , 'anchortag','Trophy_Multiplier_two','Trophy_Multiplier_one', 'Rewards_with_image' , 'Big_green_Zero','bigzero','promotile' ); // dropcap', 'recentposts, , 'anchortag
    return $buttons;
}

