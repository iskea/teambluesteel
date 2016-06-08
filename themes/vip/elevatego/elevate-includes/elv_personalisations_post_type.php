<?php


/** This file contains all the global functions */



/**
 *
 * Add Personalisation tool and custom fields
 * Created by - Ian Skea
 * Updated by - Aneesh Singh
 * Updated on - 22nd May 2016
 *
 */

add_action( 'init', 'elv_personalisations_post_type' );
function elv_personalisations_post_type() {
    register_post_type( 'elv_personalisations',
        array(
            'labels' => array(
                'name' => __( 'Personalisations' ),
                'singular_name' => __( 'Personalisation' )
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-businessman',
            'description' => 'Modular callout personalisations',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies' => array( 'category', 'post_tag' ),
            'exclude_from_search' => true,
            'publicly_queryable' => false,
        )
    );
    //register_taxonomy_for_object_type( 'category', 'tags' );
}
flush_rewrite_rules();

$prefix = 'elv_personalisations_';
$personalisation_box = array(
    'id' => 'personalisation-meta-box',
    'title' => 'Personalisation Information',
    'page' => 'elv_personalisations',
    'context' => 'normal',
    'priority' => 'high',
    'taxonomies' => array('category'),
    'rewrite' => array('slug' => 'personalisations'),
    'fields' => array(

        array(
            'desc' => 'ID',
            'id' => $prefix . 'ID',
            'name' => 'ID:',
            'std' => '1',
            'type' => 'text',
        ),
        array(
            'desc' => 'Hash',
            'id' => $prefix . 'hash',
            'name' => 'Hash:',
            'std' => 'abc1234567890abc',
            'type' => 'text',
        ),
        array(
            'desc' => 'Number of visits',
            'id' => $prefix . 'visits',
            'name' => 'Number of visits:',
            'std' => '1000',
            'type' => 'text',
        ),
        array(
            'desc' => 'Posts Liked',
            'id' => $prefix . 'likes',
            'name' => 'Post IDs',
            'std' => '20',
            'type' => 'text',
        ),
        array(
            'desc' => 'Post Dislikes',
            'id' => $prefix . 'dislikes',
            'name' => 'Post IDs',
            'std' => '20',
            'type' => 'text',
        ),
        array(
            'desc' => 'Authors followed',
            'id' => $prefix . 'authors',
            'name' => 'Authors followed',
            'std' => '292',
            'type' => 'text',
        ),
        array(
            'desc' => 'Bookmarks',
            'id' => $prefix . 'bookmarks',
            'name' => 'Bookmarks',
            'std' => '121,132',
            'type' => 'text',
        ),
        array(
            'desc' => 'Persona',
            'id' => $prefix . 'persona',
            'name' => 'Persona:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Question 1',
            'id' => $prefix . 'q1',
            'name' => 'Question 1:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Question 2',
            'id' => $prefix . 'q2',
            'name' => 'Question 2:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Prioirty 1',
            'id' => $prefix . 'p1',
            'name' => 'Prioirty 1:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Prioirty 2',
            'id' => $prefix . 'p2',
            'name' => 'Prioirty 2:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Prioirty 3',
            'id' => $prefix . 'p3',
            'name' => 'Prioirty 3:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Please new heading',
            'id' => $prefix . 'pSubscribeHeading2',
            'name' => 'Subscribe Heading:',
            'std' => 'Subscribe to get expert advice and exclusive deals direct to your inbox',
            'type' => 'textHTML',
        ),

    )
);
flush_rewrite_rules();

add_action('admin_menu', 'personalisations_add_box');
function personalisations_add_box() {
    global $personalisation_box;
    add_meta_box($personalisation_box['id'], $personalisation_box['title'], 'personalisation_show_box', $personalisation_box['page'], $personalisation_box['context'], $personalisation_box['priority']);
}

// Callback function to show fields in meta box
function personalisation_show_box() {
    global $personalisation_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="personalisations_personalisation_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($personalisation_box['fields'] as $field) {
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


add_action('save_post', 'personalisations_save_data');
function personalisations_save_data( $i_post_id ) {
    global $personalisation_box;

    if( !empty( $personalisation_box ) ) {

        // verify nonce
        if ( isset($_POST['personalisations_personalisation_box_nonce']) && !wp_verify_nonce($_POST['personalisations_personalisation_box_nonce'], basename(__FILE__)) ) {
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

        foreach ( $personalisation_box['fields'] as $field ) {

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