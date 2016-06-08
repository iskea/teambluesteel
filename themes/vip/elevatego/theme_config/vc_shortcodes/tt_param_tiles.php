<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
//$url = vc_build_link( $link );

$s_inline_style = '';
$s_featured_img_url = '';

$s_tiles  = '';
$s_tiles  .= get_tile_headers($filter1,$filter2,$filter3,$filter4);


if(isset($_REQUEST['tile_tag'])){

	$filter_main_tag = get_tag($_REQUEST['tile_tag'])->name;

	$args_expertise = array( 'numberposts' => -1);

	$o_query_expertise = get_posts( $args_expertise );

	if ($o_query_expertise) {
		foreach ($o_query_expertise as $expertise) {

			$s_featured_img_url = wp_get_attachment_url( get_post_thumbnail_id($expertise->ID) );

			if ($s_featured_img_url != '') {
				$s_inline_style = ' style="background: linear-gradient( rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25) ), url(' . $s_featured_img_url . ');"';
			}
			$all_article_tags_name  = array();
			$all_article_tags = wp_get_post_tags( $expertise->ID );


			if(empty($all_article_tags)){

			} else{

				foreach ($all_article_tags as $all_article_tag) {
					$all_article_tags_name[] = $all_article_tag->name;
				}


				if(in_array($filter1,$all_article_tags_name) && in_array($filter_main_tag,$all_article_tags_name)){
					$s_tiles .= create_tile_html(
							$filter1,
							$s_inline_style,
							$expertise
						). PHP_EOL;

				} else if (in_array($filter2,$all_article_tags_name) && in_array($filter_main_tag,$all_article_tags_name)){

					$s_tiles .= create_tile_html(
							$filter2,
							$s_inline_style,
							$expertise
						). PHP_EOL;

				} else if (in_array($filter3,$all_article_tags_name) && in_array($filter_main_tag,$all_article_tags_name)){

					$s_tiles .= create_tile_html(
							$filter3,
							$s_inline_style,
							$expertise
						). PHP_EOL;

				} else if(in_array($filter_main_tag,$all_article_tags_name)) {
					$s_tiles .= create_tile_html(
							$filter4,
							$s_inline_style,
							$expertise
						). PHP_EOL;
				} else{
					
				}

			}

		}
	}

	wp_reset_postdata();

	$s_tiles .= '	</div>' . PHP_EOL . '</div>';



}

else if(isset($_REQUEST['author_post_id'])) {

	$post_author_id = (int)$_REQUEST['author_post_id'];


	$args_expertise = array( 'numberposts' => -1);

	$o_query_expertise = get_posts( $args_expertise );

//var_dump($o_query_expertise);
	if ($o_query_expertise) {
		foreach ($o_query_expertise as $expertise) {


			$article_author_name = get_post_meta($expertise->ID, 'elv_posts_authors');

			if(!empty($article_author_name) && $article_author_name[0]!='' && (int)$article_author_name[0] == (int)$post_author_id){


				$s_featured_img_url = wp_get_attachment_url( get_post_thumbnail_id($expertise->ID) );


				if ($s_featured_img_url != '') {
					$s_inline_style = ' style="background: linear-gradient( rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25) ), url(' . $s_featured_img_url . ');"';
				}
				//var_dump($expertise);

				$all_article_tags_name  = array();
				$all_article_tags = wp_get_post_tags( $expertise->ID );


				if(empty($all_article_tags)){

				} else{

					foreach ($all_article_tags as $all_article_tag) {
						$all_article_tags_name[] = $all_article_tag->name;
					}


					if(in_array($filter1,$all_article_tags_name)){
						$s_tiles .= create_tile_html(
								$filter1,
								$s_inline_style,
								$expertise
							). PHP_EOL;

					} else if (in_array($filter2,$all_article_tags_name)){

						$s_tiles .= create_tile_html(
								$filter2,
								$s_inline_style,
								$expertise
							). PHP_EOL;

					} else if (in_array($filter3,$all_article_tags_name)){

						$s_tiles .= create_tile_html(
								$filter3,
								$s_inline_style,
								$expertise
							). PHP_EOL;

					} else {
						$s_tiles .= create_tile_html(
								$filter4,
								$s_inline_style,
								$expertise
							). PHP_EOL;
					}

				}
			}




		}
	}

	wp_reset_postdata();

	$s_tiles .= '	</div>' . PHP_EOL . '</div>';


}


else{

	$s_tiles .= generate_expertise_tiles($filter1,$filter2,$filter3,$filter4,$number_of_tiles);

	$s_tiles .= '	</div>' . PHP_EOL . '</div>';


}




print balanceTags($s_tiles);
