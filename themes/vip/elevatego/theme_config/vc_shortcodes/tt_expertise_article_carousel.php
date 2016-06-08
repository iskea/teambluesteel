<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css_class = !empty($css) ? vc_shortcode_custom_css_class($css) : '';
//$url = vc_build_link( $link );

$a_args = array(
	'post_type' => 'elv_tiles',
	'posts_per_page' => 9,
);
$s_tiles = '';
$o_query = new WP_Query($a_args);
if ($o_query->have_posts()) {
	while ($o_query->have_posts()) {
		$o_query->the_post();

		// get the categories without the link
		$o_cat = null;
		$o_cat = get_the_category();

		$a_cat = array();
		if (!empty($o_cat)) {
			foreach ($o_cat as $o) {
				$a_cat[] = esc_html($o->name);
			}
		}

		$s_cat = '';
		$s_cat = implode(', ', $a_cat);

		$s_class_color = '';
		$s_class_color = get_post_meta(get_the_ID(), 'elv_tiles_class', true);

		$s_link = '';
		$s_link = get_post_meta(get_the_ID(), 'elv_tiles_link', true);

		$s_inline_style = '';
		$s_featured_img_url = '';
		$s_featured_img_url = get_the_post_thumbnail_url();

		if ($s_featured_img_url != '') {
			$s_inline_style = ' src="' . $s_featured_img_url . '"';
		}

		$s_tiles .= '<div class=" cat-bank">
			<div class="modal-triangle-small modal hide-triangle-small-green">
				<span class="picon picon-0651-star-favorite-rating text-white"></span></div>
			<div class="bg-blue feature-tile  tile-modal" data-toggle="modal" data-target="#subscribe">
				<div class="tile-head"><span class="h4">' . $s_cat . '</span></div>
				<div class="tile-body">
					<img src="' . $s_inline_style . '" class="img-responsive" />
						' . get_the_content() . '
					<div class="tile-link">
						<a class="" href="' . $s_link . '">Learn more</a>
					</div>
				</div>
			</div>
		</div>';

	}
}

$s_tiles .= generate_expertise_carousel_tiles($filter1, $filter2, $filter3, $filter4, $number_of_tiles);

/* Get repayments calc javascript file*/
//$custom_js_path = get_template_directory_uri() . '/js/slick.js';

$output = '<div class="container-fluid bg-grey l-padding-b-3 l-padding-t-3">
	<div class="row">
		<div class="container tile-columns">
			<div class="tile-carousel">' . $s_tiles . '</div>
		</div>
	</div>
	<div class="row l-padding-t-1">
		<div class="container">
			<div class="col-md-12 text-center"><a href="' . get_home_url() . '/expertise-hub">More articles suggested for you</a></div>
		</div>
	</div>
</div>';
$output .= '<script type="text/javascript">
	$(document).ready(function () {
		$(\'.tile-carousel\').slick({
			centerMode: true,
			centerPadding: \'60px\',
			slidesToShow: 3,
			dots: false,
			infinte: false,
			variableWidth: true,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						arrows: true,
						centerMode: true,
						centerPadding: \'40px\',
						slidesToShow: 2
					}
				},
				{
					breakpoint: 768,
					settings: {
						arrows: true,
						centerMode: true,
						centerPadding: \'40px\',
						slidesToShow: 1
					}
				},
				{
					breakpoint: 480,
					settings: {
						arrows: false
					}
				}
			]
		});
	});
</script>';

print balanceTags($output);

