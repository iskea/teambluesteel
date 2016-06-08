<?php


/** This file contains all the global functions */


/**
 *
 * Function Image URL
 *
 */

function get_image_url($post_id){
    $background_image_url = '';

    $background_image_url  = wp_get_attachment_url(get_post_thumbnail_id($post_id));
    if($background_image_url == ''){
        $background_image_url = get_template_directory_uri().'/img/hero_elevate-product_lg.jpg';
    }

    return $background_image_url;
}

/**
 *
 *
 * Function for Background Image
 *
 *
 */


function find_right_background_image($background_data){

    $persona = 1;
    if(isset($_SESSION['persona_updated'])){
        $persona = $_SESSION['persona_updated'];
    } else if(isset($_SESSION['persona'])){
        $persona = $_SESSION['persona'];
    } else{
    }

    //var_dump($persona);
    $a_background_data = (array) vc_param_group_parse_atts( $background_data );
    $background_images = array();
    foreach ($a_background_data as $background_data_s) {

        $background_images[$background_data_s['persona_number']] = $background_data_s['background_image'];

    }

    $main_background_image = '';


    if(isset($background_images[$persona])){

        if (!$background_images[$persona]) {
            $main_background_image = $background_images[1];
        } else {
            $main_background_image = $background_images[$persona];
        }

    } else{
        $main_background_image = $background_images[1];
    }

    return $main_background_image;
}

/**
 * @param array $elements
 * @param int $parentId
 * @return array
 *
 *
 */

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


/**
 *
 * Removing Pages from search
 *
 *
 *
 */

function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}

add_filter('pre_get_posts','SearchFilter');