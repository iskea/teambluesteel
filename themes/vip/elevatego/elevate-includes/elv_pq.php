<?php

/** This file contains all the global functions */


/**
 *
 * Add Personalisation Questions
 * Created by - Aneesh Singh
 * Updated by - Aneesh Singh
 * Updated on - 27th May 2016
 *
 */

add_action( 'init', 'elv_pq' );

function elv_pq() {
    register_post_type( 'elv_pq',
        array(
            'labels' => array(
                'name' => __( 'P Qs' ),
                'singular_name' => __( 'P Q' )
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-universal-access-alt',
            'description' => 'Personalised Questions',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies' => array( 'category', 'post_tag' )
        )
    );
    //register_taxonomy_for_object_type( 'category', 'tags' );

}
flush_rewrite_rules();