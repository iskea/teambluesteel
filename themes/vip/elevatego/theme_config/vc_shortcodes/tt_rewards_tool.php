<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$content = wpb_js_remove_wpautop( apply_filters( 'the_content', $content ), true );
$html = $content;

print $html;