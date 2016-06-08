<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
//$url = vc_build_link( $link );

$s_inline_style = '';
$s_featured_img_url = '';

$s_tiles  = '';
$s_tiles  .= get_tile_headers($filter1,$filter2,$filter3,$filter4);
$s_tiles .= generate_modal_windows();
$s_tiles .= generate_expertise_tiles($filter1,$filter2,$filter3,$filter4,$number_of_tiles);


wp_reset_postdata();

$s_tiles .= '	</div>' . PHP_EOL . '</div>';


print balanceTags($s_tiles);
