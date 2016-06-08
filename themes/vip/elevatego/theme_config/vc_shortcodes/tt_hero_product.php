<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css_class = !empty($css) ? vc_shortcode_custom_css_class($css) : '';
$url = vc_build_link($apply_now_link);

$main_background_image = find_right_background_image($background_data);

$url_product = vc_build_link($product_link);

if ($light_dark == "dark") {
	$light_dark = "text-white";
}

$output = '<div class="product-hero">';
$output .= '<div class="vertical-tab-bg">';
if (!$background_video) {
	$output .= '<div class="vertical-tab-bgimg active">';
	$output .= '<img class="hero-image-sim img-responsive" src="' . wp_get_attachment_url($main_background_image) . '" />';
	$output .= '</div>';
} else {
	$output .= '<div id="bg-video-container">';
	$output .= '<iframe id="bg" src="https://www.youtube.com/embed/' . $background_video . '?autoplay=1&amp;playlist=' . $background_video . '&amp;controls=0&amp;loop=1" frameborder="0"></iframe>';
	$output .= '</div>';
}
$output .= '</div>';
$output .= '<div class="container l-padding-t-1 l-padding-b-1">';
$output .= '<div class="row">';
$output .= '<div class="col-md-6 hero-area ' . $light_dark . '">';
$output .= wpb_js_remove_wpautop(apply_filters('the_content', $content), true);
$output .= '<p>';
if ($url['url'] != '') {
	$output .= '<div class="pull-left margin-right-20"><a href="' . $url['url'] . '" class="btn btn-primary">' . $url['title'] . '</a></div>';
}
if ($url_product['url'] != '') {
	$output .= '<div class="pull-left"><a href="' . $url_product['url'] . '" target="' . $url_product['target'] . '" class="btn btn-primary-inverse">' . $url_product['title'] . '</a></div>';
}
$output .= '</p>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

print balanceTags($output);
