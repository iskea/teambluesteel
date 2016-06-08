<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
//$url = vc_build_link( $link );


$output = '<table>
	<tr>
		<td>product_names</td>
		<td>'.$product_names.'</td>
	</tr>
			
</table>';


$products_array = (array) vc_param_group_parse_atts( $product_names );


foreach ($products_array as $product_array){

    $postid = url_to_postid( $product_array['product_feature_URL'] );

    $category = get_the_category($postid);
    //var_dump($category[0]->name);

    //var_dump(get_the_title($postid));
    $tags = get_the_tags($postid);

    foreach ($tags as $tag){
        var_dump($tag->name);

    }


}

/*
 *
 * -- Collate all the features into one unique Array
 * -- Make those array's as headers
 * -- Product that don't have those values, will become crosses.
 *
 */

print balanceTags($output);
