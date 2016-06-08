<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$url = vc_build_link( $link );


$output = '<table>
	<tr>
		<td>name</td>
		<td>'.$heading.'</td>
	</tr>
																												

</table>';

print balanceTags($output);
