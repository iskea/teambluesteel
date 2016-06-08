<?php
/*
 *
 * Template Name: content-bundle
 *
 * @package Wordpress
 *
*/



$products = array();

if($_REQUEST['product_select_1'] == 'yes'){
	$products[] = $_REQUEST['product_url_1'];
}
if($_REQUEST['product_select_2'] == 'yes'){
	$products[] = $_REQUEST['product_url_2'];
}
if($_REQUEST['product_select_3'] == 'yes'){
	$products[] = $_REQUEST['product_url_3'];
}
if($_REQUEST['product_select_4'] == 'yes'){
	$products[] = $_REQUEST['product_url_4'];
}

//var_dump($products);

function get_bundle_tool($products){
	$not_the_bundle = 0;
	$matched_products = array();
	$the_content = '';
	$args = array( 'post_type' => 'elv_bundles', 'posts_per_page' => 10 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() && !$the_content) : $loop->the_post();

		$post_id = get_the_ID();

		if(isset(get_post_meta($post_id, 'elv_bundles_1_url')[0])){
			if(!in_array(get_post_meta($post_id, 'elv_bundles_1_url')[0],$products)){
				$not_the_bundle = 1;
			}else{
				$matched_products[] = get_post_meta($post_id, 'elv_bundles_1_url')[0];
			}
		}
		if(isset(get_post_meta($post_id, 'elv_bundles_2_url')[0])){
			if(!in_array(get_post_meta($post_id, 'elv_bundles_2_url')[0],$products)){
				$not_the_bundle = 1;
			}else{
				$matched_products[] = get_post_meta($post_id, 'elv_bundles_2_url')[0];
			}
		}

		if(isset(get_post_meta($post_id, 'elv_bundles_3_url')[0])){
			if(!in_array(get_post_meta($post_id, 'elv_bundles_3_url')[0],$products)){
				$not_the_bundle = 1;
			}else{
				$matched_products[] = get_post_meta($post_id, 'elv_bundles_3_url')[0];
			}
		}

		if(isset(get_post_meta($post_id, 'elv_bundles_4_url')[0])){
			if(!in_array(get_post_meta($post_id, 'elv_bundles_4_url')[0],$products)){
				$not_the_bundle = 1;
			}else{
				$matched_products[] = get_post_meta($post_id, 'elv_bundles_4_url')[0];
			}
		}


		if($not_the_bundle > 0 || sizeof($matched_products) != sizeof($products)){
			$not_the_bundle = 0;
		} else{
			$the_content = the_content();
		}

		unset($matched_products);
		$matched_products = array();

	endwhile;


	return $the_content;

}

$results = get_bundle_tool($products);



?>

