<?php

/** This file contains all the global functions */


/**
 *Setup of the Web Notifications custom post type
 *
 * @since 1.0.0
 * @author Ian Skea
 * Updated by - Aneesh Singh
 *
 *
 */

add_action( 'init', 'elv_web_notificiations' );
function elv_web_notificiations() {
    register_post_type( 'elv_notifications',
        array(
            'labels' => array(
                'name' => __( 'Web Notifications' ),
                'singular_name' => __( 'Menu Feature' )
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-pressthis',
            'description' => 'Modular callout notificiations',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies' => array( 'category', 'post_tag' ),
            'exclude_from_search' => true,
            'publicly_queryable' => false,
        )
    );
    //register_taxonomy_for_object_type( 'category', 'tags' );
}
flush_rewrite_rules();

$prefix = 'elv_notifications_';
$notification_box = array(
    'id' => 'notification-meta-box',
    'title' => 'Notification Information',
    'page' => 'elv_notifications',
    'context' => 'normal',
    'priority' => 'high',
    'taxonomies' => array('category'),
    'rewrite' => array('slug' => 'notifications'),
    'fields' => array(
        array(
            'desc' => 'Is this notifcastion active',
            'id' => $prefix . '1_url',
            'name' => 'Active:',
            'std' => '',
            'type' => 'select',
            'options' => array(
                'no' => 'No',
                'yes' => 'Yes',
            ),

        ),
        array(
            'desc' => 'If user has seen this notification',
            'id' => $prefix . 'user_id',
            'name' => 'User ID:',
            'std' => '',
            'type' => 'text',
        ),
    )
);
flush_rewrite_rules();

add_action('admin_menu', 'notifications_add_box');
function notifications_add_box() {
    global $notification_box;
    add_meta_box($notification_box['id'], $notification_box['title'], 'notification_show_box', $notification_box['page'], $notification_box['context'], $notification_box['priority']);
}

// Callback function to show fields in meta box
function notification_show_box() {
    global $notification_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="notifications_notification_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($notification_box['fields'] as $field) {
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


add_action('save_post', 'notifications_save_data');
function notifications_save_data( $i_post_id ) {
    global $notification_box;

    if( !empty( $notification_box ) ) {

        // verify nonce
        if ( isset($_POST['notifications_notification_box_nonce']) && !wp_verify_nonce($_POST['notifications_notification_box_nonce'], basename(__FILE__)) ) {
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

        foreach ( $notification_box['fields'] as $field ) {

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
