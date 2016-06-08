<?php


/** This file contains all the global functions */


/**
 *
 * Add Bundle tool and custom fields
 * Created by - Aneesh Singh
 * Updated by - Aneesh Singh
 * Updated on - 22nd May 2016
 *
 */

add_action( 'init', 'elv_bundles_post_type' );
function elv_bundles_post_type() {
    register_post_type( 'elv_bundles',
        array(
            'labels' => array(
                'name' => __( 'Bundles' ),
                'singular_name' => __( 'Bundle' )
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-products',
            'description' => 'Modular callout bundles',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies' => array( 'category', 'post_tag' ),
            'exclude_from_search' => true,
            'publicly_queryable' => false,
        )
    );
    //register_taxonomy_for_object_type( 'category', 'tags' );
}
flush_rewrite_rules();

$prefix = 'elv_bundles_';
$bundle_box = array(
    'id' => 'bundle-meta-box',
    'title' => 'Bundle Information',
    'page' => 'elv_bundles',
    'context' => 'normal',
    'priority' => 'high',
    'taxonomies' => array('category'),
    'rewrite' => array('slug' => 'bundles'),
    'fields' => array(

        array(
            'desc' => 'First Product URL e.g. http://localhost/elevate-three/blog/elv_product_features/vehicle-loans/',
            'id' => $prefix . '1_url',
            'name' => 'First Product URL:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Second Product URL e.g. http://localhost/elevate-three/blog/elv_product_features/platinum-transaction-account/',
            'id' => $prefix . '2_url',
            'name' => 'Second Product URL:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Third Product URL e.g. http://localhost/elevate-three/blog/elv_product_features/macquarie-black-credit-card/',
            'id' => $prefix . '3_url',
            'name' => 'Third Product URL:',
            'std' => '',
            'type' => 'text',
        ),
        array(
            'desc' => 'Fourth Product URL e.g. http://localhost/elevate-three/blog/elv_product_features/basic-home-loan/',
            'id' => $prefix . '4_url',
            'name' => 'Fourth Product URL:',
            'std' => '',
            'type' => 'text',
        ),
    )
);
flush_rewrite_rules();

add_action('admin_menu', 'bundles_add_box');
function bundles_add_box() {
    global $bundle_box;
    add_meta_box($bundle_box['id'], $bundle_box['title'], 'bundle_show_box', $bundle_box['page'], $bundle_box['context'], $bundle_box['priority']);
}

// Callback function to show fields in meta box
function bundle_show_box() {
    global $bundle_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="bundles_bundle_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($bundle_box['fields'] as $field) {
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


add_action('save_post', 'bundles_save_data');
function bundles_save_data( $i_post_id ) {
    global $bundle_box;

    if( !empty( $bundle_box ) ) {

        // verify nonce
        if ( isset($_POST['bundles_bundle_box_nonce']) && !wp_verify_nonce($_POST['bundles_bundle_box_nonce'], basename(__FILE__)) ) {
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

        foreach ( $bundle_box['fields'] as $field ) {

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

