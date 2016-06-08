<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$bg_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$theme_class = $bg_class . ' ' . $el_class;

wp_enqueue_script( 'g-map' );

$wrapper_attributes[] = !empty( $map_settings ) 
	? sprintf( 'data-map-settings="%s"', $map_settings ) : '';

$pin_src = !empty($map_pin) 
	? wp_get_attachment_image_src( $map_pin, 'full' ) : '';
if(!empty($pin_src[0])) {
	$wrapper_attributes[] = sprintf( 'data-pin="%s"', $pin_src[0] );
}

$map_height = !empty( $map_height ) 
	? sprintf( 'style=" min-height: %s;"', $map_height ) : '';

printf( '<div class="map-canvas %s" %s %s></div>'
	, $theme_class, implode( ' ', $wrapper_attributes ), $map_height );