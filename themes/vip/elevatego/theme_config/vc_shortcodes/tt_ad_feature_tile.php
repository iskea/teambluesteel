<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
//$url = vc_build_link( $link );


$bg_image = find_right_background_image($background_data);

$content = wpb_js_remove_wpautop( apply_filters( 'the_content', $content ), true );

if ($bg_color) {
    $bg_color = 'background-color:' . $bg_color;
}

$output = '
<div class="col-xs-12 col-sm-12 col-md-12 l-padding-t-1 text-black fixed-height" style="' . $bg_color . '">
				<div class="row promo-feature bg-blue">
					<div class="col-md-5 full-image pull-right">';
if ($type == 'circle') {
    $output .= '<img src="' . wp_get_attachment_url($bg_image) . '" class="img-responsive img-circle" />';
} else {
    $output .= '<img src = "' . wp_get_attachment_url($bg_image) . '" class="img-responsive" />';
}
$output .= '</div>
				<div class="col-md-7 pull-left">
					' . $content . '
				</div>
			</div>
		</div>';

print balanceTags($output);
