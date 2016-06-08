<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
//$url = vc_build_link( $link );






$output = '<table>
	<tr>
		<td>Heading</td>
		<td>'.$heading.'</td>
	</tr>
	<tr>
		<td>Menu heading</td>
		<td>'.$menu_headings.'</td>
	</tr>
	<tr>
		<td>Active Link</td>
		<td>'.$active_link.'</td>
	</tr>
	
</table>';

print balanceTags($output);
