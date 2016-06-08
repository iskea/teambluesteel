<?php

/** This file contains all the global functions */


/**
 *
 * Custom Fields for pages
 * Created by - Aneesh Singh
 * Updated by - Aneesh Singh
 * Updated on - 22nd May 2016
 *
 */


$prefix = 'elv_posts_';
$page_box = array(
    'id' => 'page-meta-box',
    'title' => 'Page Information',
    'page' => 'page',
    'context' => 'normal',
    'priority' => 'low',
    'taxonomies' => array('category'),
    'rewrite' => array('slug' => 'page'),
    'fields' => array(
        array(
            'desc' => 'Expanded Accordion',
            'id' => $prefix . 'accordion',
            'name' => 'Expand Accordion:',
            'options' => array(
                '1' => 'No',
                '2' => 'Yes',
            ),
            'type' => 'select'
        ),
        array(
            'desc' => 'Please new heading',
            'id' => $prefix . 'disclaimer1',
            'name' => 'Disclaimer - Accordion disclaimers:',
            'std' => '',
            'type' => 'textHTML',
        ),
        array(
            'desc' => 'Expanded Accordion in Black',
            'id' => $prefix . 'accordion2',
            'name' => 'Expand Accordion in Black:',
            'options' => array(
                '1' => 'No',
                '2' => 'Yes',
            ),
            'type' => 'select'
        ),
        array(
            'desc' => 'Please new heading',
            'id' => $prefix . 'disclaimer2',
            'name' => 'Disclaimer - in Black disclaimer:',
            'std' => '',
            'type' => 'textHTML',
        ),

    )
);
flush_rewrite_rules();

add_action('admin_menu', 'pages_add_box');
function pages_add_box() {
    global $page_box;
    add_meta_box($page_box['id'], $page_box['title'], 'page_show_box', $page_box['page'], $page_box['context'], $page_box['priority']);
}

// Callback function to show fields in meta box
function page_show_box() {
    global $page_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="pages_page_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($page_box['fields'] as $field) {
        // get current page meta data
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


add_action('save_post', 'pages_save_data');


function pages_save_data( $i_page_id ) {

    global $page_box;

    //var_dump($_POST);


    if( !empty( $page_box ) ) {

        // verify nonce
        if ( isset($_POST['pages_page_box_nonce']) && !wp_verify_nonce($_POST['pages_page_box_nonce'], basename(__FILE__)) ) {
            return $i_page_id;
        }

        // check autosave
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $i_page_id;
        }

        // check permissions
        if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
            if (!current_user_can('edit_page', $i_page_id)) {
                return $i_page_id;
            }
        } elseif ( !current_user_can('edit_post', $i_page_id) ) {
            return $i_page_id;
        }

        foreach ( $page_box['fields'] as $field ) {

            $s_old = '';
            $s_old = get_post_meta($i_page_id, $field['id'], true);

            $s_new = '';
            if( isset($_POST[$field['id']]) ) {
                $s_new = $_POST[$field['id']];
            }

            if ( $s_new != $s_old ) {
                update_post_meta( $i_page_id, $field['id'], $s_new );
            } elseif ( '' == $s_new && $s_old ) {
                delete_post_meta( $i_page_id, $field['id'], $s_old );
            }
        }
    }
}


flush_rewrite_rules();
