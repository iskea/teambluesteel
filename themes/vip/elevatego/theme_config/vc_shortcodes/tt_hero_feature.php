<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
//$url = vc_build_link( $link );

$bg_url = array();
$bg_url = vc_build_link( $bg_video );

$a_btn_link = array();
$a_btn_link = vc_build_link( $btn_link );
$bg_image = find_right_background_image($background_data);


$a = array();
$a[] = $tabname;
$a[] = $tabicon;
$a[] = $subheading;
$a[] = $description;
$a[] = $a_btn_link['url'];
$a[] = $btn_name;
$a[] = wp_get_attachment_url($bg_image);
$a[] = $bg_url['url'];

$r = implode('<br />', $a);

print balanceTags($r);
