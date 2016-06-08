<?php

/** This file contains all the global functions */



/*
 *
 * Custom Post Type : Authors
 *
 */

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
            'menu_icon' => 'dashicons-admin-users',
            'description' => 'Modular feature items',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies' => array( 'category', 'post_tag' )
        )
    );
}



flush_rewrite_rules();



$prefix = 'elv_authors_';
$author_box = array(
    'id' => 'author-meta-box',
    'title' => 'Author Information',
    'page' => 'elv_authors',
    'context' => 'normal',
    'priority' => 'high',
    'taxonomies' => array('category'),
    'rewrite' => array('slug' => 'elv_authors'),
    'fields' => array(
        array(
            'desc' => 'Tag Line eg. Industry expert, Savings & Budgeting',
            'id' => $prefix . 'tag_line',
            'name' => 'Tag Line:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Followers ID',
            'id' => $prefix . 'follow_id',
            'name' => 'Followers:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Posts Liked',
            'id' => $prefix . 'posts_liked',
            'name' => 'Post Liked:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Posts Disliked',
            'id' => $prefix . 'posts_disliked',
            'name' => 'Post Disliked:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Posts Bookmark',
            'id' => $prefix . 'posts_bookmark',
            'name' => 'Post Bookmarks:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Follower ID',
            'id' => $prefix . 'follower_id',
            'name' => 'Follower ID:',
            'std' => '',
            'type' => 'text',
        ),
    )
);
flush_rewrite_rules();

add_action('admin_menu', 'authors_add_box');
function authors_add_box() {
    global $author_box;
    add_meta_box($author_box['id'], $author_box['title'], 'author_show_box', $author_box['page'], $author_box['context'], $author_box['priority']);
}

// Callback function to show fields in meta box
function author_show_box() {
    global $author_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="authors_author_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($author_box['fields'] as $field) {
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


add_action('save_post', 'authors_save_data');
function authors_save_data( $i_post_id ) {
    global $author_box;

    if( !empty( $author_box ) ) {

        // verify nonce
        if ( isset($_POST['authors_author_box_nonce']) && !wp_verify_nonce($_POST['authors_author_box_nonce'], basename(__FILE__)) ) {
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

        foreach ( $author_box['fields'] as $field ) {

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
