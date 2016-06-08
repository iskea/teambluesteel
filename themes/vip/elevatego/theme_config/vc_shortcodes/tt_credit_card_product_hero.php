<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$content = wpb_js_remove_wpautop( apply_filters( 'the_content', $content ), true );
$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
//$url = vc_build_link( $link );
$url = vc_build_link( $btn_link );
$output ='<div class="container l-padding-t-1 l-padding-b-1">
		<div class="row product-feature offer-info">
			<div class="col-md-6 l-padding-t-3 l-padding-b-3">
				<div class="bg-white-90 top-border-primary offer-body">
					'.$content.'
					<a href="' . esc_url($url['url']) . '" class="btn btn-success learn-more" title="' . esc_attr($url['title']) . '" target="' . (strlen($url['target']) > 0 ? esc_attr($url['target']) : '_self') . '">' . esc_attr($url['title']) . '</a>
				</div>
			</div>
			<div class="col-md-6 l-padding-t-3 l-padding-b-3">
				<div class="col-md-12 text-center offer-body-small-top">
					<img src="'.wp_get_attachment_url($background_image).'" class="img-responsive margin-auto" ></div>
				<div class="col-md-6">
					<div class="col-md-12 bg-white-90 top-border-success text-center offer-body-small-bottom">
						<h4>'.$green_border_heading_box_1.'</h4>
						<div class="rate-display rate-sml text-success">'.$green_border_price_box_1.'</div>
						<p class="lead">'.$green_border_description_1.'</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="col-md-12 bg-white-90 top-border-success text-center offer-body-small-bottom l-padding-t-2">
						<span class="rate-display '.$icon_typicons.'"><!-- fill --></span>
						<span class="rate-display rate-sml text-success">'.$green_border_heading_box_2.'</span>
						<p class="lead">'.$green_border_description_2.'</p>
					</div>
				</div>
			</div>
		</div>
	</div>';

print balanceTags($output);

