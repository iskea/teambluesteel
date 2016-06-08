<?php

/** This file contains all the global functions */


/**
 *
 * Add Disclaimer tool and custom fields
 * Created by - Aneesh Singh
 * Updated by - Aneesh Singh
 * Updated on - 26th May 2016
 *
 */




add_action( 'init', 'elv_disclaimers_post_type' );
function elv_disclaimers_post_type() {
    register_post_type( 'elv_disclaimers',
        array(
            'labels' => array(
                'name' => __( 'Disclaimers' ),
                'singular_name' => __( 'Disclaimer' )
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-clipboard',
            'description' => 'Modular callout disclaimers',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies' => array( 'category', 'post_tag' ),
        )
    );
    //register_taxonomy_for_object_type( 'category', 'tags' );
}
flush_rewrite_rules();

$prefix = 'elv_disclaimers_';
$disclaimer_box = array(
    'id' => 'disclaimer-meta-box',
    'title' => 'Disclaimer Information',
    'page' => 'elv_disclaimers',
    'context' => 'normal',
    'priority' => 'high',
    'taxonomies' => array('category'),
    'rewrite' => array('slug' => 'disclaimers'),
    'fields' => array(

    )
);
flush_rewrite_rules();

add_action('admin_menu', 'disclaimers_add_box');
function disclaimers_add_box() {
    global $disclaimer_box;
    add_meta_box($disclaimer_box['id'], $disclaimer_box['title'], 'disclaimer_show_box', $disclaimer_box['page'], $disclaimer_box['context'], $disclaimer_box['priority']);
}

// Callback function to show fields in meta box
function disclaimer_show_box() {
    global $disclaimer_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="disclaimers_disclaimer_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($disclaimer_box['fields'] as $field) {
        // get current post meta data
        //var_dump($field);
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
            '<th style="width:15%"><label for="' .  $field['id'] . '">' . $field['name'] . '</label></th>',
        '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . ($meta ? $meta : $field['std']) . '" size="30" style="width:97%" />' . '<br />' . $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '" cols="60" rows="4" style="width:97%">' . ($meta ? $meta : $field['std']). '</textarea>' . '<br />' . $field['desc'];
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
            case 'textHTML':
                wp_editor(  ($meta ? $meta : $field['std']), $field['id'] );
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


add_action('save_post', 'disclaimers_save_data');
function disclaimers_save_data( $i_post_id ) {
    global $disclaimer_box;

    if( !empty( $disclaimer_box ) ) {

        // verify nonce
        if ( isset($_POST['disclaimers_disclaimer_box_nonce']) && !wp_verify_nonce($_POST['disclaimers_disclaimer_box_nonce'], basename(__FILE__)) ) {
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

        foreach ( $disclaimer_box['fields'] as $field ) {

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

flush_rewrite_rules();
