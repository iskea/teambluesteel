<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

global $products;

$products = array("http://localhost/elevate-three/blog/elv_product_features/macquarie-black-credit-card/","http://localhost/elevate-three/blog/elv_product_features/basic-home-loan/","http://localhost/elevate-three/blog/elv_product_features/platinum-transaction-account/");


function get_bundle_tool($products){
	//$products = array("http://localhost/elevate-three/blog/elv_product_features/macquarie-black-credit-card/","http://localhost/elevate-three/blog/elv_product_features/basic-home-loan/","http://localhost/elevate-three/blog/elv_product_features/platinum-transaction-account/","http://localhost/elevate-three/blog/elv_product_features/vehicle-loans/");
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



?>


	<a class="text-black bg-grey-dark dummy-media-object" style="overflow: auto;"
	   href="<?php echo get_permalink($post->ID); ?>">


		<div class=" col-md-3" style="padding:0;">
			<?php echo get_bundle_tool($products) ?>
		</div>

	</a>



<!--</article>-->
<!-- #post-## -->

