<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$d_title = $this->getStyles($font_container_title);
$d_subtitle =  $this->getStyles($font_container_subtitle);
$d_desc =  $this->getStyles($font_container_desc);
$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';


$output = '<div class="section-header '.$css_class.' '.$el_class.'">' ;
$output .= !empty($sub_title) ? '<h5 style="'.$d_subtitle.'">'.$sub_title.'</h5>' : '';
$output .= !empty($title) ? '<h2 style="'.$d_title.'">'.$title.'</h2>' : '';
$output .= !empty($subtext) ? '<p style="'.$d_desc.'">'.$subtext.'</p>' : '';
$output .= '</div>';

print balanceTags($output);
?>