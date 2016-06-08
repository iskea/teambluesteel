<?php

/** This file contains all the global functions */


/**
 *
 * Add custom fields to tags
 *
 */


function pippin_taxonomy_add_new_meta_field() {
    // this will add the custom meta field to the add new term page
    ?>



    <div class="form-field">
        <label for="term_meta[custom_term_meta]"><?php _e( 'Add disclaimer', 'pippin' ); ?></label>
        <?php wp_editor('','custom_term_meta'); ?>
        <!--		<input type="text" name="term_meta[custom_term_meta]" id="term_meta_custom_term_meta" value="" class="customEditor">-->
        <p class="description"><?php _e( 'Add disclaimer over here','pippin' ); ?></p>
    </div>
    <?php
}
add_action( 'add_tag_form_fields', 'pippin_taxonomy_add_new_meta_field', 10, 2 );


function pippin_taxonomy_edit_meta_field($term) {

    // put the term ID into a variable
    $t_id = $term->term_id;

    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option( "taxonomy_$t_id" ); ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Add disclaimer', 'pippin' ); ?></label></th>
        <td>
            <?php wp_editor($term_meta['custom_term_meta'] ? $term_meta['custom_term_meta']  : '', 'custom_term_meta') ?>
            <p class="description"><?php _e( 'Add disclaimer over here','pippin' ); ?></p>
        </td>
    </tr>
    <?php
}
add_action( 'edit_tag_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );


// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {



    if ( isset( $_POST['custom_term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $term_meta['custom_term_meta'] = $_POST['custom_term_meta'];
        update_option( "taxonomy_$t_id", $term_meta );
    }
}
add_action( 'edited_post_tag', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_post_tag', 'save_taxonomy_custom_meta', 10, 2 );

/*
 *
 * Get tag URLs
 *
 */

function display_all_tags($tags){
    $output = '';
    foreach ($tags as $tag){
        $output .= '<a href='.get_home_url().'/expertise-tags?tile_tag='.$tag->term_id.'>'.$tag->name.'</a>&nbsp;';
    }

    return $output;
}
