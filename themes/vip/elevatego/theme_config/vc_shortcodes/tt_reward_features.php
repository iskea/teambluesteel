<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$url = vc_build_link( $btn_link );
$main_background_image = find_right_background_image($background_data);

$a_btn_link = array();
$a_btn_link = vc_build_link( $btn_link );
$content = wpb_js_remove_wpautop( apply_filters( 'the_content', $content ), true );
$output = '<div class="container-fluid product-feature dark-gradient-btm" style="background-image: url(\''.wp_get_attachment_url($main_background_image).'\');">
	<div class="container l-padding-b-4">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 l-padding-t-5 l-padding-b-3 pull-'.$type.' text-white"">
				<h4>'. $subheading.'</h4>
				<h2>'. $heading.'</h2>
				'. $content.'
				<p><a href="'. $url['url'] .'" class="btn btn-primary">'.  $url['title'] .'</a></p>
			</div>
		</div>
	</div>
</div>';


print balanceTags($output);
?>