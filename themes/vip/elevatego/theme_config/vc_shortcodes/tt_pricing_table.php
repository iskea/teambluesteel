<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$plan = explode("|", $plan);
$url = vc_build_link( $link );

$output = '<div class="pricing-table '.$best.'"><div class="row"><div class="col-xs-8">';
$output .= '<h5 class="plan">'.$plan[0].'</h5>';
$output .= !empty($plan[1]) ? '<h4 class="title">'.$plan[1].'</h4>' : '';
$output .= '</div><div class="col-xs-6"><ul class="clean-list features">';
	if(!empty($features)) {
		$f_list = explode(',', $features);
		foreach ($f_list as $key => $item)
			$output .= '<li>'.$item.'</li>';
	}
$output .= '</ul></div><div class="col-xs-5"><div class="price"><span>'.substr($price,0,1).'</span>'.substr($price,1,20).'</div></div>';
$output .= '<div class="col-xs-4"><a href="'.esc_url($url['url']).'" class="btn medium" title="'.esc_attr($url['title']).'" target="'.( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self').'">'.esc_attr($url['title']).'</a>';
$output .= '</div></div></div>'; 

print balanceTags($output);
?>

