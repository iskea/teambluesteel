<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$html = '';

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$url = vc_build_link( $link );

//var_dump($tagline, $heading, $descriptive, wp_get_attachment_image($images));

$output = '
<div class="column-content tile-columns static-columns">
	<div class="column-content l-padding-b-1">
		<div class="bg-blue feature-tile fixed-height-420 dark-gradient-btm" style="background: url('.wp_get_attachment_url($images).');">
			<div class="tile-head">
			<span class="h4">'.$tagline.'</span></div>
			<div class="tile-body">
				<h3 class="text-white">
					'.$heading.'
				</h3>
				<p class="text-white">'.$descriptive.'</p>
				<div class="tile-link">
					<a href="' . esc_url($url['url']) . '" class="" title="' . esc_attr($url['title']) . '" target="' . (strlen($url['target']) > 0 ? esc_attr($url['target']) : '_self') . '">' . esc_attr($url['title']) . '</a>
				</div>
			</div>
		</div>
	</div>
</div>';

print balanceTags($output);
