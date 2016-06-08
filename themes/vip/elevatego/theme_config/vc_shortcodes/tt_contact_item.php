<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';

vc_icon_element_fonts_enqueue( $type );

$icon = ${"icon_" . $type};
?>

<div class="contact-item <?php echo esc_attr($css_class.' '.$el_class);?>">
	<h5 class="title"><i class="<?php echo esc_attr($icon);?>"></i><?php print $title;?></h5>
	<p><?php print $description;?></p>
</div>