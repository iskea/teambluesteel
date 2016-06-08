<?php


/** This file contains all the Modal Window functions */


/**
 *
 * Function to generate booking html
 *
 */


/**
 * @param $filter
 * @param $s_inline_style
 * @param $expertise
 * @return string
 *
 *
 * Grid
 *
 */
function create_tile_html(
    $filter,
    $s_inline_style,
    $expertise
)
{

    $content_html = '<div class="grid-item animate col-xs-12 col-sm-12 col-md-4 l-padding-b-1 cat-'.$filter.'">
					<div class="bg-blue feature-tile "'.$s_inline_style.'>
						<div class="tile-head"><span class="h4">Expertise</span></div>
						<div class="tile-body">
							<img src="">
							<h2 class="text-white">
								'. $expertise->post_title.'
							</h2>
							<div class="tile-link">
								<a class="" href="'.get_permalink($expertise->ID).'">Learn more</a>
							</div>
						</div>
					</div>
				</div>'. PHP_EOL;

    return $content_html;
}

/**
 * @param $filter
 * @param $s_inline_style
 * @param $expertise
 * @return string
 *
 * Carousel
 *
 */
function create_tile_carousel_html(
    $filter,
    $s_inline_style,
    $expertise
)
{

    $content_html = '<div class="grid-item animate col-xs-12 col-sm-12 col-md-4 l-padding-b-1 cat-'.$filter.'">
					<div class="bg-blue feature-tile "'.$s_inline_style.'>
						<div class="tile-head"><span class="h4">Expertise</span></div>
						<div class="tile-body">
							<img src="">
							<h2 class="text-white">
								'. $expertise->post_title.'
							</h2>
							<div class="tile-link">
								<a class="" href="'.get_permalink($expertise->ID).'">Learn more</a>
							</div>
						</div>
					</div>
				</div>'. PHP_EOL;

    return $content_html;
}


/**
 * @param $filter1
 * @param $filter2
 * @param $filter3
 * @param $filter4
 * @param int $number_of_posts
 * @return string
 *
 * Grid Expertise Generator
 *
 */
function generate_expertise_tiles($filter1,$filter2,$filter3,$filter4,$number_of_posts = -1){

    $s_tiles = '';
    $args_expertise = array( 'numberposts' => $number_of_posts);
    $s_inline_style = '';
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


                if(in_array($filter1,$all_article_tags_name)){
                    $s_tiles .= create_tile_html($filter1, $s_inline_style, $expertise);

                } else if (in_array($filter2,$all_article_tags_name)){

                    $s_tiles .= create_tile_html($filter2, $s_inline_style, $expertise);

                } else if (in_array($filter3,$all_article_tags_name)){

                    $s_tiles .= create_tile_html($filter3, $s_inline_style, $expertise);

                } else {
                    $s_tiles .= create_tile_html($filter4, $s_inline_style, $expertise);

                }

            }

        }
    }

    return $s_tiles;
}

/**
 * @param $filter1
 * @param $filter2
 * @param $filter3
 * @param $filter4
 * @param int $number_of_posts
 * @return string
 *
 *
 * Carousel Expertise
 *
 */

function generate_expertise_carousel_tiles($filter1,$filter2,$filter3,$filter4,$number_of_posts = -1){

    $s_tiles = '';
    $args_expertise = array( 'numberposts' => $number_of_posts);
    $s_inline_style = '';
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


                if(in_array($filter1,$all_article_tags_name)){
                    $s_tiles .= create_tile_carousel_html($filter1, $s_inline_style, $expertise);

                } else if (in_array($filter2,$all_article_tags_name)){

                    $s_tiles .= create_tile_carousel_html($filter2, $s_inline_style, $expertise);

                } else if (in_array($filter3,$all_article_tags_name)){

                    $s_tiles .= create_tile_carousel_html($filter3, $s_inline_style, $expertise);

                } else {
                    $s_tiles .= create_tile_carousel_html($filter4, $s_inline_style, $expertise);

                }

            }

        }
    }

    return $s_tiles;
}







function get_tile_headers($filter1,$filter2,$filter3,$filter4){

    $content_html = '<div class="container tile-columns">
	<div class="row l-padding-t-2">
		<div class="col-md-8 col-md-push-2 l-padding-t-1 center-block">
			<ul class="nav nav-pills nav-justified">
				<li role="presentation" class="active"><a class="tile-filter" data-filter="*">All</a></li>
				<li role="presentation"><a class="tile-filter" data-filter=".cat-'. strtolower($filter1) .'">'. ucwords (strtolower($filter1)) .'</a></li>
				<li role="presentation"><a class="tile-filter" data-filter=".cat-'. strtolower($filter2) .'">'. ucwords (strtolower($filter2)) .'</a></li>
				<li role="presentation"><a class="tile-filter" data-filter=".cat-'. strtolower($filter3) .'">'. ucwords (strtolower($filter3)) .'</a></li>
				<li role="presentation"><a class="tile-filter" data-filter=".cat-'. strtolower($filter4) .'">'. ucwords (strtolower($filter4)) .'</a></li>
			</ul>
		</div>
	</div>
	<div class="row l-padding-t-2 l-padding-b-2 column-content">';

    return $content_html. PHP_EOL;
}

